<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectSupervisionRequest;
use App\Http\Requests\UpdateProjectSupervisionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectSupervisionRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\File;

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
            'supervisionType'
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
            'supervisions'
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
    public function store(Request $request, $projectId)
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

    \App\Models\ProjectSupervision::create([
        'project_id' => $projectId,
        'supervision_type_id' => $request->supervision_type_id,
        'user_id' => auth()->id(),
        'note' => $request->note,
        //'edit_type' => $request->edit_type,
        'attachment' => $fileName,
    ]);

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

        return view('project_supervisions.show')->with('projectSupervision', $projectSupervision);
    }

    /**
     * Show the form for editing the specified ProjectSupervision.
     */
   public function edit($projectId, $id)
{
    $projectSupervision = $this->projectSupervisionRepository->find($id);

    $stages = \App\Models\SupervisionType::pluck('name_ar', 'id');
    $users = \App\Models\User::pluck('name', 'id');

    return view('project_supervisions.edit', compact(
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

           return redirect()->route('projects.supervisions.index', $projectSupervision->project_id); 
        }


$projectSupervision = $this->projectSupervisionRepository->find($id);

if (empty($projectSupervision)) {
    Flash::error('Project Supervision not found');

    return redirect()->route('projects.supervisions.index', $projectId);
}

$this->projectSupervisionRepository->update($request->all(), $id);

return redirect()->route('projects.supervisions.index', $projectId);
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
    if (!empty($projectSupervision->attachment)) {

        $filePath = public_path('Files/' . $projectSupervision->attachment);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }

    // 🔴 حذف السجل من الداتابيز
    $this->projectSupervisionRepository->delete($id);

    Flash::success('Project Supervision deleted successfully.');

    return redirect()->route('projects.supervisions.index', $projectId);
}
}
