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
    $user = auth()->user();
    /*$query = \App\Models\Project::with([
        'status',
        'ownerUser', // owner relation for name/phone
        'contractor',
        'baladyaApprovals' => fn($q) => $q->latest()->take(1),
    ]);*///vat_amount
$allowedRoles = [1,4,11,12];
    $query = \App\Models\Project::query()
        ->with([
            'status',
            'ownerUser',
            'contractor',
            'users',
            'baladyaApprovals' => fn($q) => $q->latest()->take(1),
        ])
        ->withSum([
            'payments as paid_with_vat' => function ($q) {
                $q->select(
                    \DB::raw('COALESCE(SUM(total_amount ),0)')
                );
            }
        ], 'id');



/*if (!in_array(auth()->user()->role_id, $allowedRoles)) {
    //dd($user);
    $query->whereHas('projectUsers', function ($q) {
        $q->where('user_id', auth()->id())
          ->where('role_id', 8);
    });
    $query->groupBy('projects.id');
    $query->distinct('projects.id');
}*/





    /*if (!in_array($user->role_id, $allowedRoles)) {

        $query->whereHas('projectUsers', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        });
    }*/

       /* if (!in_array($user->role_id, $allowedRoles)) {
            //dd($user);
            $query->whereHas('users', function ($q) use ($user) {
                $q->where('users.id', $user->id);
            });
        }*/

    // Filters
    if ($request->filled('project_code')) {
        $query->where('project_code', 'like', '%' . $request->project_code . '%');
    }

    if ($request->filled('contractor_id')) {
    $query->where('contractor_id', $request->contractor_id);
}


    if ($request->filled('qasmia_number')) {
        $query->where('qasmia_number', 'like', '%' . $request->qasmia_number . '%');
    }

    if ($request->filled('owner_name')) {
        $query->whereHas('ownerUser', fn($q) => $q->where('name', 'like', '%' . $request->owner_name . '%'));
    }

    if ($request->filled('owner_phone')) {
        $query->whereHas('ownerUser', fn($q) => $q->where('mobile', 'like', '%' . $request->owner_phone . '%'));
    }




    


    if ($request->filled('case_id_number')) {
        $query->where('case_id_number', 'like', '%' . $request->case_id_number . '%');
    }




    



    /*if (!in_array(auth()->user()->role_id, $allowedRoles)) {

        $query->whereHas('projectUsers', function ($q) {
            $q->where('user_id', auth()->id())
            ->where('role_id', 8);
        })->select('projects.*')->distinct();

    }*/


        if (!in_array(auth()->user()->role_id, $allowedRoles)) {

            $query->whereHas('projectUsers', function ($q) {
                $q->where('user_id', auth()->id())
                ->whereIn('role_id', [3, 8])
                ->where('context', 'tender');
            })
            ->with(['users' => function ($q) {
                $q->wherePivotIn('role_id', [3, 8])
                ->wherePivot('context', 'tender');
            }])
            ->select('projects.*')
            ->distinct();
    }
    $projects = $query->orderByDesc('created_at')->paginate(15);
    

/*if (!in_array(auth()->user()->role_id, $allowedRoles)) {

    $projects->setCollection(
        $projects->getCollection()->unique('project_code')
    );

}*/

    
    $toast = session('toast', null);
    $contractors = \App\Models\User::where('role_id', 3)->get();



    

    return view('projects.index', compact('projects', 'toast','contractors'));
}




    /**
     * Show the form for creating a new Project.
     */
    public function create(Request $request)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
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

    /*$mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);*/
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_footer' => 5,
        'margin_top' => 35
    ]);
    $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');//<img src="{{ public_path('images/signature.jpeg') }}" style="height:150px;">
    $mpdf->SetHTMLFooter('
        
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');


    //<div style=" text-align:left; padding-bottom:0rem;padding-left:2.5rem;">
    //        <img src="'.public_path('images/signature.jpeg').'" style="height:100px;">
    //    </div>

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');


$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'

// اسم الملف مع اسم المالك
$fileName = "العقد_الاساسي_" . $ownerName . ".pdf";


    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I'); // Browser print
    }

    // Default = preview
    return $mpdf->Output($fileName, 'I');
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
        'margin_footer' => 5,
        'margin_top' => 35
    ]);
    $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');
    $mpdf->SetHTMLFooter('
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');
//takleef_contract_{$project->id}
//$project->ownerUser->name_ar

// الحصول على اسم المالك
$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'

// اسم الملف مع اسم المالك
$fileName = "خطاب_التكليف_" . $ownerName . ".pdf";


    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I');
    }

    return $mpdf->Output($fileName, 'I');
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
        'margin_footer' => 5,
        'margin_top' => 35
    ]);
    $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');
    $mpdf->SetHTMLFooter('
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');



// الحصول على اسم المالك
$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'

// اسم الملف مع اسم المالك
$fileName = "عقد_الاتفاق_بين_المالك_والاستشاري_" . $ownerName . ".pdf";



    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I'); // Browser print
    }

    return $mpdf->Output($fileName, 'I');
}



