<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectSupervisionRequest;
use App\Http\Requests\UpdateProjectSupervisionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectSupervisionRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class ProjectSupervisionController extends AppBaseController
{
    /** @var ProjectSupervisionRepository $projectSupervisionRepository*/
    private $projectSupervisionRepository;

    public function __construct(ProjectSupervisionRepository $projectSupervisionRepo)
    {
        $this->projectSupervisionRepository = $projectSupervisionRepo;
    }

    /**
     * Display a listing of the ProjectSupervision.
     */
    public function index(Request $request, $projectId)
    {
        $project = \App\Models\Project::findOrFail($projectId);

        $supervisions = \App\Models\ProjectSupervision::with([
            'user',
            'supervisionType',
            'attachments'
        ])
        ->where('project_id', $projectId)
        ->orderBy('created_at')//->latest()
        ->get();





        $totalSupervisionsCount = \App\Models\ProjectSupervision::where(
    'project_id',
    $project->id
)->count();

$currentMonthSupervisionsCount = \App\Models\ProjectSupervision::where(
    'project_id',
    $project->id
)
->whereMonth('created_at', now()->month)
->whereYear('created_at', now()->year)
->count();

$project->total_supervisions_count = $totalSupervisionsCount;

$project->current_month_supervisions_count = $currentMonthSupervisionsCount;

        return view('project_supervisions.index', compact(
            'project',
            'supervisions',
            
        ));
    }

    /**
     * Show the form for creating a new ProjectSupervision.
     */
public function create(\App\Models\Project $project)
{
    $stages = \App\Models\SupervisionType::pluck('name_ar', 'id');

    $users = \App\Models\User::pluck('name', 'id');




    return view(
        'project_supervisions.create',
        compact(
            'project',
            'stages',
            'users'
        )
    );
}

    /**
     * Store a newly created ProjectSupervision in storage.
     */
    /*public function store(Request $request, $projectId)
{
    $request->validate([
        'supervision_type_id' => 'required',
        'note' => 'required',
        'attachment' => 'nullable|file'
    ]);

    $fileName = null;

    if ($request->hasFile('attachment')) {

        $file = $request->file('attachment');

        $fileName = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('Files'), $fileName);
    }
    $fileName1 = null;

    if ($request->hasFile('attachment1')) {

        $file = $request->file('attachment1');

        $fileName1 = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('Files'), $fileName1);
    }

$fileName2 = null;
    if ($request->hasFile('attachment2')) {

        $file = $request->file('attachment2');

        $fileName2 = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('Files'), $fileName2);
    }
$fileName3 = null;
    if ($request->hasFile('attachment3')) {

        $file = $request->file('attachment3');

        $fileName3 = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('Files'), $fileName3);
    }

    \App\Models\ProjectSupervision::create([
        'project_id' => $projectId,
        'supervision_type_id' => $request->supervision_type_id,
        'user_id' => auth()->id(),
        'note' => $request->note,
        //'edit_type' => $request->edit_type,
        'attachment' => $fileName,
        'attachment1' => $fileName1,
        'attachment2' => $fileName2,
        'attachment3' => $fileName3,
        
    ]);

    return redirect()
        ->route('projects.supervisions.index', $projectId)
        ->with('success', 'تم إضافة الإشراف بنجاح');
}*/









public function store(Request $request, $projectId)
{
    $request->validate([
        'supervision_type_id' => 'required',
        'note' => 'required',
        'attachment' => 'nullable|file|max:10240',
        'attachment1' => 'nullable|file|max:10240',
        'attachment2' => 'nullable|file|max:10240',
        'attachment3' => 'nullable|file|max:10240',
        'attachments.*' => 'nullable|file|max:10240'
    ]);

    $supervision = \App\Models\ProjectSupervision::create([

        'project_id' => $projectId,
        'supervision_type_id' => $request->supervision_type_id,
        'user_id' => $request->user_id ?: auth()->id(),
        'note' => $request->note,

    ]);

    $this->saveSupervisionFiles($request, $supervision);

    if ($request->action === 'save_attachments') {

    /*return redirect()->route(
        'attachments.create',
        [
            'id'   => $supervision->id,
            'type' => 'supervisions'
        ]
    );*/

    return redirect()->route('users.attachments.create', [
                'id'   => $supervision->id,
                'type' => 'supervisions',
                'projectId' =>$projectId
                //'mode' => 'supervisions'
            ])->with('toast', [
                'type'    => 'success',
                'message' => __('Project updated successfully. You can now upload attachments.')
            ]);
}

    // رفع المرفقات
    if ($request->hasFile('attachments')) {

        foreach ($request->file('attachments') as $file) {

            $filename =
                $supervision->id .
                '_supervision_' .
                time() .
                '_' .
                uniqid() .
                '.' .
                $file->getClientOriginalExtension();

            $path = public_path('Files');

            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }

            $file->move($path, $filename);

            \App\Models\Attachment::create([

                'attachable_id'   => $supervision->id,

                'attachable_type' =>
                    \App\Models\ProjectSupervision::class,

                // نوع مرفق خاص بالإشراف
                'attachment_type_id' => 60,

                'file_name' => $file->getClientOriginalName(),

                'file_type' =>
                    $file->getClientOriginalExtension(),

                'AttPath' =>
                    '\\\\svr\\RAKcMainApp$\\Files\\' . $filename,

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return redirect()
        ->route('projects.supervisions.index', $projectId)
        ->with('success', 'تم إضافة الإشراف بنجاح');
}





    /**
     * Display the specified ProjectSupervision.
     */
    public function show($id)
    {
        $projectSupervision = $this->projectSupervisionRepository->find($id);

        if (empty($projectSupervision)) {
            Flash::error('Project Supervision not found');

            return redirect(route('projectSupervisions.index'));
        }

        $project = $projectSupervision->project;

        return view('project_supervisions.show', compact('projectSupervision', 'project'));
    }

    /**
     * Show the form for editing the specified ProjectSupervision.
     */
   public function edit($projectId, $id)
{
    $projectSupervision = $this->projectSupervisionRepository->find($id);
    $project = \App\Models\Project::findOrFail($projectId);

    $stages = \App\Models\SupervisionType::pluck('name_ar', 'id');
    $users = \App\Models\User::pluck('name', 'id');

    return view('project_supervisions.edit', compact(
        'project',
        'projectSupervision',
        'stages',
        'users'
    ));
}

    /**
     * Update the specified ProjectSupervision in storage.
     */
   public function update($projectId, $id, UpdateProjectSupervisionRequest $request)
    {
        $projectSupervision = $this->projectSupervisionRepository->find($id);

        if (empty($projectSupervision)) {
            Flash::error('Project Supervision not found');

           return redirect()->route('projects.supervisions.index', $projectId); 
        }


$projectSupervision = $this->projectSupervisionRepository->find($id);

if (empty($projectSupervision)) {
    Flash::error('Project Supervision not found');

    return redirect()->route('projects.supervisions.index', $projectId);
}

$this->projectSupervisionRepository->update(
    $request->only([
        'project_id',
        'user_id',
        'supervision_type_id',
        'note',
    ]),
    $id
);

$projectSupervision = \App\Models\ProjectSupervision::findOrFail($id);
$this->saveSupervisionFiles($request, $projectSupervision);

return redirect()->route('projects.supervisions.index', $projectId);
    }


public function previewPdf(Request $request, $projectId, $id)
{
    $project = \App\Models\Project::with([
        'ownerUser',
        'contractorUser',
        'projectName',
    ])->findOrFail($projectId);

    $supervision = \App\Models\ProjectSupervision::with([
        'user',
        'supervisionType',
        'attachments',
    ])
        ->where('project_id', $projectId)
        ->findOrFail($id);

    $imageAttachments = $this->supervisionImageFiles($supervision);

    $html = view('pdf.contract_supervision', compact(
        'project',
        'supervision',
        'imageAttachments'
    ))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_footer' => 5,
        'margin_top' => 35,
        'margin_left' => 10,
        'margin_right' => 10,
        'margin_bottom' => 8,
    ]);

    $mpdf->SetHTMLHeader('
        <div style="text-align:center;">
            <img src="'.public_path('images/tender_logo.jpeg').'"
                 style="height:90px;width:60%;">
        </div>
    ');

    $mpdf->WriteHTML($html);

    $fileName = 'supervision_report_'.$supervision->id.'.pdf';
    $action = $request->get('action', 'preview');

    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    return $mpdf->Output($fileName, 'I');
}

    /**
     * Remove the specified ProjectSupervision from storage.
     *
     * @throws \Exception
     */


public function destroy($projectId, $id)
{
    $projectSupervision = $this->projectSupervisionRepository->find($id);

    if (empty($projectSupervision)) {
        Flash::error('Project Supervision not found');

        return redirect()->route('projects.supervisions.index', $projectId);
    }

    // 🔴 حذف الملف إذا موجود
    foreach ($this->supervisionAttachmentFields() as $field) {
        $this->deletePublicFile($projectSupervision->{$field} ?? null);
    }

    // 🔴 حذف السجل من الداتابيز
    $this->projectSupervisionRepository->delete($id);

    Flash::success('Project Supervision deleted successfully.');

    return redirect()->route('projects.supervisions.index', $projectId);
}

private function supervisionAttachmentFields(): array
{
    return [
        'attachment',
        'attachment1',
        'attachment2',
        'attachment3',
    ];
}

private function saveSupervisionFiles(Request $request, \App\Models\ProjectSupervision $supervision): void
{
    $updates = [];

    foreach ($this->supervisionAttachmentFields() as $field) {
        if (!$request->hasFile($field)) {
            continue;
        }

        $file = $request->file($field);

        if (!$file || !$file->isValid()) {
            continue;
        }

        $this->deletePublicFile($supervision->{$field} ?? null);

        $filename = $supervision->id
            .'_'.$field.'_'
            .time()
            .'_'
            .uniqid()
            .'.'
            .$file->getClientOriginalExtension();

        $path = public_path('Files');

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $file->move($path, $filename);

        $updates[$field] = $filename;
    }

    $this->fillAvailableAttachmentNotes($request, $updates);

    if ($updates) {
        $supervision->forceFill($updates)->save();
    }
}

private function fillAvailableAttachmentNotes(Request $request, array &$updates): void
{
    $noteColumns = [
        'attachment_note' => ['attachment_note'],
        'attachment1_note' => ['attachment1_note', 'attachment_note1'],
        'attachment_note1' => ['attachment_note1', 'attachment1_note'],
        'attachment2_note' => ['attachment2_note', 'attachment_note2'],
        'attachment_note2' => ['attachment_note2', 'attachment2_note'],
        'attachment3_note' => ['attachment3_note', 'attachment_note3'],
        'attachment_note3' => ['attachment_note3', 'attachment3_note'],
    ];

    foreach ($noteColumns as $column => $inputs) {
        if (!Schema::hasColumn('project_supervisions', $column)) {
            continue;
        }

        foreach ($inputs as $input) {
            if ($request->has($input)) {
                $updates[$column] = $request->input($input);
                break;
            }
        }
    }
}

private function supervisionImageFiles(\App\Models\ProjectSupervision $supervision): array
{
    $images = [];
    $seen = [];

    foreach ($this->supervisionAttachmentFields() as $field) {
        $fileName = $supervision->{$field} ?? null;

        if (!$fileName) {
            continue;
        }

        $this->addImageFile(
            $images,
            $seen,
            public_path('Files/'.$fileName),
            $fileName
        );
    }

    foreach ($supervision->attachments as $attachment) {
        $path = $this->attachmentPublicPath($attachment);

        if (!$path) {
            continue;
        }

        $this->addImageFile(
            $images,
            $seen,
            $path,
            $attachment->file_name ?: basename($path)
        );
    }

    return array_slice($images, 0, 4);
}

private function addImageFile(array &$images, array &$seen, string $path, string $name): void
{
    $key = strtolower(str_replace('\\', '/', $path));

    if (isset($seen[$key]) || !$this->isImageFile($path)) {
        return;
    }

    $seen[$key] = true;

    $images[] = [
        'path' => $path,
        'name' => $name,
    ];
}

private function attachmentPublicPath(\App\Models\Attachment $attachment): ?string
{
    if (!$attachment->AttPath) {
        return null;
    }

    $normalized = str_replace('\\', '/', $attachment->AttPath);
    $fileName = basename($normalized);

    if (!$fileName) {
        return null;
    }

    return public_path('Files/'.$fileName);
}

private function isImageFile(?string $path): bool
{
    if (!$path || !File::exists($path)) {
        return false;
    }

    $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

    if (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'], true)) {
        return false;
    }

    return @getimagesize($path) !== false;
}

private function deletePublicFile(?string $fileName): void
{
    if (!$fileName) {
        return;
    }

    $filePath = public_path('Files/'.$fileName);

    if (File::exists($filePath)) {
        File::delete($filePath);
    }
}
}
