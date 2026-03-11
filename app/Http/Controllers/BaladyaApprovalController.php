<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBaladyaApprovalRequest;
use App\Http\Requests\UpdateBaladyaApprovalRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BaladyaApprovalRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\Project;
use App\Models\BaladyaApproval;
use App\Models\BaladyaStatusType;

class BaladyaApprovalController extends AppBaseController
{
    /** @var BaladyaApprovalRepository $baladyaApprovalRepository*/
    private $baladyaApprovalRepository;

    public function __construct(BaladyaApprovalRepository $baladyaApprovalRepo)
    {
        $this->baladyaApprovalRepository = $baladyaApprovalRepo;
    }

    /**
     * Display a listing of the BaladyaApproval.
     */
    /*public function index(Request $request)
    {
        $baladyaApprovals = $this->baladyaApprovalRepository->paginate(10);

        return view('baladya_approvals.index')
            ->with('baladyaApprovals', $baladyaApprovals);
    }*/


    /*public function index(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);

        $baladyaApprovals = BaladyaApproval::where('project_id', $project->id)
            ->when($request->owner_id, function ($q) use ($request) {
                $q->where('owner_id', $request->owner_id);
            })
            ->latest()
            ->paginate(10);
            $statusTypes = BaladyaStatusType::pluck(
                app()->getLocale() == 'ar' ? 'name_ar' : 'name_en',
                'id'
            );

            return view('baladya_approvals.index', compact(
                'baladyaApprovals',
                'project',
                'statusTypes'
            ));
    }*/
    // public function index($projectId)
    // {
    //     $ownerId = request('owner_id');
    //     $project = Project::find($projectId);
    //     $baladyaApprovals = BaladyaApproval::where('project_id', $projectId)
    //         ->when($ownerId, fn($q) => $q->where('owner_id', $ownerId))
    //         ->latest()
    //         ->paginate(10);

    //     $statusTypes = \App\Models\BaladyaStatusType::pluck('name_ar', 'id')->where('active', 1);

    //     $editId = request('edit_id'); // ID الذي سيتم تعديله
    //     $editApproval = $editId ? BaladyaApproval::find($editId) : null;

