<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Flash;
use Mpdf\Mpdf;


class ProjectController extends AppBaseController
{
    /** @var ProjectRepository $projectRepository*/
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepository = $projectRepo;
    }

    /**
     * Display a listing of the Project.
     */
    public function index(Request $request)
{
    $query = \App\Models\Project::with([
        'status',
        'ownerUser', // owner relation for name/phone
        'contractor',
        'baladyaApprovals' => fn($q) => $q->latest()->take(1),
    ]);

    // Filters
    if ($request->filled('project_code')) {
        $query->where('project_code', 'like', '%' . $request->project_code . '%');
    }


    if ($request->filled('qasima_number')) {
        $query->where('qasima_number', 'like', '%' . $request->qasima_number . '%');
    }

    if ($request->filled('owner_name')) {
        $query->whereHas('ownerUser', fn($q) => $q->where('name', 'like', '%' . $request->owner_name . '%'));
    }

    if ($request->filled('owner_phone')) {
        $query->whereHas('ownerUser', fn($q) => $q->where('mobile', 'like', '%' . $request->owner_phone . '%'));
    }

    $projects = $query->orderByDesc('created_at')->paginate(10);

    $toast = session('toast', null);

    return view('projects.index', compact('projects', 'toast'));
}




    /**
     * Show the form for creating a new Project.
     */
    public function create(Request $request)
    {
        $stages =  \App\Models\ProjectStage::where('active', 1)
            ->orderBy('order')
            ->pluck(
                app()->getLocale() === 'ar' ? 'name_ar' : 'name_en',
                'id'
            );
        $projectRegions = \App\Models\ProjectRegion::where('status', 1)
            ->pluck(
                app()->getLocale() === 'ar' ? 'name_ar' : 'name_en',
                'id'
            );
        $projectNames = \App\Models\ProjectName::where('status', 1)
        ->pluck(app()->getLocale() == 'ar' ? 'name_ar' : 'name_en', 'id');
        $statuses    = \App\Models\Status::pluck('name', 'id');
        $regions     = \App\Models\Region::where('status', 1)->pluck('region', 'id');
        $owners      = \App\Models\User::where('role_id', 2)->pluck('name', 'id');
        $contractors = \App\Models\User::where('role_id', 3)->pluck('name', 'id');
        $consultants = \App\Models\User::where('role_id', 7)->pluck('name', 'id');

        // ✅ Project attachment types
        $defaultTypes = [2, 10, 12, 4, 13, 14, 15, 16, 17, 18, 19, 20, 25];

        return view('projects.create', [
            'statuses'=>$statuses,
            'regions'=>$regions,
            'owners'=>$owners,
            'contractors'=>$contractors,
            'consultants'=>$consultants,
            'defaultTypes'=>$defaultTypes,
            'ownerId' => $request->owner_id,
            'contractorId' => $request->contractor_id,
            'stages'=>$stages,
            'projectNames'=>$projectNames,
            'projectRegions'=>$projectRegions,
        ]);
    }


    /**
     * Store a newly created Project in storage.
     */
    /*public function store(CreateProjectRequest $request)
    {
        $input = $request->all();

        // آخر مشروع
        $lastProject = \App\Models\Project::orderBy('id', 'desc')->first();

        $nextNumber = $lastProject ? $lastProject->id + 1 : 1;

        // SAV + YYMM + incremental
        $code = 'SAV' . date('ym') . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

        $input['project_code'] = $code;

        $project = $this->projectRepository->create($input);

        Flash::success('Project saved successfully.');

        
        return redirect()
            ->route('projects.index', $project->id)
            ->with('toast', [
                'type' => 'success',
                'message' => __('Project created successfully. You can now upload attachments.')
            ]);
        
        //return redirect(route('projects.index'));
    }*/


/*public function downloadAgreement($projectId)
{
    $project = \App\Models\Project::findOrFail($projectId);

    $html = view('pdf.contract', compact('project'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri'
    ]);

    $mpdf->WriteHTML($html);

    return $mpdf->Output(
        'contract_' . $project->id . '.pdf',
        'D'
    );
}*/