public function contractSpecificationsPdf(Request $request, $id)
{
    $project = \App\Models\Project::with([
        'ownerUser',
        'contractorUser'
    ])->findOrFail($id);

    $html = view('pdf.contract-specifications', compact('project'))->render();

    /*$mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_top' => 15,
        'margin_bottom' => 15,
        'margin_left' => 15,
        'margin_right' => 15,
    ]);*/
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_footer' => 5,
        'margin_top' => 35
    ]);
    $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');
    $mpdf->SetHTMLFooter('
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');
    
    
    
$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'
$fileName = "عقد_المواصفات_الفنية_" . $ownerName . ".pdf";


    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I'); // Browser print
    }

    // Default = preview
    return $mpdf->Output($fileName, 'I');
}




/*public function projectSchedulePdf(Request $request, $id)
{
    $project = \App\Models\Project::with([
        'ownerUser',
        'contractorUser',
        'projectName',
        'projectRegion'
    ])->findOrFail($id);

    $schedules = \App\Models\ProjectSchedule::where('project_id', $id)->get();

    $html = view('pdf.project-schedule', compact('project', 'schedules'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_top' => 35,
        'margin_footer' => 5,
    ]);

    $mpdf->SetHTMLHeader('
        <div style="text-align:center;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:90px;width:70%;">
        </div>
    ');

    $mpdf->SetHTMLFooter('
        <div style="text-align:center;font-size:12px;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');

    $mpdf->WriteHTML($html);

    $fileName = "project_schedule_{$project->id}.pdf";
    $action = $request->get('action', 'preview');

    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    return $mpdf->Output($fileName, 'I');
}*/