    //     return view('baladya_approvals.index', compact(
    //         'baladyaApprovals', 
    //         'statusTypes', 
    //         'projectId', 
    //         'editApproval',
    //         'project'
    //     ))->with('owner_id', $ownerId);
    // }


public function index($projectId) 
{
    if (FALSE){//!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
    $ownerId = request('owner_id');
    $project = \App\Models\Project::find($projectId);

    $baladyaApprovals = BaladyaApproval::where('project_id', $projectId)
        ->when($ownerId, fn($q) => $q->where('owner_id', $ownerId))
        ->orderBy('created_at')//->latest() // latest created first
        ->paginate(15);//7
 
    $statusTypes = \App\Models\BaladyaStatusType::where('active', 1)->pluck('name_ar', 'id');

    $editId = request('edit_id'); // ID الذي سيتم تعديله
    $editApproval = $editId ? BaladyaApproval::find($editId) : null;

    return view('baladya_approvals.index', compact(
        'baladyaApprovals', 
        'statusTypes', 
        'projectId', 
        'editApproval',
        'project'
    ));//->with('owner_id', $ownerId);
}




    /**
     * Show the form for creating a new BaladyaApproval.
     */
    public function create($projectId)
{
    if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
    $statusTypes = \App\Models\BaladyaStatusType::where('active', 1)->pluck('name_ar', 'id');
    
    return view('baladya_approvals.create', compact('projectId', 'statusTypes'))
           ->with('owner_id', request('owner_id'));
}


    /**
     * Store a newly created BaladyaApproval in storage.
     */


    /*public function store(CreateBaladyaApprovalRequest $request, $projectId)
    {

        

        $input = $request->all();

        $input['project_id'] = $projectId;


        
        if ($request->hasFile('approved_file') && $request->file('approved_file')->isValid()) {
            $file = $request->file('approved_file');
            
            $filename = $projectId . '_baladya_' . time() . '_' . $file->getClientOriginalName();
            
            // حفظ الملف في public/Files
            $file->move(public_path('Files'), $filename);

            // حفظ اسم الملف في قاعدة البيانات
            $input['approved_file'] = $filename;
        }
        if ($request->hasFile('building_license_file')) {
            $file = $request->file('building_license_file');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move(public_path('Files'), $filename);
            $baladyaApproval->building_license_file = $filename;
        }



        $baladyaApproval->building_license_number = $request->building_license_number;
        //$baladyaApproval->save();


        $this->baladyaApprovalRepository->create($input);

        //Flash::success(__('تم حفظ اعتماد البلدية بنجاح'));


        //  return redirect()->route('projects.baladya-approvals.index', $projectId)
        //              ->with([
        //                  'toast' => [
        //                      'type' => 'success',
        //                      'message' => __('تم حفظ اعتماد البلدية بنجاح')
        //                  ],
        //                  'owner_id' => request('owner_id')
        //              ]);
        return redirect()->route('projects.baladya-approvals.index', [
            'project' => $projectId,
            //'owner_id' => request('owner_id')
        ])->with([
            'toast' => [
                'type' => 'success',
                'message' => __('تم حفظ اعتماد البلدية بنجاح')
            ]
        ]);

    }*/



        public function store(CreateBaladyaApprovalRequest $request, $projectId)
{
    if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
    $input = $request->all();
    $input['project_id'] = $projectId;

    /** ✅ الملف المعتمد */
    if ($request->hasFile('approved_file') && $request->file('approved_file')->isValid()) {
        $file = $request->file('approved_file');
        $filename = $projectId.'_baladya_'.time().'_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $filename);
        $input['approved_file'] = $filename;
    }




    if ($request->hasFile('etisalat_file') && $request->file('etisalat_file')->isValid()) {
        $file = $request->file('etisalat_file');
        $filename = $projectId.'_baladya_'.time().'_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $filename);
        $input['etisalat_file'] = $filename;
    }
    if ($request->hasFile('water_file') && $request->file('water_file')->isValid()) {
        $file = $request->file('water_file');
        $filename = $projectId.'_baladya_'.time().'_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $filename);
        $input['water_file'] = $filename;
    }
    if ($request->hasFile('electrical_file') && $request->file('electrical_file')->isValid()) {
        $file = $request->file('electrical_file');
        $filename = $projectId.'_baladya_'.time().'_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $filename);
        $input['electrical_file'] = $filename;
    }
    if ($request->hasFile('civil_file') && $request->file('civil_file')->isValid()) {
        $file = $request->file('civil_file');
        $filename = $projectId.'_baladya_'.time().'_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $filename);
        $input['civil_file'] = $filename;
    }
    if ($request->hasFile('architect_file') && $request->file('architect_file')->isValid()) {
        $file = $request->file('architect_file');
        $filename = $projectId.'_baladya_'.time().'_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $filename);
        $input['architect_file'] = $filename;
    }


    /** ✅ ملف رخصة البناء */
    if ($request->hasFile('building_license_file') && $request->file('building_license_file')->isValid()) {
        $file = $request->file('building_license_file');
        $filename = $projectId.'_license_'.time().'_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $filename);
        $input['building_license_file'] = $filename;
    }

    /** ✅ رقم رخصة البناء */
    $input['building_license_number'] = $request->building_license_number;

    /** ✅ إنشاء السجل */
    $this->baladyaApprovalRepository->create($input);

    return redirect()->route('projects.baladya-approvals.index', [
        'project' => $projectId
    ])->with([
        'toast' => [
            'type' => 'success',
            'message' => __('تم حفظ اعتماد البلدية بنجاح')
        ]
    ]);
}


    

    /**
     * Display the specified BaladyaApproval.
     */
    public function show($id)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $baladyaApproval = $this->baladyaApprovalRepository->find($id);

        if (empty($baladyaApproval)) {
            Flash::error('Baladya Approval not found');

            return redirect(route('baladyaApprovals.index'));
        }

        return view('baladya_approvals.show')->with('baladyaApproval', $baladyaApproval);
    }

    /**
     * Show the form for editing the specified BaladyaApproval.
     */

    public function edit($projectId, $id)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $baladyaApproval = $this->baladyaApprovalRepository->find($id);
        if (!$baladyaApproval) {
            Flash::error(__('اعتماد البلدية غير موجود'));
            return redirect()->route('projects.baladya-approvals.index', $projectId)
                            ->with('owner_id', request('owner_id'));
        }

       $statusTypes = \App\Models\BaladyaStatusType::where('active', 1)
            ->pluck('name_ar', 'id');


        return view('baladya_approvals.edit', compact('baladyaApproval', 'projectId', 'statusTypes'))
            ->with('owner_id', request('owner_id'));
    }

// تحديث الاعتماد
    public function update(CreateBaladyaApprovalRequest $request, $projectId, $id)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $baladyaApproval = $this->baladyaApprovalRepository->find($id);
        if (!$baladyaApproval) {
            Flash::error(__('اعتماد البلدية غير موجود'));
            return redirect()->route('projects.baladya-approvals.index', $projectId)
                            ->with('owner_id', request('owner_id'));
        }

        $input = $request->all();


        // حذف الملفات
$files = [
    'approved_file',
    'architect_file',
    'civil_file',
    'electrical_file',
    'water_file',
    'etisalat_file',
    'building_license_file'
];

foreach ($files as $fileField) {

    if ($request->input($fileField.'_delete') == 1 && $baladyaApproval->$fileField) {

        $path = public_path('Files/'.$baladyaApproval->$fileField);

        if (file_exists($path)) {
            unlink($path);
        }

        $input[$fileField] = null;
    }

}
        
        if ($request->hasFile('approved_file') && $request->file('approved_file')->isValid()) {
            
            $file = $request->file('approved_file');
            
            $filename = $baladyaApproval->id . '_baladya_' . time() . '_' . $file->getClientOriginalName();
            
            // حفظ الملف في public/Files
            $file->move(public_path('Files'), $filename);
            //dd($input['approved_file'].'---'.$filename);
            // حفظ اسم الملف في قاعدة البيانات
            $input['approved_file'] = $filename;
        }






