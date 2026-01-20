<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectOwnerRequirementRequest;
use App\Http\Requests\UpdateProjectOwnerRequirementRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectOwnerRequirementRepository;
use Illuminate\Http\Request;
use Flash;

class ProjectOwnerRequirementController extends AppBaseController
{
    /** @var ProjectOwnerRequirementRepository $projectOwnerRequirementRepository*/
    private $projectOwnerRequirementRepository;

    public function __construct(ProjectOwnerRequirementRepository $projectOwnerRequirementRepo)
    {
        $this->projectOwnerRequirementRepository = $projectOwnerRequirementRepo;
    }

    /**
     * Display a listing of the ProjectOwnerRequirement.
     */
    public function index(Request $request)
    {
        $projectOwnerRequirements = $this->projectOwnerRequirementRepository->paginate(10);

        return view('project_owner_requirements.index')
            ->with('projectOwnerRequirements', $projectOwnerRequirements);
    }

    /**
     * Show the form for creating a new ProjectOwnerRequirement.
     */
    public function create()
    {
        return view('project_owner_requirements.create');
    }

    /**
     * Store a newly created ProjectOwnerRequirement in storage.
     */
    public function store(CreateProjectOwnerRequirementRequest $request)
    {
        $input = $request->all();

        $projectOwnerRequirement = $this->projectOwnerRequirementRepository->create($input);

        Flash::success('Project Owner Requirement saved successfully.');

        return redirect(route('projectOwnerRequirements.index'));
    }

    /**
     * Display the specified ProjectOwnerRequirement.
     */
    public function show($id)
    {
        $projectOwnerRequirement = $this->projectOwnerRequirementRepository->find($id);

        if (empty($projectOwnerRequirement)) {
            Flash::error('Project Owner Requirement not found');

            return redirect(route('projectOwnerRequirements.index'));
        }

        return view('project_owner_requirements.show')->with('projectOwnerRequirement', $projectOwnerRequirement);
    }

    /**
     * Show the form for editing the specified ProjectOwnerRequirement.
     */
    public function edit($id)
    {
        $projectOwnerRequirement = $this->projectOwnerRequirementRepository->find($id);

        if (empty($projectOwnerRequirement)) {
            Flash::error('Project Owner Requirement not found');

            return redirect(route('projectOwnerRequirements.index'));
        }

        return view('project_owner_requirements.edit')->with('projectOwnerRequirement', $projectOwnerRequirement);
    }

    /**
     * Update the specified ProjectOwnerRequirement in storage.
     */
    public function update($id, UpdateProjectOwnerRequirementRequest $request)
    {
        $projectOwnerRequirement = $this->projectOwnerRequirementRepository->find($id);

        if (empty($projectOwnerRequirement)) {
            Flash::error('Project Owner Requirement not found');

            return redirect(route('projectOwnerRequirements.index'));
        }

        $projectOwnerRequirement = $this->projectOwnerRequirementRepository->update($request->all(), $id);

        Flash::success('Project Owner Requirement updated successfully.');

        return redirect(route('projectOwnerRequirements.index'));
    }

    /**
     * Remove the specified ProjectOwnerRequirement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectOwnerRequirement = $this->projectOwnerRequirementRepository->find($id);

        if (empty($projectOwnerRequirement)) {
            Flash::error('Project Owner Requirement not found');

            return redirect(route('projectOwnerRequirements.index'));
        }

        $this->projectOwnerRequirementRepository->delete($id);

        Flash::success('Project Owner Requirement deleted successfully.');

        return redirect(route('projectOwnerRequirements.index'));
    }
}
