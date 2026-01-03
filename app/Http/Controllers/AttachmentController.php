<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttachmentRequest;
use App\Http\Requests\UpdateAttachmentRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AttachmentRepository;
use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use App\Helpers\AuditHelper;



use Laracasts\Flash\Flash;

class AttachmentController extends AppBaseController
{
    /** @var AttachmentRepository $attachmentRepository*/
    private $attachmentRepository;

    public function __construct(AttachmentRepository $attachmentRepo)
    {
        $this->attachmentRepository = $attachmentRepo;
    }

    /**
     * Display a listing of the Attachment.
     */
    public function index(Request $request)
    {
        $attachments = $this->attachmentRepository->paginate(10);

        return view('attachments.index')
            ->with('attachments', $attachments);
    }

    /**
     * Show the form for creating a new Attachment.
     */
    public function create($type, $id)
    {
        $modelClass = $this->resolveModel($type); // e.g., User::class or Project::class
        $model = $modelClass::findOrFail($id);

        $attTypes = \App\Models\AttachmentType::where('active', 1)
            ->pluck(app()->getLocale() === 'ar' ? 'name_ar' : 'name_en', 'id');

        return view('users.attachments.create', [
            'model'    => $model,
            'type'     => $type,
            'attTypes' => $attTypes
        ]);
    }


    /**
     * Store a newly created Attachment in storage.
     */
    /*public function store(Request $request)
    {
        \Log::info('🚨 STORE METHOD CALLED');//dd($request->all());
        $data = $request->all();
        \Log::info('📥 Creating attachment with data:', $data);

        if ($request->hasFile('AttFile')) {
            $file = $request->file('AttFile');
            $extension = $file->getClientOriginalExtension();

            $prefix = \Illuminate\Support\Facades\DB::table('attachment_types')->where('id', $data['AttID'])->value('Prefix');
            if (!$prefix) {
                \Log::error("⛔ No prefix found for AttID " . $data['AttID']);
                Flash::error('Invalid attachment type.');
                return redirect()->back();
            }

            $newFileName = $prefix . '_' . $data['CaseID'] . '.' . $extension;
            $file->move(public_path('Files'), $newFileName);

            $data['AttPath'] = '\\\\svr\\RAKcMainApp$\\Files\\' . $newFileName;
            \Log::info('✅ File saved to:', [public_path('Files/' . $newFileName)]);
        } else {
            Flash::error('Attachment file is required.');
            return redirect()->back();
        }
        $newRecord = [
                'CaseID' => $data['CaseID'],
                'AttID' => $data['AttID'],
                'AttPath' => $data['AttPath'],
                'Remarks' => $data['Remarks'],
            ];
        \Illuminate\Support\Facades\DB::table('attachments')->insert([
            'CaseID' => $data['CaseID'],
            'AttID' => $data['AttID'],
            'AttPath' => $data['AttPath'],
            'Remarks' => $data['Remarks'],
            //'created_at' => now(),
            //'updated_at' => now(),
        ]);
        AuditHelper::logAudit('created', 'attachments', [], $newRecord);

        session()->flash('success', 'Attachment created successfully.');
        Flash::success('Attachment saved successfully.');
        return redirect()->route('primaryDatas.show', ['primaryData' => $data['CaseID']])->withFragment('attachments');


        
//return redirect(route('attachments.index'));
    }*/

//$project->attachments()->create([...]);
//$payment->attachments()->create([...]);



    public function store(Request $request, User $user)
    {
        $request->validate([
            'attachments' => 'nullable|array|max:10',
            'attachments.*.type' => 'required|exists:attachment_types,ID',
            'attachments.*.file' => 'required|file|max:10240|mimes:pdf,jpg,jpeg,png',
        ]);

        if ($request->has('attachments')) {
            foreach ($request->attachments as $attachment) {
                $file = $attachment['file'];
                $typeId = $attachment['type'];

                $prefix = DB::table('attachment_types')->where('ID', $typeId)->value('Prefix');

                if (!$prefix) continue;

                $filename = $prefix . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('Files'), $filename);

                Attachment::create([
                    'attachable_id' => $user->id,
                    'attachable_type' => User::class,
                    'attachment_id' => $typeId,
                    'file_name' => $filename,
                    'file_type' => $file->getClientOriginalExtension(),
                    'AttPath' => '\\\\svr\\RAKcMainApp$\\Files\\' . $filename,
                    'notes' => $attachment['notes'] ?? null,
                ]);
            }
        }