if ($request->hasFile('architect_file') && $request->file('architect_file')->isValid()) {
            
            $file = $request->file('architect_file');
            
            $filename = $baladyaApproval->id . '_baladya_' . time() . '_' . $file->getClientOriginalName();
            
            // حفظ الملف في public/Files
            $file->move(public_path('Files'), $filename);
            //dd($input['approved_file'].'---'.$filename);
            // حفظ اسم الملف في قاعدة البيانات
            $input['architect_file'] = $filename;
        }
        if ($request->hasFile('civil_file') && $request->file('civil_file')->isValid()) {
            
            $file = $request->file('civil_file');
            
            $filename = $baladyaApproval->id . '_baladya_' . time() . '_' . $file->getClientOriginalName();
            
            // حفظ الملف في public/Files
            $file->move(public_path('Files'), $filename);
            //dd($input['civil_file'].'---'.$filename);
            // حفظ اسم الملف في قاعدة البيانات
            $input['civil_file'] = $filename;
        }
        if ($request->hasFile('electrical_file') && $request->file('electrical_file')->isValid()) {
            
            $file = $request->file('electrical_file');
            
            $filename = $baladyaApproval->id . '_baladya_' . time() . '_' . $file->getClientOriginalName();
            
            // حفظ الملف في public/Files
            $file->move(public_path('Files'), $filename);
            //dd($input['electrical_file'].'---'.$filename);
            // حفظ اسم الملف في قاعدة البيانات
            $input['electrical_file'] = $filename;
        }
        if ($request->hasFile('water_file') && $request->file('water_file')->isValid()) {
            
            $file = $request->file('water_file');
            
            $filename = $baladyaApproval->id . '_baladya_' . time() . '_' . $file->getClientOriginalName();
            
            // حفظ الملف في public/Files
            $file->move(public_path('Files'), $filename);
            //dd($input['water_file'].'---'.$filename);
            // حفظ اسم الملف في قاعدة البيانات
            $input['water_file'] = $filename;
        }
        if ($request->hasFile('etisalat_file') && $request->file('etisalat_file')->isValid()) {
            
            $file = $request->file('etisalat_file');
            
            $filename = $baladyaApproval->id . '_baladya_' . time() . '_' . $file->getClientOriginalName();
            
            // حفظ الملف في public/Files
            $file->move(public_path('Files'), $filename);
            //dd($input['etisalat_file'].'---'.$filename);
            // حفظ اسم الملف في قاعدة البيانات
            $input['etisalat_file'] = $filename;
        }















        

        if ($request->hasFile('building_license_file') && $request->file('building_license_file')->isValid()) {
            
            $file = $request->file('building_license_file');
            
            $filename = $baladyaApproval->id . '_baladya_' . time() . '_' . $file->getClientOriginalName();
            
            // حفظ الملف في public/Files
            $file->move(public_path('Files'), $filename);
            //dd($input['approved_file'].'---'.$filename);
            // حفظ اسم الملف في قاعدة البيانات
            $input['building_license_file'] = $filename;
        }
        



        $baladyaApproval->building_license_number = $request->building_license_number;


        $this->baladyaApprovalRepository->update($input, $id);

        Flash::success(__('تم تعديل اعتماد البلدية بنجاح'));

        //return redirect()->route('projects.baladya-approvals.index', $projectId)
        //                ->with('owner_id', request('owner_id'));

        return redirect()->back()
            //->route('projects.baladya-approvals.index', [
            //    'project' => $projectId,
            //])
            ->with('toast', [
                'type' => 'success',
                'message' => __('اعتماد البلدية تم تعديله بنجاح'),
            ]);

    }


    /**
     * Remove the specified BaladyaApproval from storage.
     *
     * @throws \Exception
     */
    public function destroy($projectId, $id)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        //dd(request('owner_id'));
        $baladyaApproval = $this->baladyaApprovalRepository->find($id);

        if (empty($baladyaApproval)) {
            Flash::error(__('اعتماد البلدية غير موجود'));
            return redirect()->route('projects.baladya-approvals.index', $projectId)
                            ->with('owner_id', request('owner_id'));
        }

        $this->baladyaApprovalRepository->delete($id);

        Flash::success(__('تم حذف اعتماد البلدية بنجاح'));

        return redirect()
            ->route('projects.baladya-approvals.index', [
                'project' => $projectId,
                'owner_id' => request('owner_id'),
            ])
            ->with('toast', [
                'type' => 'success',
                'message' => __('اعتماد البلدية تم حذفه بنجاح'),
            ]);

    }


    

}
