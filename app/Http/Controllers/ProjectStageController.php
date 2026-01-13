<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectStageRequest;
use App\Http\Requests\UpdateProjectStageRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectStageRepository;
use Illuminate\Http\Request;
use Flash;

class ProjectStageController extends AppBaseController
{
    /** @var ProjectStageRepository $projectStageRepository*/
    private $projectStageRepository;

    public function __construct(ProjectStageRepository $projectStageRepo)
    {
        $this->projectStageRepository = $projectStageRepo;
    }

    /**
     * Display a listing of the ProjectStage.
     */
    public function index(Request $request)
    {
        $projectStages = $this->projectStageRepository->paginate(10);

        return view('project_stages.index')
            ->with('projectStages', $projectStages);
    }

    /**
     * Show the form for creating a new ProjectStage.
     */
    public function create()
    {
        return view('project_stages.create');
    }

    /**
     * Store a newly created ProjectStage in storage.
     */
    public function store(CreateProjectStageRequest $request)
    {
        $input = $request->all();

        $projectStage = $this->projectStageRepository->create($input);

        Flash::success('Project Stage saved successfully.');

        return redirect(route('projectStages.index'));
    }

    /**
     * Display the specified ProjectStage.
     */
    public function show($id)
    {
        $projectStage = $this->projectStageRepository->find($id);

        if (empty($projectStage)) {
            Flash::error('Project Stage not found');

            return redirect(route('projectStages.index'));
        }

        return view('project_stages.show')->with('projectStage', $projectStage);
    }

    /**
     * Show the form for editing the specified ProjectStage.
     */
    public function edit($id)
    {
        $projectStage = $this->projectStageRepository->find($id);

        if (empty($projectStage)) {
            Flash::error('Project Stage not found');

            return redirect(route('projectStages.index'));
        }

        return view('project_stages.edit')->with('projectStage', $projectStage);
    }

    /**
     * Update the specified ProjectStage in storage.
     */
    public function update($id, UpdateProjectStageRequest $request)
    {
        $projectStage = $this->projectStageRepository->find($id);

        if (empty($projectStage)) {
            Flash::error('Project Stage not found');

            return redirect(route('projectStages.index'));
        }

        $projectStage = $this->projectStageRepository->update($request->all(), $id);

        Flash::success('Project Stage updated successfully.');

        return redirect(route('projectStages.index'));
    }

    /**
     * Remove the specified ProjectStage from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectStage = $this->projectStageRepository->find($id);

        if (empty($projectStage)) {
            Flash::error('Project Stage not found');

            return redirect(route('projectStages.index'));
        }

        $this->projectStageRepository->delete($id);

        Flash::success('Project Stage deleted successfully.');

        return redirect(route('projectStages.index'));
    }
}