public function projectSchedulePdf(Request $request, $id)
{
    $project = \App\Models\Project::with([
        'ownerUser',
        'contractorUser',
        'projectName',
        'projectRegion'
    ])->findOrFail($id);
    
    $batchId = $request->get('batch_id');
    // ✅ نجيب آخر batch
    
    $lastBatchId = \App\Models\ProjectSchedule::where('project_id', $id)
        ->max('batch_id');
    if(!$batchId)$batchId=$lastBatchId;

    // ✅ نجيب بياناته فقط
    $schedules = \App\Models\ProjectSchedule::where('project_id', $id)
        ->where('batch_id', $batchId)//$lastBatchId)
        ->orderBy('item_no')
        ->get();

// لو مش موجود → استخدم آخر batch (fallback)
if (!$batchId) {
    $batchId = \App\Models\ProjectSchedule::where('project_id', $id)
        ->max('batch_id');
}





    $approval = \App\Models\ProjectScheduleApproval::where('project_id', $id)
    ->where('batch_id', $batchId)
    ->first();







//dd($batchId);
$projectScheduleApproval = \App\Models\ProjectScheduleApproval::where('project_id', $id)
    ->where('batch_id', $batchId)
    ->first();
$showSignature = false; 
if ($projectScheduleApproval) {
    if ($projectScheduleApproval->contractor_approved || 
        $projectScheduleApproval->owner_approved || 
        $projectScheduleApproval->consultant_approved) {
        $showSignature = true; 
    }
}



    $approvalCreatedAt = $approval->created_at ?? null;
    //dd($approvalCreatedAt->format('yy-mm-dd'));




$contractorApproved = $approval ? $approval->contractor_approved : false;
    $ownerApproved = $approval ? $approval->owner_approved : false;
    $consultantApproved = $approval ? $approval->consultant_approved : false;




    $html = view('pdf.project-schedule', compact('contractorApproved','ownerApproved','consultantApproved','projectScheduleApproval','showSignature','approval','project', 'schedules','approvalCreatedAt'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_top' => 35,
        'margin_footer' => 5,
    ]);

    $mpdf->SetHTMLHeader('
        <div style="text-align:center;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:90px;width:70%;">
        </div>
    ');

    $mpdf->SetHTMLFooter('
        <div style="text-align:center;font-size:12px;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');

    $mpdf->WriteHTML($html);

    $fileName = "project_schedule_{$project->id}_batch_{$lastBatchId}.pdf";
    $action = $request->get('action', 'preview');

    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    return $mpdf->Output($fileName, 'I');
}








/*public function projectSchedulePdf(Request $request, $id)
{
    $project = \App\Models\Project::with([
        'ownerUser',
        'contractorUser',
        'projectName',
        'projectRegion'
    ])->findOrFail($id);

    // Get the latest batch ID
    $lastBatchId = \App\Models\ProjectSchedule::where('project_id', $id)
        ->max('batch_id');

    // Get schedules for the latest batch
    $schedules = \App\Models\ProjectSchedule::where('project_id', $id)
        ->where('batch_id', $lastBatchId)
        ->orderBy('item_no')
        ->get();

    // Get batch ID from the request, or use the latest batch as fallback
    $batchId = $request->get('batch_id');
    if (!$batchId) {
        $batchId = \App\Models\ProjectSchedule::where('project_id', $id)
            ->max('batch_id');
    }

    // Get the approval data for the given batch
    $approval = \App\Models\ProjectScheduleApproval::where('project_id', $id)
        ->where('batch_id', $batchId)
        ->first();

    // Check if the approval statuses for contractor, owner, or consultant are true
    $contractorApproved = $approval ? $approval->contractor_approved : false;
    $ownerApproved = $approval ? $approval->owner_approved : false;
    $consultantApproved = $approval ? $approval->consultant_approved : false;

    // Set $showSignature to true if any of the approvals are true
    $showSignature = $contractorApproved || $ownerApproved || $consultantApproved;

    // Prepare the approval created date
    $approvalCreatedAt = $approval ? $approval->created_at : null;

    // Pass all necessary data to the view
    $html = view('pdf.project-schedule', compact(
        'project', 'schedules', 'approval', 
        'contractorApproved', 'ownerApproved', 'consultantApproved',
        'showSignature', 'approvalCreatedAt'
    ))->render();

    // Create the PDF using mPDF
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_top' => 35,
        'margin_footer' => 5,
    ]);

    $mpdf->SetHTMLHeader('
        <div style="text-align:center;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:90px;width:70%;">
        </div>
    ');

    $mpdf->SetHTMLFooter('
        <div style="text-align:center;font-size:12px;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');

    $mpdf->WriteHTML($html);

    // Set the file name
    $fileName = "project_schedule_{$project->id}_batch_{$lastBatchId}.pdf";
    $action = $request->get('action', 'preview');

    // Return the PDF file either for download or preview
    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    return $mpdf->Output($fileName, 'I');
}*/



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
        'margin_footer' => 5,
        'margin_top' => 35
    ]);
    $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');
    $mpdf->SetHTMLFooter('
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');
    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

        
$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'
$fileName = "عقد_الحاوية_" . $ownerName . ".pdf";


    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I'); // Browser print
    }

    // Default = preview
    return $mpdf->Output($fileName, 'I');
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
        'margin_footer' => 5,
        'margin_top' => 35
    ]);
 $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');
    $mpdf->SetHTMLFooter('
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');
    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

        
$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'
$fileName = "عقد_تسليم_الموقع_" . $ownerName . ".pdf";


    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I'); // Browser print
    }

    // Default = preview
    return $mpdf->Output($fileName, 'I');
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
        'margin_footer' => 5,
        'margin_top' => 35
    ]);
 $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');
    $mpdf->SetHTMLFooter('
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');
    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

        
$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'
$fileName = "عقد_البنك_" . $ownerName . ".pdf";


    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I'); // Browser print
    }

    // Default = preview
    return $mpdf->Output($fileName, 'I');
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
        'margin_footer' => 5,
        'margin_top' => 35
    ]);
    $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');
    $mpdf->SetHTMLFooter('
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');
    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');




    
$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'
$fileName = "عقد_احتياجات_المالك_" . $ownerName . ".pdf";


    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I'); // Browser print
    }

    // Default = preview
    return $mpdf->Output($fileName, 'I');




    /*return match ($action) {
        'download' => $mpdf->Output("owner_requirements_contract_{$project->id}.pdf", 'D'),
        'print'    => $mpdf->Output("owner_requirements_contract_{$project->id}.pdf", 'I'),
        default    => $mpdf->Output("owner_requirements_contract_{$project->id}.pdf", 'I'),
    };*/
}


