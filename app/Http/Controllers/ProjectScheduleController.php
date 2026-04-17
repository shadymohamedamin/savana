<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectScheduleRequest;
use App\Http\Requests\UpdateProjectScheduleRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectScheduleRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\Project;


use App\Models\ProjectSchedule;
use App\Models\ProjectScheduleApproval;

class ProjectScheduleController extends AppBaseController
{
    /** @var ProjectScheduleRepository $projectScheduleRepository*/
    private $projectScheduleRepository;

    public function __construct(ProjectScheduleRepository $projectScheduleRepo)
    {
        $this->projectScheduleRepository = $projectScheduleRepo;
    }

    /**
     * Display a listing of the ProjectSchedule.
     */
    /*public function index(Request $request)
    {
        $projectSchedules = $this->projectScheduleRepository->paginate(10);

        return view('project_schedules.index')
            ->with('projectSchedules', $projectSchedules);
    }*/


            private function defaultSchedule()
{
    /*return [
        ['item_no'=>1,'title'=>'دفعة مقدمة','notes'=>'','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>2,'title'=>'تجهيز الموقع','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>3,'title'=>'الحفر','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>4,'title'=>'صب القواعد','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>5,'title'=>'صب الجسور الارضية','notes'=>null,'payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>6,'title'=>'صب سقف الدور الارضي','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>7,'title'=>'صب سقف الدور الاول','notes'=>null,'payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>8,'title'=>'اعمال الطابوق الارضي','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>9,'title'=>'اعمال الطابوق الاول','notes'=>null,'payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>10,'title'=>'تمديدات الكهرباء والصحي','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>15,'title'=>'تمديدات الأرضيات','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>16,'title'=>'العزل','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>17,'title'=>'سيراميك أرضي','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>18,'title'=>'سيراميك أول','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>19,'title'=>'الحجر الخارجي','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>20,'title'=>'ألمنيوم وزجاج','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>21,'title'=>'كهرباء نهائي','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>22,'title'=>'صبغ خارجي','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>23,'title'=>'أطقم صحية','payment_percentage'=>null,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
    ];*/




    return [
        ['item_no'=>1,'title'=>' الحفر ','target_percentage'=>4,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>2,'title'=>' الخرسانة تحت منسوب الارض','target_percentage'=>14,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>3,'title'=>' خرسانة الطابق الارضي و الملحق ','target_percentage'=>10,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>4,'title'=>' خرسانة الطابق الأول  ','target_percentage'=>12,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>5,'title'=>' الطابوق','target_percentage'=>6,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>6,'title'=>' البلاستر الخارجي / الحجر الخارجي','target_percentage'=>3,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>7,'title'=>' البلاستر الداخلي','target_percentage'=>4,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>8,'title'=>' البلاط للجدران والارضيات والادراج','target_percentage'=>6,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>9,'title'=>'الصبغ الداخلي والخارجي','target_percentage'=>5,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>10,'title'=>' الابواب الداخلية','target_percentage'=>5,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>11,'title'=>' الطبقات العازلة','target_percentage'=>3,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>12,'title'=>' الالمنيوم والزجاج والدرابزينات','target_percentage'=>6,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>13,'title'=>'تمديدات وتسليكات الكهرباء','target_percentage'=>8,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>14,'title'=>'الاعمال الصحية والاطقم والتجهيزات','target_percentage'=>6,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>15,'title'=>' السور والاعمال الخارجية والبوابات','target_percentage'=>7,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>16,'title'=>' التنظيف','target_percentage'=>1,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
    ];


}

public function index($project)
{
    $project = \App\Models\Project::findOrFail($project);

    // لو مفيش جدول → نزله تلقائي
    /*if ($project->schedules()->count() == 0) {
        foreach ($this->defaultSchedule() as $row) {
            $row['batch_id'] = 1; // ✅
            $project->schedules()->create($row);
        }
    }*/

    //$schedules = $project->schedules()->orderBy('item_no')->get();
$batchId = request('batch_id');


$previousCumulative = ProjectSchedule::where('project_id', $project->id)
    ->where('batch_id', '<', $batchId)
    ->sum('amount');

/*if (!$batchId) {
    $batchId = ProjectSchedule::where('project_id', $project->id)->max('batch_id');
}*/

if (!$batchId) {
    return redirect()->route('projects.schedule', [
        'project' => $project->id,
        'batch_id' => 1
    ]);
}


/*if (!$batchId) {
    // أول مرة → نضيف default
    foreach ($this->defaultSchedule() as $row) {
        $row['batch_id'] = 1;
        $project->schedules()->create($row);
    }

    $batchId = 1;
}*/

$default = collect($this->defaultSchedule());

$lastBatchRows = ProjectSchedule::where('project_id', $project->id)
    ->where('batch_id', $batchId)
    ->get()
    ->sortByDesc('id')->keyBy('item_no');

$schedules = $default->map(function ($item) use ($lastBatchRows) {

    $saved = $lastBatchRows->get($item['item_no']);

    return (object) [
        'item_no' => $item['item_no'],
        'title' => $item['title'],
        'target_percentage' => $item['target_percentage'],

        // لو فيه بيانات → خدها
        'payment_percentage' => $saved->payment_percentage ?? 0,
        'completion_percentage' => $saved->completion_percentage ?? 0,
        'duration_days' => $saved->duration_days ?? null,
        'amount' => $saved->amount ?? 0,
        //'contractor_approved' => $approval->contractor_approved,
        //'owner_approved' => $approval->owner_approved,
        'notes' => $saved->notes ?? null,
        'start_date' => $saved->start_date ?? null,
    ];
});
    return view('projects.schedule', compact('project', 'schedules','batchId','previousCumulative'));
}


    public function store(Request $request, Project $project)
    {
        /*foreach ($request->rows as $row) {
            //dd($row['start_date']);
            ProjectSchedule::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'item_no' => $row['item_no']
                ],
                [
                    'title' => $row['title'],
                    'payment_percentage' => $row['payment_percentage'],
                    'completion_percentage' => $row['completion_percentage'],
                    'duration_days' => $row['duration_days'],
                    'amount' => $row['amount'],
                    'notes' => $row['notes'] ?? null,
                    'start_date'=>$row['start_date'] ?? null,
                ]
            );
        }*/


$batchId = $request->batch_id;

// لو مفيش batch → نعمل جديد
if (!$batchId) {
    $lastBatch = ProjectSchedule::where('project_id', $project->id)->max('batch_id');
    $batchId = $lastBatch ? $lastBatch + 1 : 1;
}foreach ($request->rows as $row) {
$hasData =
    ($row['payment_percentage'] ?? 0) > 0 ||
    ($row['completion_percentage'] ?? 0) > 0 ||
    ($row['amount'] ?? 0) > 0 ||
    !empty($row['start_date']);

if (true)
        //continue;
    {

    ProjectSchedule::updateOrCreate(
        [
            'project_id' => $project->id,
            'batch_id' => $batchId,
            'item_no' => $row['item_no'],
        ],
        [
            'title' => $row['title'],
            'target_percentage' => $row['target_percentage'] ?? 0,
            'payment_percentage' => $row['payment_percentage'] ?? 0,
            'completion_percentage' => $row['completion_percentage'] ?? 0,
            'duration_days' => $row['duration_days'],
            'amount' => $row['amount'],
            'notes' => $row['notes'] ?? null,
            'start_date' => $row['start_date'] ?? null,
        ]
    );
    }
    else continue;
}

        return redirect()->back()->with('toast', [
        'type'    => 'success',
        'message' => 'تم حفظ بيانات  بنجاح'
    ]);
    }

    /**
     * Show the form for creating a new ProjectSchedule.
     */

/*public function createNewBatch($project)
{
    $project = Project::findOrFail($project);

    $lastBatch = ProjectSchedule::where('project_id', $project->id)->max('batch_id');
    $newBatchId = $lastBatch ? $lastBatch + 1 : 1;

    foreach ($this->defaultSchedule() as $row) {
        ProjectSchedule::updateOrCreate(
            [
                'project_id' => $project->id,
                'batch_id' => $newBatchId,
                'item_no' => $row['item_no'],
            ],
            $row
        );
    }

    return redirect()->route('projects.schedule', [
        'project' => $project->id,
        'batch_id' => $newBatchId
    ]);
}*/


public function createNewBatch($project)
{
    $project = Project::findOrFail($project);

    $lastBatch = ProjectSchedule::where('project_id', $project->id)
        ->max('batch_id');

    $newBatchId = $lastBatch ? $lastBatch + 1 : 1;

    // لو فيه batch قديم → ننسخه
    if ($lastBatch) {

        $lastRows = ProjectSchedule::where('project_id', $project->id)
            ->where('batch_id', $lastBatch)
            ->get();

        foreach ($lastRows as $row) {
            ProjectSchedule::create([
                'project_id' => $project->id,
                'batch_id' => $newBatchId,
                'item_no' => $row->item_no,
                'title' => $row->title,
                'target_percentage' => $row->target_percentage,
                'payment_percentage' => $row->payment_percentage,
                'completion_percentage' => $row->completion_percentage,
                'duration_days' => $row->duration_days,
                'amount' => $row->amount,
                'notes' => $row->notes,
                'start_date' => $row->start_date,
            ]);
        }

    } else {
        // أول مرة → default schedule
        foreach ($this->defaultSchedule() as $row) {
            ProjectSchedule::create(array_merge($row, [
                'project_id' => $project->id,
                'batch_id' => $newBatchId,
            ]));
        }
    }

    return redirect()->route('projects.schedule', [
        'project' => $project->id,
        'batch_id' => $newBatchId
    ]);
}
public function batches($project)
{
    $project = Project::findOrFail($project);

    $projectValue = $project->project_owner_support ?? 0;

    /*$batches = ProjectSchedule::where('project_id', $project->id)
        ->select('batch_id')
        ->distinct()
        ->orderBy('batch_id', 'asc')
        ->get();*/

        $batches = ProjectSchedule::where('project_id', $project->id)
    ->whereNotNull('batch_id')
    ->select('batch_id')
    ->distinct()
    ->orderBy('batch_id', 'asc')
    ->get();

    $previousAmounts = [];
    $cumulative = 0;

    $batchesData = collect();

    foreach ($batches as $batch) {

        $rows = ProjectSchedule::where('project_id', $project->id)
            ->where('batch_id', $batch->batch_id)
            ->orderBy('item_no')
            ->get();

        $approval = ProjectScheduleApproval::firstOrCreate([
            'project_id' => $project->id,
            'batch_id' => $batch->batch_id,
        ]);

        $batchIncrease = 0;

        foreach ($rows as $row) {

            $prev = $previousAmounts[$row->item_no] ?? 0;

            // 🔥 الفرق الحقيقي لكل بند
            $diff = ($row->amount ?? 0) - $prev;

            if ($diff < 0) $diff = 0;

            $batchIncrease += $diff;

            $previousAmounts[$row->item_no] = $row->amount ?? 0;
        }



        $previousAmount = ProjectSchedule::where('project_id', $project->id)
            ->where('batch_id', '<', $batch->batch_id)
            ->sum('amount');

        // التراكمي
        $cumulative += $batchIncrease;

        $remaining = $projectValue - $cumulative;

        $batchesData->push((object)[
            'batch_id' => $batch->batch_id,
            'rows_count' => $rows->count(),

            // إجمالي العرض داخل الباتش
            'total_amount' => $rows->sum('amount'),

            // 🔥 الزيادة الحقيقية (المهم)
            'amount' => $batchIncrease,

            // التراكمي
            'cumulative_amount' => $cumulative,

            'previous_amount' => $previousAmount,

            // 🔥 المتبقي الصحيح
            'owner_remaining' => $remaining,

            'total_target' => $rows->sum('target_percentage'),
            'total_payment' => $rows->sum('payment_percentage'),
            'total_completion' => $rows->sum('completion_percentage'),

            'created_at' => optional($rows->first())->created_at,

            'contractor_approved' => $approval->contractor_approved,
            'owner_approved' => $approval->owner_approved,
            'consultant_approved' => $approval->consultant_approved,
        ]);
    }

    return view('projects.schedules_batches', [
        'project' => $project,
        'batchesData' => $batchesData
    ]);
}



/*public function approve(Request $request)
{
    $batchId = $request->batch_id;
    $projectId = $request->project_id;
    $type = $request->type;
    $value = $request->value;

    $field = match($type) {
        'contractor' => 'contractor_approved',
        'owner' => 'owner_approved',
        'consultant' => 'consultant_approved',
    };

    $approval = ProjectScheduleApproval::firstOrCreate([
        'project_id' => $projectId,
        'batch_id' => $batchId,
    ]);

    $approval->update([
        $field => $value
    ]);

    return response()->json(['success' => true]);
}*/







public function approve(Request $request)
{
    $batchId   = $request->batch_id;
    $projectId = $request->project_id;
    $type      = $request->type;
    $value     = $request->value;

    $user = auth()->user();
    $role = $user->role;

    $approval = ProjectScheduleApproval::firstOrCreate([
        'project_id' => $projectId,
        'batch_id'   => $batchId,
    ]);

    // تحديد الحقل
    $field = match($type) {
        'contractor' => 'contractor_approved',
        'consultant' => 'consultant_approved',
        'owner'      => 'owner_approved',
    };

    // =========================
    // 🔒 الصلاحيات
    // =========================
    if ($role == 'contractor' && $type != 'contractor') {
        return response()->json([
            'success' => false,
            'message' => 'غير مسموح لك'
        ]);
    }

    if ($role == 'consultant' && $type != 'consultant') {
        return response()->json([
            'success' => false,
            'message' => 'غير مسموح لك'
        ]);
    }

    if ($role == 'owner' && $type != 'owner') {
        return response()->json([
            'success' => false,
            'message' => 'غير مسموح لك'
        ]);
    }

    // =========================
    // 🔥 ترتيب الاعتماد
    // =========================
    if ($type == 'consultant' && !$approval->contractor_approved) {
        return response()->json([
            'success' => false,
            'message' => 'يرجى اعتماد المقاول أولاً'
        ]);
    }

    if ($type == 'owner' && !$approval->consultant_approved) {
        return response()->json([
            'success' => false,
            'message' => 'يرجى اعتماد الاستشاري أولاً'
        ]);
    }

    // =========================
    // ✅ التحديث
    // =========================
    $approval->update([
        $field => $value
    ]);

    $approval->refresh();

    // ===============================
    // 🔥 إنشاء دفعة تلقائية عند الاعتماد الكامل
    // ===============================
    if (
        $approval->contractor_approved &&
        $approval->consultant_approved &&
        $approval->owner_approved
    ) {

        $exists = \App\Models\ProjectPayment::where('project_id', $projectId)
            ->where('payment_no', $batchId)
            ->where('payer_type', 'owner')
            ->exists();

        if (!$exists) {

            $batchTotal = \App\Models\ProjectSchedule::where('project_id', $projectId)
                ->where('batch_id', $batchId)
                ->sum('amount');

            $paymentDate = \App\Models\ProjectSchedule::where('project_id', $projectId)
                ->where('batch_id', $batchId)
                ->orderBy('created_at', 'desc')
                ->value('created_at');

            \App\Models\ProjectPayment::create([
                'project_id'   => $projectId,
                'payment_no'   => $batchId,
                'payer_type'   => 'owner',
                'total_amount' => $batchTotal,
                'vat_amount'   => $batchTotal / 21,
                'net_amount'   => $batchTotal - ($batchTotal / 21),
                'payment_date' => $paymentDate,
            ]);
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'تم الحفظ بنجاح ✅'
    ]);
}


    public function create()
    {
        return view('project_schedules.create');
    }

    /**
     * Store a newly created ProjectSchedule in storage.
     */
    
    /**
     * Display the specified ProjectSchedule.
     */
    public function show($id)
    {
        $projectSchedule = $this->projectScheduleRepository->find($id);

        if (empty($projectSchedule)) {
            Flash::error('Project Schedule not found');

            return redirect(route('projectSchedules.index'));
        }

        return view('project_schedules.show')->with('projectSchedule', $projectSchedule);
    }

    /**
     * Show the form for editing the specified ProjectSchedule.
     */
    public function edit($id)
    {
        $projectSchedule = $this->projectScheduleRepository->find($id);

        if (empty($projectSchedule)) {
            Flash::error('Project Schedule not found');

            return redirect(route('projectSchedules.index'));
        }

        return view('project_schedules.edit')->with('projectSchedule', $projectSchedule);
    }

    /**
     * Update the specified ProjectSchedule in storage.
     */
    public function update($id, UpdateProjectScheduleRequest $request)
    {
        $projectSchedule = $this->projectScheduleRepository->find($id);

        if (empty($projectSchedule)) {
            Flash::error('Project Schedule not found');

            return redirect(route('projectSchedules.index'));
        }

        $projectSchedule = $this->projectScheduleRepository->update($request->all(), $id);

        Flash::success('Project Schedule updated successfully.');

        return redirect(route('projectSchedules.index'));
    }

    /**
     * Remove the specified ProjectSchedule from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectSchedule = $this->projectScheduleRepository->find($id);

        if (empty($projectSchedule)) {
            Flash::error('Project Schedule not found');

            return redirect(route('projectSchedules.index'));
        }

        $this->projectScheduleRepository->delete($id);

        Flash::success('Project Schedule deleted successfully.');

        return redirect(route('projectSchedules.index'));
    }
}
