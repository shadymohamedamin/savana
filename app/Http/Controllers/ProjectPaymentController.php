<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectPaymentRequest;
use App\Http\Requests\UpdateProjectPaymentRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectPaymentRepository;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectPayment;
use Flash;

class ProjectPaymentController extends AppBaseController
{
    /** @var ProjectPaymentRepository $projectPaymentRepository*/
    private $projectPaymentRepository;

    public function __construct(ProjectPaymentRepository $projectPaymentRepo)
    {
        $this->projectPaymentRepository = $projectPaymentRepo;
    }

    /**
     * Display a listing of the ProjectPayment.
     */

    private function calculateAmounts($total)
    {
        //let vat = total/21; //* 0.05;

        // Net = total / 1.05
        //let net = total-vat;//total / 1.05;

        //document.getElementById('vat_amount').value = vat.toFixed(2);
        //document.getElementById('net_amount').value = net.toFixed(2);
        $vat = round($total/21, 2);//*0.05
        $net = round($total - $vat, 2);




        /*$bankLimit = 800000;
        $budget = $project->budget;

        $bankPaid = $project->payments()
            ->where('payer_type','bank')
            ->sum('total_amount');

        $ownerPaid = $project->payments()
            ->where('payer_type','owner')
            ->sum('total_amount');

        $bankRemaining  = $bankLimit - $bankPaid;
        $ownerRemaining = ($budget - $bankLimit) - $ownerPaid;
        $totalRemaining = $budget - ($bankPaid + $ownerPaid);*/










        return [$vat, $net];
    }

    /*public function index(Request $request)
    {
        $projectPayments = $this->projectPaymentRepository->paginate(10);

        return view('project_payments.index')
            ->with('projectPayments', $projectPayments);
    }*/


    public function index(Project $project)
    {
        if (false){//!in_array(auth()->user()->role_id, [1,4,11,12,7])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $payments = ProjectPayment::where('project_id', $project->id)->get();

        return view('project_payments.index', compact(
            'project',
            'payments'
        ));          
    }



    /**
     * Show the form for creating a new ProjectPayment.
     */
    public function create($projectId)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12,7])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $project = Project::findOrFail($projectId);

        return view('project_payments.create', compact('project'));
    }


    
    /**
     * Store a newly created ProjectPayment in storage.
     */
    public function store(Request $request, $projectId)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12,7])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        //dd($request->all());
        $request->validate([
            'payer_type'   => 'required',
            'payment_no'   => 'required|integer',
            'total_amount' => 'required|numeric|min:0',
            'payment_date' => 'nullable|date',
            'attachment'   => 'nullable|file|max:10240',
        ]);

        [$vat, $net] = $this->calculateAmounts($request->total_amount);

        $data = $request->all();
        $data['project_id'] = $projectId;
        $data['vat_amount'] = $vat;
        $data['net_amount'] = $net;

        /*if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('Files'), $name);
            $data['attachment'] = $name;
        }*/

        // ملف 1
        if ($request->hasFile('attachments.1.file')) {
            $file = $request->file('attachments.1.file');
            $name = time().'_1_'.$file->getClientOriginalName();
            $file->move(public_path('Files'), $name);
            $data['attachment'] = $name;
        }

        // ملف 2 و 3
        foreach ([2,3] as $i) {
            if ($request->hasFile("attachments.$i.file")) {
                $file = $request->file("attachments.$i.file");
                $name = time().'_'.$i.'_'.$file->getClientOriginalName();
                $file->move(public_path('Files'), $name);
                $data['attachment_'.$i] = $name;
            }
        }


        ProjectPayment::create($data);

        /*return back()->with('toast', [
            'type' => 'success',
            'message' => 'تم إضافة الدفعة بنجاح'
        ]);*/
        return redirect()->route('projects.project-payments.index', [
            'project' => $projectId,
            //'owner_id' => request('owner_id')
        ])->with([
            'toast' => [
                'type' => 'success',
                'message' => __('تم حفظ  الدفعة بنجاح')
            ]
        ]);
    }


    /**
     * Display the specified ProjectPayment.
     */
    public function show($id)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12,7])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $projectPayment = $this->projectPaymentRepository->find($id);

        if (empty($projectPayment)) {
            Flash::error('Project Payment not found');

            return redirect(route('projectPayments.index'));
        }

        return view('project_payments.show')->with('projectPayment', $projectPayment);
    }

    /**
     * Show the form for editing the specified ProjectPayment.
     */
    public function edit(Project $project, $id)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12,7])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $projectPayment = ProjectPayment::findOrFail($id);

        return view('project_payments.edit', compact(
            'project',
            'projectPayment'
        ));
    }


    /**
     * Update the specified ProjectPayment in storage.
     */
    /*public function update($id, UpdateProjectPaymentRequest $request)
{
    $projectPayment = $this->projectPaymentRepository->find($id);

    if (empty($projectPayment)) {
        Flash::error('Project Payment not found');

        return redirect()->route(
            'projects.project-payments.index',
            ['project' => $request->project_id]
        );
    }

    $projectPayment->fill(
        $request->only([
            'payment_no',
            'payer_type',
            'total_amount',
            'vat_amount',
            'net_amount',
            'payment_date'
        ])
    );

    if ($request->input('attachments.1.delete') == 1) {
        if ($projectPayment->attachment) {
            @unlink(public_path('Files/'.$projectPayment->attachment));
        }
        $projectPayment->attachment = null;
    }

    if ($request->hasFile('attachments.1.file')) {
        $file = $request->file('attachments.1.file');
        $name = time().'_1_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $name);
        $projectPayment->attachment = $name;
    }

    foreach ([2,3] as $i) {
        if ($request->input("attachments.$i.delete") == 1) {
            if ($projectPayment->{'attachment_'.$i}) {
                @unlink(public_path('Files/'.$projectPayment->{'attachment_'.$i}));
            }
            $projectPayment->{'attachment_'.$i} = null;
        }

        if ($request->hasFile("attachments.$i.file")) {
            $file = $request->file("attachments.$i.file");
            $name = time().'_'.$i.'_'.$file->getClientOriginalName();
            $file->move(public_path('Files'), $name);
            $projectPayment->{'attachment_'.$i} = $name;
        }
    }

    $projectPayment->save();

    Flash::success('Project Payment updated successfully.');

    return redirect()->route(
        'projects.project-payments.index',
        ['project' => $projectPayment->project_id]
    )->with([
        'toast' => [
            'type' => 'success',
            'message' => __('تم حفظ الدفعة بنجاح')
        ]
    ]);
}*/