// App\Http\Controllers\OwnerRequirementController.php
public function pricingContractPdf(Request $request, $id)
{
    $project = \App\Models\Project::findOrFail($id);
    $contractorId = $request->get('contractor');
    /*$items = \App\Models\OwnerRequirement::where('floor', 'pricing')
        ->with(['projectOwnerRequirements' => function ($q) use ($project) {
            $q->where('project_id', $project->id)
              ->where('context', 'pricing');
        }])
        ->get()
        ->map(function ($requirement) use ($project) {
            if ($requirement->projectOwnerRequirements->isEmpty()) {
                $requirement->projectOwnerRequirements->push(
                    new \App\Models\ProjectOwnerRequirement([
                        'quantity'   => 1,
                        'unit_price' => 0,
                        'notes'      => '',
                        'project_id' => $project->id,
                        'owner_requirement_id' => $requirement->id,
                        'context' => 'pricing',
                    ])
                );
            }
            return $requirement;
        })
        ->groupBy('main_category');*/
    $groups = \App\Models\OwnerRequirement::where('floor', 'tender')
        ->where('type', 'group')->where('name_en', 'Supply Finishings')
        ->with([
            'children.children.projectOwnerRequirements' => function ($q) use ($project,$contractorId) {
                $q->where('project_id', $project->id)
                  ->where('context', 'tender');
                if ($contractorId) {
                    $q->where('tender_user_id', $contractorId);
                }
            }
        ])
        ->get();

 
    $items=[];
    //dd($items);
    $specs = $project->ownerSpecification;

    $html = view('pdf.contract_pricing', compact('project', 'items','groups', 'specs'))->render();

    /*$mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
    ]);*/
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_footer' => 5,
        'margin_top' => 35
    ]);
    $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');
    $mpdf->SetHTMLFooter('
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');



    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

        
$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'
$fileName = "عقد_اسعار_التوريد_" . $ownerName . ".pdf";


    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I'); // Browser print
    }

    // Default = preview
    return $mpdf->Output($fileName, 'I');
}





public function tenderContractPdf(Request $request, $id)
{
    $project = \App\Models\Project::findOrFail($id);
    $contractorId = $request->contractor;
    // نجيب الجروبات زي صفحة التندر
    $groups = \App\Models\OwnerRequirement::where('floor', 'tender')
        ->where('type', 'group')
        ->with([
            'children.children.projectOwnerRequirements' => function ($q) use ($project,$contractorId) {
                $q->where('project_id', $project->id)
                  ->where('context', 'tender');
                if($contractorId)
                    {
                        $q->where('tender_user_id', $contractorId);
                    }
            }
        ])
        ->get();


    /*$groups = \App\Models\OwnerRequirement::where('floor', 'tender')
    ->where('type', 'group')
    ->with([
        'children.children.projectOwnerRequirements' => function ($q) use ($project, $contractorId) {
            $q->where('project_id', $project->id)
              ->where('context', 'tender');
            if ($contractorId) {
                $q->where('tender_user_id', $contractorId);
            }
        }
    ])
    ->get();   */
    
    
    /*$groups = \App\Models\OwnerRequirement::where('floor', 'tender')
    ->where('type', 'group')
    ->with([
        'children.children.projectOwnerRequirements' => function ($q) use ($project) {
            $q->where('project_id', $project->id)
              ->where('context', 'tender')
              ->where('tender_user_id', auth()->id());
        }
    ])
    ->get();*/
    //dd($groups);


    /*
     


    <table style="width:100%; border-collapse:collapse; margin-top:20px; margin-bottom:50px;">
    <tr>
        <td class="bold center section-title" style="text-align:center; font-weight:bold;">
            توقيع وختم المقاول
        </td>
        <td class="bold center section-title" style="text-align:center; font-weight:bold;">
            توقيع المالك
        </td>
        <td class="bold center section-title" style="text-align:center; font-weight:bold;">
            توقيع وختم الاستشاري
        </td>
    </tr>

    <tr>
        <td class="signature" style="height:80px; border-bottom:1px solid #000;"></td>

        <td class="signature" style="height:80px; border-bottom:1px solid #000;"></td>

        <td class="signature" style="height:80px; border-bottom:1px solid #000; text-align:center;">
           <img src="'.public_path('images/signature.jpeg').'"  style="height:140px;">
        </td>
    </tr>
</table>

     */

    $html = view('pdf.contract_tender', compact('project', 'groups'))->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_footer' => 5,
        'margin_top' => 35
    ]);
    $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');
    $mpdf->SetHTMLFooter('
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');

    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

        
$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'
$fileName = "عقد_حساب_الكميات_" . $ownerName . ".pdf";


    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I'); // Browser print
    }

    // Default = preview
    return $mpdf->Output($fileName, 'I');
}