        return redirect()->route('users.index')
            ->with('success', 'Attachments uploaded successfully!');
    }








    /**
     * Display the specified Attachment.
     */
    /*public function show($id)
    {
        $attachment = $this->attachmentRepository->find($id);

        if (empty($attachment)) {
            Flash::error('Attachment not found');

            return redirect(route('attachments.index'));
        }

        return view('attachments.show')->with('attachment', $attachment);
    }*/




    public function show($id, Request $request)
{
    $referer = $request->headers->get('referer');
    $isSubmission = str_contains($referer, '/primaryDatasSubmissions/');
    $table = $isSubmission ? 'attachments_submissions' : 'attachments';

    $attachment = \Illuminate\Support\Facades\DB::table($table)->where('ID', $id)->first();

    if (!$attachment) {
        Flash::error('Attachment not found');
        return redirect()->route('attachments.index');
    }

    return view('attachments.show', compact('attachment'));
}


    /**
     * Show the form for editing the specified Attachment.
     */
    /*public function edit($id)
    {
        $attachment = $this->attachmentRepository->find($id);

        if (empty($attachment)) {
            Flash::error('Attachment not found');

            return redirect(route('attachments.index'));
        }

        $attTypes = \App\Models\AttachmentType::pluck('AttType', 'ID');
        $caseId = $attachment->CaseID;

        //if (request()->ajax()) {
        //    return view('attachments.partials.edit-form', compact('attachment', 'attTypes', 'caseId'));
        //}
        return view('attachments.edit', compact('attachment', 'attTypes', 'caseId'));
        //return view('attachments.edit')->with('attachment', $attachment);
    }*/





    public function edit($id, Request $request)
    {
        $referer = $request->headers->get('referer');
        $isSubmission = str_contains($referer, '/primaryDatasSubmissions/');
        $table = $isSubmission ? 'attachments_submissions' : 'attachments';

        $attachment = \Illuminate\Support\Facades\DB::table($table)->where('ID', $id)->first();

        if (!$attachment) {
            Flash::error('Attachment not found');
            return redirect()->route('attachments.index');
        }

        $attTypes = \App\Models\AttachmentType::pluck('AttType', 'ID');

        return view('attachments.edit', compact('attachment', 'attTypes'));
    }


    /*public function update($id, UpdateAttachmentRequest $request)
{
    $attachment = $this->attachmentRepository->find($id);
    if (empty($attachment)) {
        Flash::error('Attachment not found');
        return redirect(route('attachments.index'));
    }

    $data = $request->all();
    //\Log::info('➡ Incoming data:', $data);

    $prefix = DB::table('attachment_types')->where('id', $data['AttID'])->value('Prefix');
    if (!$prefix) {
        //\Log::error("⛔ No prefix found for AttID " . $data['AttID']);
        Flash::error('Invalid attachment type.');
        return redirect()->route('primaryDatas.show', ['primaryData' => $data['CaseID']]);
    }

    if ($request->hasFile('AttFile')) {
        //\Log::info('✅ New file uploaded');
        $file = $request->file('AttFile');
        $extension = $file->getClientOriginalExtension();

        $newFileName = $prefix . '_' . $data['CaseID'] . '.' . $extension;
        $file->move(public_path('Files'), $newFileName);

        $data['AttPath'] = '\\\\svr\\RAKcMainApp$\\Files\\' . $newFileName;

        //\Log::info('📂 File moved to:', [public_path('Files/' . $newFileName)]);
    } else {
        //\Log::info('⚠️ No new file uploaded');

        // Get old file path info
        $oldPath = $attachment->AttPath;
        $oldPathLocal = str_replace('\\\\svr\\RAKcMainApp$\\Files\\', '', $oldPath);
        $oldFilePath = public_path('Files/' . $oldPathLocal);

        $extension = pathinfo($oldPathLocal, PATHINFO_EXTENSION);
        $newFileName = $prefix . '_' . $data['CaseID'] . '.' . $extension;
        $newFilePath = public_path('Files/' . $newFileName);

        // Rename the file if it exists and has a different name
        if (file_exists($oldFilePath) && $oldFilePath !== $newFilePath) {
            rename($oldFilePath, $newFilePath);
            //\Log::info("📛 File renamed to: " . $newFilePath);
        }

        $data['AttPath'] = '\\\\svr\\RAKcMainApp$\\Files\\' . $newFileName;
    }
    $newRecord = [
        'CaseID' => $data['CaseID'],
        'AttID' => $data['AttID'],
        'AttPath' => $data['AttPath'],
        'Remarks' => $data['Remarks'],
    ];

    AuditHelper::logAudit('updated', $attachment, $attachment->getAttributes(), $newRecord);
    DB::table('attachments')->where('id', $id)->update([
        'CaseID' => $data['CaseID'],
        'AttID' => $data['AttID'],
        'AttPath' => $data['AttPath'],
        'Remarks' => $data['Remarks'],
    ]);

    //\Log::info('✅ Attachment updated:', $data);
    session()->flash('success', 'Attachment updated successfully.');
    Flash::success('Attachment updated successfully.');
    return redirect()
    ->route('primaryDatas.show', ['primaryData' => $data['CaseID']])
    ->with('success', 'Attachment updated successfully.')
    ->withFragment('attachments');
//return redirect()->route('primaryDatas.show', ['primaryData' => $data['CaseID']]);
}*/