public function update($id, UpdateProjectPaymentRequest $request)
{
    if (!in_array(auth()->user()->role_id, [1,4,11,12,7])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
    $projectPayment = $this->projectPaymentRepository->find($id);

    if (!$projectPayment) {
        //dd('not found'.$id);
        Flash::error('Project Payment not found');
        return redirect()->route('projects.project-payments.index', [
            'project' => $request->project_id
        ]);
    }

    // تحديث الحقول
    $projectPayment->fill($request->only([
        'payment_no', 'payer_type', 'total_amount', 'vat_amount', 'net_amount', 'payment_date'
    ]));
    
    // تحديث المرفقات
    foreach ([1,2,3] as $i) {
        $field = $i == 1 ? 'attachment' : 'attachment_'.$i;

        if ($request->input("attachments.$i.delete") == 1 && $projectPayment->$field) {
            @unlink(public_path('Files/'.$projectPayment->$field));
            $projectPayment->$field = null;
        }

        if ($request->hasFile("attachments.$i.file")) {
            $file = $request->file("attachments.$i.file");
            $name = time().'_'.$i.'_'.$file->getClientOriginalName();
            $file->move(public_path('Files'), $name);
            $projectPayment->$field = $name;
        }
    }

    $projectPayment->save();
    //dd($projectPayment);
    Flash::success('Project Payment updated successfully.');

    return redirect()->route('projects.project-payments.index', [
        'project' => $projectPayment->project_id
    ])->with([
        'toast' => [
            'type' => 'success',
            'message' => __('تم حفظ الدفعة بنجاح')
        ]
    ]);
}












    /**
     * Remove the specified ProjectPayment from storage.
     *
     * @throws \Exception
     */
    /*public function destroy($id,$projectId)
    {
        //dd($id);
        $projectPayment = $this->projectPaymentRepository->find($id);

        if (empty($projectPayment)) {
            Flash::error('Project Payment not found');

            return redirect()->route('projects.project-payments.index', [
                'project' => $projectId
            ])->with([
                'toast' => [
                    'type' => 'success',
                    'message' => __('تم حذف الدفعة بنجاح')
                ]]);
        }

        $this->projectPaymentRepository->delete($id);

        Flash::success('Project Payment deleted successfully.');

        return redirect()->route('projects.project-payments.index', [
            'project' => $projectId
        ])->with([
                'toast' => [
                    'type' => 'success',
                    'message' => __('تم حذف الدفعة بنجاح')
                ]]);
    }*/




    public function destroy($project, $id)
    {
        if (!in_array(auth()->user()->role_id, [1,4,11,12,7])) {
    return redirect()->back()->with('toast', [
        'type' => 'error',
        'message' => 'ليس لديك الصلاحيات الكافية'
    ]);
}
        $projectPayment = $this->projectPaymentRepository->find($id);

        if (empty($projectPayment)) {
            return redirect()->route('projects.project-payments.index', [
                'project' => $project
            ])->with([
                'toast' => [
                    'type' => 'error',
                    'message' => __('Project Payment not found')
                ]
            ]);
        }

        $this->projectPaymentRepository->delete($id);

        return redirect()->route('projects.project-payments.index', [
            'project' => $project
        ])->with([
            'toast' => [
                'type' => 'success',
                'message' => __('تم حذف الدفعة بنجاح')
            ]
        ]);
    }

}