public function downloadAgreement($projectId)
{
    $project = \App\Models\Project::with(['ownerUser', 'contractorUser'])->findOrFail($projectId);

    $html = view('pdf.contract', compact('project'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);

    //$mpdf->WriteHTML($html);
    $mpdf->WriteHTML(view('pdf.contract', compact('project'))->render());
    // عرض داخل المتصفح (وليس تحميل)
    return $mpdf->Output('contract_'.$project->id.'.pdf', 'D');//I
}

public function contractPdf(Request $request, $id)
{
    $project = \App\Models\Project::with(['ownerUser', 'contractorUser'])->findOrFail($id);

    $html = view('pdf.contract', compact('project'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

    if ($action === 'download') {
        return $mpdf->Output("contract_{$project->id}.pdf", 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output("contract_{$project->id}.pdf", 'I'); // Browser print
    }

    // Default = preview
    return $mpdf->Output("contract_{$project->id}.pdf", 'I');
}


public function takleefContractPdf(Request $request, $id)
{
    $project = \App\Models\Project::with(['ownerUser'])->findOrFail($id);

    $html = view('pdf.takleef_contract', compact('project'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

    if ($action === 'download') {
        return $mpdf->Output("takleef_contract_{$project->id}.pdf", 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output("takleef_contract_{$project->id}.pdf", 'I');
    }

    return $mpdf->Output("takleef_contract_{$project->id}.pdf", 'I');
}


public function contractOwnerConsultantPdf(Request $request, $id)
{
    $project = \App\Models\Project::with(['ownerUser'])->findOrFail($id);

    $html = view('pdf.contract_owner_consultant', compact('project'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

    if ($action === 'download') {
        return $mpdf->Output("contract_owner_consultant_{$project->id}.pdf", 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output("contract_owner_consultant_{$project->id}.pdf", 'I'); // Browser print
    }

    return $mpdf->Output("contract_owner_consultant_{$project->id}.pdf", 'I');
}


public function hawyaContractPdf(Request $request, $id)
{
    $project = \App\Models\Project::with(['ownerUser'])->findOrFail($id);

    // Use the new Blade view
    $html = view('pdf.contract_hawya', compact('project'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

    if ($action === 'download') {
        return $mpdf->Output("contract_hawya_{$project->id}.pdf", 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output("contract_hawya_{$project->id}.pdf", 'I');
    }

    return $mpdf->Output("contract_hawya_{$project->id}.pdf", 'I');
}






public function siteDeliveryContractPdf(Request $request, $id)
{
    $project = \App\Models\Project::with(['ownerUser'])->findOrFail($id);

    $html = view('pdf.contract_site_delivery', compact('project'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

    if ($action === 'download') {
        return $mpdf->Output("site_delivery_contract_{$project->id}.pdf", 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output("site_delivery_contract_{$project->id}.pdf", 'I');
    }

    return $mpdf->Output("site_delivery_contract_{$project->id}.pdf", 'I');
}


public function bankContractPdf(Request $request, $id)
{
    $project = \App\Models\Project::with(['ownerUser'])->findOrFail($id);

    $html = view('pdf.contract_bank', compact('project'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

    if ($action === 'download') {
        return $mpdf->Output("bank_contract_{$project->id}.pdf", 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output("bank_contract_{$project->id}.pdf", 'I');
    }

    return $mpdf->Output("bank_contract_{$project->id}.pdf", 'I');
}



public function ownerRequirementContractPdf(Request $request, $id)
{
    $project = \App\Models\Project::with([
        'ownerUser',
        'contractorUser',
        'projectRegion',
        'ownerRequirements',
        'designPreferences'
    ])->findOrFail($id);
    $design = $project->designPreferences;
    // تقسيم الاحتياجات حسب الدور
    $requirements = $project->ownerRequirements
        ->groupBy('floor');

    $html = view(
        'pdf.contract_owner_requirements',
        compact('project', 'requirements','design')
    )->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

    return match ($action) {
        'download' => $mpdf->Output("owner_requirements_contract_{$project->id}.pdf", 'D'),
        'print'    => $mpdf->Output("owner_requirements_contract_{$project->id}.pdf", 'I'),
        default    => $mpdf->Output("owner_requirements_contract_{$project->id}.pdf", 'I'),
    };
}


public function bankTableContractPdf(Request $request, $id)
{
    $project = \App\Models\Project::with(['ownerUser', 'contractorUser'])->findOrFail($id);

    // Blade الجديد لـ Bank Table Contract
    $html = view('pdf.contract_bank_table', compact('project'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

    if ($action === 'download') {
        return $mpdf->Output("bank_table_contract_{$project->id}.pdf", 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output("bank_table_contract_{$project->id}.pdf", 'I');
    }

    return $mpdf->Output("bank_table_contract_{$project->id}.pdf", 'I');
}






    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();
        //$input["duration"] = $request->input("duration", 0);
        // Generate project code
        $lastProject = \App\Models\Project::orderBy('id', 'desc')->first();
        $nextNumber = $lastProject ? $lastProject->id + 1 : 1;
        $input['project_code'] = 'SAV' . date('ym') . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);

        // Create project
        $project = $this->projectRepository->create($input);

        // Attach users to project
        $roles = [
            'owner_id'      => 2,
            'contractor_id' => 3,
            'consultant_id' => 7,
        ];

        foreach ($roles as $field => $roleId) {
            if (!empty($input[$field])) {
                \App\Models\ProjectUser::create([
                    'project_id' => $project->id,
                    'user_id'    => $input[$field],
                    'role_id'    => $roleId,
                ]);
            }
        }

        // =============================
        // REDIRECT LOGIC
        // =============================
        if ($request->action === 'save_attachments') {
            /*return redirect()->route('users.attachments.create', ['type' => 'projects', 'id' => $project->id])
                ->with('toast', [
                    'type' => 'success',
                    'message' => __('Project created successfully. You can now upload attachments.')
                ]);*/
            return redirect()->route('users.attachments.create', [
                    'id' => $project->id,   // route parameter
                    'type' => 'projects'      // query string
                ])->with('toast', [
                    'type' => 'success',
                    'message' => __('Project created successfully. You can now upload attachments.')
                ]);

        }

        return redirect()
            ->route('projects.index')
            ->with('toast', [
                'type' => 'success',
                'message' => __('Project saved successfully.')
            ]);
    }




    /**
     * Display the specified Project.
     */
    public function show($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        return view('projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified Project.
     */
    public function edit($id)
{
    $project = $this->projectRepository->find($id);

    if (empty($project)) {
        Flash::error('Project not found');
        return redirect(route('projects.index'));
    }
    $stages =  \App\Models\ProjectStage::where('active', 1)
            ->orderBy('order')
            ->pluck(
                app()->getLocale() === 'ar' ? 'name_ar' : 'name_en',
                'id'
            );
    $projectRegions = \App\Models\ProjectRegion::where('status', 1)
            ->pluck(
                app()->getLocale() === 'ar' ? 'name_ar' : 'name_en',
                'id'
            );
    $projectNames = \App\Models\ProjectName::where('status', 1)
        ->pluck(app()->getLocale() == 'ar' ? 'name_ar' : 'name_en', 'id');
    $statuses    = \App\Models\Status::pluck('name', 'id');
    $regions     = \App\Models\Region::where('status', 1)->pluck('region', 'id');
    $owners      = \App\Models\User::where('role_id', 2)->pluck('name', 'id');
    $contractors = \App\Models\User::where('role_id', 3)->pluck('name', 'id');
    $consultants = \App\Models\User::where('role_id', 7)->pluck('name', 'id');

    return view('projects.edit', compact(
        'project',
        'statuses',
        'regions',
        'owners',
        'contractors',
        'consultants',
        'stages',
        'projectNames',
        'projectRegions'
    ));
}


    /**
     * Update the specified Project in storage.
     */
    public function update($id, UpdateProjectRequest $request)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        $project = $this->projectRepository->update($request->all(), $id);

        Flash::success('Project updated successfully.');

        return redirect()
            ->route('projects.index')
            ->with('toast', [
                'type' => 'success',
                'message' => __('Project updated successfully.')
            ]);

    }

    /**
     * Remove the specified Project from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        $this->projectRepository->delete($id);

        Flash::success('Project deleted successfully.');

        return redirect(route('projects.index'));
    }
}
