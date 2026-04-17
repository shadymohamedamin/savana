<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectScheduleApprovalRequest;
use App\Http\Requests\UpdateProjectScheduleApprovalRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectScheduleApprovalRepository;
use Illuminate\Http\Request;
use Flash;

class ProjectScheduleApprovalController extends AppBaseController
{
    /** @var ProjectScheduleApprovalRepository $projectScheduleApprovalRepository*/
    private $projectScheduleApprovalRepository;

    public function __construct(ProjectScheduleApprovalRepository $projectScheduleApprovalRepo)
    {
        $this->projectScheduleApprovalRepository = $projectScheduleApprovalRepo;
    }

    /**
     * Display a listing of the ProjectScheduleApproval.
     */
    public function index(Request $request)
    {
        $projectScheduleApprovals = $this->projectScheduleApprovalRepository->paginate(10);

        return view('project_schedule_approvals.index')
            ->with('projectScheduleApprovals', $projectScheduleApprovals);
    }

    /**
     * Show the form for creating a new ProjectScheduleApproval.
     */
    public function create()
    {
        return view('project_schedule_approvals.create');
    }

    /**
     * Store a newly created ProjectScheduleApproval in storage.
     */
    public function store(CreateProjectScheduleApprovalRequest $request)
    {
        $input = $request->all();

        $projectScheduleApproval = $this->projectScheduleApprovalRepository->create($input);

        Flash::success('Project Schedule Approval saved successfully.');

        return redirect(route('projectScheduleApprovals.index'));
    }

    /**
     * Display the specified ProjectScheduleApproval.
     */
    public function show($id)
    {
        $projectScheduleApproval = $this->projectScheduleApprovalRepository->find($id);

        if (empty($projectScheduleApproval)) {
            Flash::error('Project Schedule Approval not found');

            return redirect(route('projectScheduleApprovals.index'));
        }

        return view('project_schedule_approvals.show')->with('projectScheduleApproval', $projectScheduleApproval);
    }

    /**
     * Show the form for editing the specified ProjectScheduleApproval.
     */
    public function edit($id)
    {
        $projectScheduleApproval = $this->projectScheduleApprovalRepository->find($id);

        if (empty($projectScheduleApproval)) {
            Flash::error('Project Schedule Approval not found');

            return redirect(route('projectScheduleApprovals.index'));
        }

        return view('project_schedule_approvals.edit')->with('projectScheduleApproval', $projectScheduleApproval);
    }

    /**
     * Update the specified ProjectScheduleApproval in storage.
     */
    public function update($id, UpdateProjectScheduleApprovalRequest $request)
    {
        $projectScheduleApproval = $this->projectScheduleApprovalRepository->find($id);

        if (empty($projectScheduleApproval)) {
            Flash::error('Project Schedule Approval not found');

            return redirect(route('projectScheduleApprovals.index'));
        }

        $projectScheduleApproval = $this->projectScheduleApprovalRepository->update($request->all(), $id);

        Flash::success('Project Schedule Approval updated successfully.');

        return redirect(route('projectScheduleApprovals.index'));
    }

    /**
     * Remove the specified ProjectScheduleApproval from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectScheduleApproval = $this->projectScheduleApprovalRepository->find($id);

        if (empty($projectScheduleApproval)) {
            Flash::error('Project Schedule Approval not found');

            return redirect(route('projectScheduleApprovals.index'));
        }

        $this->projectScheduleApprovalRepository->delete($id);

        Flash::success('Project Schedule Approval deleted successfully.');

        return redirect(route('projectScheduleApprovals.index'));
    }
}
