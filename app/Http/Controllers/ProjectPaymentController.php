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
        $vat = round($total * 0.05, 2);
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


    public function index($project)
    {
        $project = Project::findOrFail($project);

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
        $project = Project::findOrFail($projectId);

        return view('project_payments.create', compact('project'));
    }


    
    /**
     * Store a newly created ProjectPayment in storage.
     */
    public function store(Request $request, $projectId)
    {
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

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('Files'), $name);
            $data['attachment'] = $name;
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
    public function edit($id)
    {
        $projectPayment = $this->projectPaymentRepository->find($id);

        if (empty($projectPayment)) {
            Flash::error('Project Payment not found');

            return redirect(route('projectPayments.index'));
        }

        return view('project_payments.edit')->with('projectPayment', $projectPayment);
    }

    /**
     * Update the specified ProjectPayment in storage.
     */
    public function update($id, UpdateProjectPaymentRequest $request)
    {
        $projectPayment = $this->projectPaymentRepository->find($id);

        if (empty($projectPayment)) {
            Flash::error('Project Payment not found');

            return redirect(route('projectPayments.index'));
        }

        $projectPayment = $this->projectPaymentRepository->update($request->all(), $id);

        Flash::success('Project Payment updated successfully.');

        return redirect(route('projectPayments.index'));
    }

    /**
     * Remove the specified ProjectPayment from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectPayment = $this->projectPaymentRepository->find($id);

        if (empty($projectPayment)) {
            Flash::error('Project Payment not found');

            return redirect(route('projectPayments.index'));
        }

        $this->projectPaymentRepository->delete($id);

        Flash::success('Project Payment deleted successfully.');

        return redirect(route('projectPayments.index'));
    }
}
