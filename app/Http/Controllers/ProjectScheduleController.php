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
        ['item_no'=>14,'title'=>'الاعمال الصحية والاطقم والتجهيزات','target_percentage'=>7,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>15,'title'=>' السور والاعمال الخارجية والبوابات','target_percentage'=>7,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
        ['item_no'=>16,'title'=>' التنظيف','target_percentage'=>0,'payment_percentage'=>0,'completion_percentage'=>null,'duration_days'=>null,'amount'=>null],
    ];


}

public function index($project)
{
    $project = \App\Models\Project::findOrFail($project);

    // لو مفيش جدول → نزله تلقائي
    if ($project->schedules()->count() == 0) {
        foreach ($this->defaultSchedule() as $row) {
            $project->schedules()->create($row);
        }
    }

    $schedules = $project->schedules()->orderBy('item_no')->get();

    return view('projects.schedule', compact('project', 'schedules'));
}


    public function store(Request $request, Project $project)
    {
        foreach ($request->rows as $row) {
            //dd($row['start_date']);
            ProjectSchedule::updateOrCreate(
                [
                    'project_id' => $project->id,
                    'item_no' => $row['item_no']
                ],
                [
                    'title' => $row['title'],
                    'payment_percentage' => $row['payment_percentage'],
                    'completion_percentage' => null,//$row['completion_percentage'],
                    'duration_days' => $row['duration_days'],
                    'amount' => $row['amount'],
                    'notes' => $row['notes'] ?? null,
                    'start_date'=>$row['start_date'] ?? null,
                ]
            );
        }

        return redirect()->back()->with('toast', [
        'type'    => 'success',
        'message' => 'تم حفظ بيانات  بنجاح'
    ]);
    }

    /**
     * Show the form for creating a new ProjectSchedule.
     */
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