public function update($id, Request $request)
{
    $referer = $request->headers->get('referer');
    $isSubmission = str_contains($referer, '/primaryDatasSubmissions/');
    $table = $isSubmission ? 'attachments_submissions' : 'attachments';
    $routeName = $isSubmission ? 'primaryDatasSubmissions.show' : 'primaryDatas.show';
    $routeParamKey = $isSubmission ? 'primaryDatasSubmission' : 'primaryData';

    $attachment = \Illuminate\Support\Facades\DB::table($table)->where('ID', $id)->first();

    if (!$attachment) {
        Flash::error('Attachment not found.');
        return redirect()->route('attachments.index');
    }

    $data = $request->all();
    $prefix = \Illuminate\Support\Facades\DB::table('attachment_types')->where('ID', $data['AttID'])->value('Prefix');
    if (!$prefix) {
        Flash::error('Invalid attachment type.');
        return redirect()->route($routeName, [$routeParamKey => $attachment->CaseID]);
    }

    if ($request->hasFile('AttFile')) {
        $file = $request->file('AttFile');
        $extension = $file->getClientOriginalExtension();

        $newFileName = $prefix . '_' . $attachment->CaseID . '.' . $extension;
        $file->move(public_path('Files'), $newFileName);

        $data['AttPath'] = '\\\\svr\\RAKcMainApp$\\Files\\' . $newFileName;
    } else {
        $data['AttPath'] = $attachment->AttPath;
    }

    \Illuminate\Support\Facades\DB::table($table)->where('ID', $id)->update([
        'AttID' => $data['AttID'],
        'AttPath' => $data['AttPath'],
        'Remarks' => $data['Remarks'],
    ]);

    Flash::success('Attachment updated successfully.');
    return redirect()->route($routeName, [$routeParamKey => $attachment->CaseID])->withFragment('attachments');
}





 
  
    /*public function destroy($ID)
    {
        // Get the attachment record
        $attachment = \Illuminate\Support\Facades\DB::table('attachments')->where('ID', $ID)->first();

        if (!$attachment) {
            return redirect()->route('attachments.index')->with('error', 'Attachment not found');
        }

        // Get prefix from attachment_types table
        $prefix = \Illuminate\Support\Facades\DB::table('attachment_types')->where('ID', $attachment->AttID)->value('Prefix');

        if (!$prefix) {
            return redirect()->route('attachments.index')->with('error', 'Attachment type not found');
        }

        // Extract file extension from AttPath
        $pathParts = pathinfo($attachment->AttPath);
        $extension = $pathParts['extension'] ?? null;

        if ($extension) {
            $fileName = $prefix . '_' . $attachment->CaseID . '.' . $extension;
            $filePath = public_path('Files/' . $fileName);

            // Delete the file from public/Files
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
        AuditHelper::logAudit('deleted', $attachment, $attachment->getAttributes(), []);
        // Delete the record from the database
        \Illuminate\Support\Facades\DB::table('attachments')->where('ID', $ID)->delete();
        session()->flash('success', 'Attachment deleted successfully.');
        return redirect()->route('primaryDatas.show', ['primaryData' => $attachment->CaseID]);//return redirect()->route('attachments.index')->with('success', 'Attachment deleted successfully!');
    }*/