/*public function pricingContractPdf(Request $request, $id)
{
    $project = \App\Models\Project::with([
        'ownerUser',
        'contractorUser',
        'projectRegion',
        'projectName',
        'ownerRequirementsPricing.ownerRequirement',
        'ownerSpecification'
    ])->findOrFail($id);

    // بنود التسعير (pricing)
    $items = $project->ownerRequirementsPricing
        ->groupBy(fn ($row) => $row->ownerRequirement->main_category ?? 'أخرى');

    dd($items);

    // مواصفات المالك (مش design)
    $specs = $project->ownerSpecification;

    $html = view(
        'pdf.contract_pricing',
        compact('project', 'items', 'specs')
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
        'download' => $mpdf->Output("contract_pricing_{$project->id}.pdf", 'D'),
        'print'    => $mpdf->Output("contract_pricing_{$project->id}.pdf", 'I'),
        default    => $mpdf->Output("contract_pricing_{$project->id}.pdf", 'I'),
    };
}*/




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
    'margin_footer' => 5,
        'margin_top' => 35
    ]);
    $mpdf->SetHTMLHeader('
        <div style="text-align:center; margin-bottom:0.5rem;">
            <img src="'.public_path('images/tender_logo.jpeg').'" style="height:100px;width:70%;">
        </div>
    ');
    $mpdf->SetHTMLFooter('
        <div style="text-align:center; font-size:12px; margin-top:1rem;">
            صفحة {PAGENO} من {nbpg}
        </div>
    ');
    $mpdf->WriteHTML($html);

    $action = $request->get('action', 'preview');

        
$ownerName = $project?->ownerUser?->name ?? 'مالك_غير_محدد';  // إذا كان الاسم غير موجود، يتم استخدام 'مالك_غير_محدد'
$fileName = "عقد_البنك_" . $ownerName . ".pdf";


    if ($action === 'download') {
        return $mpdf->Output($fileName, 'D');
    }

    if ($action === 'print') {
        return $mpdf->Output($fileName, 'I'); // Browser print
    }

    // Default = preview
    return $mpdf->Output($fileName, 'I');
}






    public function store(CreateProjectRequest $request)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $input = $request->all();
        //dd($input);
        //$input["duration"] = $request->input("duration", 0);
        // Generate project code
        //$lastProject = \App\Models\Project::orderBy('id', 'desc')->first();
        //$nextNumber = $lastProject ? $lastProject->id + 1 : 1;
        $projectsCount = \App\Models\Project::count();
        $nextNumber = $projectsCount + 1;
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
            ->back()
            ->with('toast', [
                'type' => 'success',
                'message' => __('Project saved successfully.')
            ]);
    }




    /**
     * Display the specified Project.
     */
          public function showTable($projectId)

    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'ليس لديك الصلاحيات الكافية'
            ]);
        }

    // العثور على المشروع بواسطة المعرف
    $project = Project::findOrFail($projectId);
    
    // حساب المساحات الإجمالية لكل مالك
    $ownersData = $project->ownerRequirements()
        ->selectRaw('owner_id, SUM(approved_area) as total_area')
        ->groupBy('owner_id')
        ->with('ownerUser') // إضافة العلاقة للمستخدم (المالك)
        ->get();

    // إرسال البيانات إلى العرض
    return view('projects.show', compact('project', 'ownersData'));
}

    /**
     * Show the form for editing the specified Project.
     */
    public function edit($id)
{
    if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
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
    /*public function update($id, UpdateProjectRequest $request)
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

    }*/


/*public function update($id, UpdateProjectRequest $request)
{
    if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
    $project = $this->projectRepository->find($id);

    if (empty($project)) {
        return redirect()->back()
            ->with('toast', [
                'type' => 'error',
                'message' => __('Project not found.')
            ]);
    }
//dd($request->all());
    // تحديث بيانات المشروع
    $project = $this->projectRepository->update($request->all(), $id);

    // =============================
    // تحديث المستخدمين المرتبطين
    // =============================
    $roles = [
        'owner_id'      => 2,
        'contractor_id' => 3,
        'consultant_id' => 7,
    ];

    foreach ($roles as $field => $roleId) {

        if ($request->filled($field)) {

            // \App\Models\ProjectUser::updateOrCreate(
            //     [
            //         'project_id' => $project->id,
            //         'role_id'    => $roleId,
            //     ],
            //     [
            //         'user_id' => $request->$field,
            //     ]
            // );
            \App\Models\ProjectUser::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'user_id'    => $request->$field,
                ],
                [
                    'role_id' => $roleId,
                    //'status'  => 'candidate'
                ]
            );
        }
    }

    // =============================
    // لو عايز يروح للمرفقات بعد التحديث
    // =============================
    if ($request->action === 'save_attachments') {

        return redirect()->route('users.attachments.create', [
                'id'   => $project->id,
                'type' => 'projects'
            ])->with('toast', [
                'type'    => 'success',
                'message' => __('Project updated successfully. You can now upload attachments.')
            ]);
    }

    return redirect()
        ->back()
        ->with('toast', [
            'type'    => 'success',
            'message' => __('Project updated successfully.')
        ]);
}*/
public function update($id, UpdateProjectRequest $request)
{
    if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'ليس لديك الصلاحيات الكافية'
        ]);
    }

    $project = $this->projectRepository->find($id);

    if (empty($project)) {
        return redirect()->back()
            ->with('toast', [
                'type' => 'error',
                'message' => __('Project not found.')
            ]);
    }
//dd($project->project_image);
    // التحقق من رفع الصورة وحفظها
    /*if ($request->hasFile('project_image')) {
        // حذف الصورة السابقة إن كانت موجودة
        if ($project->project_image && file_exists(public_path('Files/'.$project->project_image))) {
            unlink(public_path('Files/'.$project->project_image)); // حذف الصورة القديمة
        }

        // رفع الصورة الجديدة
        $image = $request->file('project_image');
        $imageName = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('Files'), $imageName); // حفظ الصورة في مجلد Files

        // تخزين المسار الجديد للصورة في قاعدة البيانات
        $project->project_image = 'Files/'.$imageName;
        $project->save();
    }*/


if ($request->hasFile('approved_file') && $request->file('approved_file')->isValid()) {
    $file = $request->file('approved_file');

    // تأكد من أن الملف تم تحميله بنجاح
    $filename = $baladyaApproval->id . '_baladya_' . time() . '_' . $file->getClientOriginalName();

    // حفظ الملف في public/Files
    $file->move(public_path('Files'), $filename);

    // تحقق إذا كان الملف موجود في المجلد
    $path = public_path('Files') . '/' . $filename;
    if (file_exists($path)) {
        // تخزين اسم الملف في قاعدة البيانات

        dd($fileName);
        $input['approved_file'] = $filename;
    } else {
        // إذا كان الملف لم يتم حفظه، قم بإرجاع خطأ أو رسالة مناسبة
        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'لم يتم حفظ الملف بشكل صحيح',
        ]);
    }
}
    // تحديث بيانات المشروع
    $this->projectRepository->update($request->all(), $id);

    // ==============================
    // تحديث المستخدمين المرتبطين
    // ==============================
    $roles = [
        'owner_id'      => 2,
        'contractor_id' => 3,
        'consultant_id' => 7,
    ];

    foreach ($roles as $field => $roleId) {
        if ($request->filled($field)) {
            \App\Models\ProjectUser::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'user_id'    => $request->$field,
                ],
                [
                    'role_id' => $roleId,
                ]
            );
        }
    }

    // لو عايز يروح للمرفقات بعد التحديث
    if ($request->action === 'save_attachments') {
        return redirect()->route('users.attachments.create', [
                'id'   => $project->id,
                'type' => 'projects'
            ])->with('toast', [
                'type'    => 'success',
                'message' => __('Project updated successfully. You can now upload attachments.')
            ]);
    }

    return redirect()
        ->back()
        ->with('toast', [
            'type'    => 'success',
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
        if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $project = $this->projectRepository->find($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect()->back();
        }

        $this->projectRepository->delete($id);

        Flash::success('Project deleted successfully.');

        return redirect()->back();
    }
}