public function destroy($id, Request $request)
{
    $referer = $request->headers->get('referer');
    $isSubmission = str_contains($referer, '/primaryDatasSubmissions/');
    $table = $isSubmission ? 'attachments_submissions' : 'attachments';
    $routeName = $isSubmission ? 'primaryDatasSubmissions.show' : 'primaryDatas.show';
    $routeParamKey = $isSubmission ? 'primaryDatasSubmission' : 'primaryData';

    $attachment = \Illuminate\Support\Facades\DB::table($table)->where('ID', $ID)->first();

    if (!$attachment) {
        return redirect()->route('attachments.index')->with('error', 'Attachment not found');
    }

    $prefix = \Illuminate\Support\Facades\DB::table('attachment_types')->where('ID', $attachment->AttID)->value('Prefix');

    if ($prefix) {
        $pathParts = pathinfo($attachment->AttPath);
        $extension = $pathParts['extension'] ?? null;

        if ($extension) {
            $fileName = $prefix . '_' . $attachment->CaseID . '.' . $extension;
            $filePath = public_path('Files/' . $fileName);

            if (\Illuminate\Support\Facades\File::exists($filePath)) {
                \Illuminate\Support\Facades\File::delete($filePath);
            }
        }
    }

    \Illuminate\Support\Facades\DB::table($table)->where('ID', $ID)->delete();

    session()->flash('success', 'Attachment deleted successfully.');
    return redirect()->route($routeName, [$routeParamKey => $attachment->CaseID])->withFragment('attachments');
}










    // public function storeOrUpdate(Request $request)
    // {
    //     $validated = $request->validate([
    //         'CaseID' => 'required|integer',
    //         'AttID' => 'required|integer',
    //         'AttFile' => 'required|file|mimes:pdf',
    //         'Remarks' => 'nullable|string',
    //         'ID' => 'nullable|integer'
    //     ]);

    //     $caseId = $validated['CaseID'];
    //     $attId = $validated['AttID'];
    //     $file = $request->file('AttFile');

    //     $filename = $file->getClientOriginalName();
    //     $extension = $file->getClientOriginalExtension();
    //     $newFileName = $attId . '_' . $caseId . '.' . $extension;

    //     $file->move(public_path('Files'), $newFileName);
    //     $relativePath = '\\\\svr\\RAKcMainApp$\\Files\\' . $newFileName;

    //     $existing = Attachment::where('CaseID', $caseId)->where('AttID', $attId)->first();
    //     if ($existing && empty($validated['ID'])) {
    //         return back()->withErrors(['This attachment type already exists for this case.']);
    //     }

    //     Attachment::updateOrCreate(
    //         ['ID' => $request->ID],
    //         [
    //             'CaseID' => $caseId,
    //             'AttID' => $attId,
    //             'AttPath' => $relativePath,
    //             'Remarks' => $validated['Remarks'],
    //         ]
    //     );

    //     return redirect()->back()->with('success', 'Attachment saved successfully.');
    // }
    public function storeOrUpdate(Request $request)
    {
        
        //\Log::info('primary data request data:');
        $validated = $request->validate([
            //'CaseID' => 'required|integer',
            'AttID' => 'required|integer',
            'AttFile' => 'nullable|file|mimes:pdf|max:10240',
            'Remarks' => 'nullable|string',
            'ID' => 'nullable|integer'
        ]);
        $attachment = $this->attachmentRepository->find($request->ID);
        //$caseId = $validated['CaseID'];
        $attId = $validated['AttID'];

        $existing = Attachment::where('ID', $request->ID)->first();//$existing = Attachment::where('CaseID', $caseId)->where('AttID', $attId)->first();

        /*if ($existing && empty($validated['ID'])) {
            return back()->withErrors(['This attachment type already exists for this case.']);
        }*/

        $relativePath = $existing?->AttPath ?? null;

        if ($request->hasFile('AttFile')) {
            $file = $request->file('AttFile');
            $extension = $file->getClientOriginalExtension();
            $newFileName = $attId . '_' . $caseId . '.' . $extension;
            $file->move(public_path('Files'), $newFileName);
            $relativePath = '\\\\svr\\RAKcMainApp$\\Files\\' . $newFileName;
        }
        \Log::info('➡ before storeOrUpdate() triggered' . $relativePath . ' ' . $caseId . ' ' . $attId . $request->ID);
        Attachment::updateOrCreate(
            ['ID' => $request->ID],
            [
                'CaseID' => $caseId,
                'AttID' => $attId,
                'AttPath' => $relativePath,
                'Remarks' => $validated['Remarks'],
            ]
        );
        //\Log::info('➡ after storeOrUpdate() triggered' );
        

        return redirect()->back()->with('success', 'Attachment saved successfully.');
    }


}
