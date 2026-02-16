<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectOwnerSpecificationRequest;
use App\Http\Requests\UpdateProjectOwnerSpecificationRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectOwnerSpecificationRepository;
use Illuminate\Http\Request;
use Flash;

class ProjectOwnerSpecificationController extends AppBaseController
{
    /** @var ProjectOwnerSpecificationRepository $projectOwnerSpecificationRepository*/
    private $projectOwnerSpecificationRepository;

    public function __construct(ProjectOwnerSpecificationRepository $projectOwnerSpecificationRepo)
    {
        $this->projectOwnerSpecificationRepository = $projectOwnerSpecificationRepo;
    }

    /**
     * Display a listing of the ProjectOwnerSpecification.
     */
    public function index(Request $request)
    {
        $projectOwnerSpecifications = $this->projectOwnerSpecificationRepository->paginate(10);

        return view('project_owner_specifications.index')
            ->with('projectOwnerSpecifications', $projectOwnerSpecifications);
    }

    /**
     * Show the form for creating a new ProjectOwnerSpecification.
     */
    public function create()
    {
        return view('project_owner_specifications.create');
    }

    /**
     * Store a newly created ProjectOwnerSpecification in storage.
     */
    public function store(CreateProjectOwnerSpecificationRequest $request)
    {
        $input = $request->all();

        $projectOwnerSpecification = $this->projectOwnerSpecificationRepository->create($input);

        Flash::success('Project Owner Specification saved successfully.');

        return redirect(route('projectOwnerSpecifications.index'));
    }

    /**
     * Display the specified ProjectOwnerSpecification.
     */
    public function show($id)
    {
        $projectOwnerSpecification = $this->projectOwnerSpecificationRepository->find($id);

        if (empty($projectOwnerSpecification)) {
            Flash::error('Project Owner Specification not found');

            return redirect(route('projectOwnerSpecifications.index'));
        }

        return view('project_owner_specifications.show')->with('projectOwnerSpecification', $projectOwnerSpecification);
    }

    /**
     * Show the form for editing the specified ProjectOwnerSpecification.
     */
    public function edit($id)
    {
        $projectOwnerSpecification = $this->projectOwnerSpecificationRepository->find($id);

        if (empty($projectOwnerSpecification)) {
            Flash::error('Project Owner Specification not found');

            return redirect(route('projectOwnerSpecifications.index'));
        }

        return view('project_owner_specifications.edit')->with('projectOwnerSpecification', $projectOwnerSpecification);
    }

    /**
     * Update the specified ProjectOwnerSpecification in storage.
     */
    public function update($id, UpdateProjectOwnerSpecificationRequest $request)
    {
        $projectOwnerSpecification = $this->projectOwnerSpecificationRepository->find($id);

        if (empty($projectOwnerSpecification)) {
            Flash::error('Project Owner Specification not found');

            return redirect(route('projectOwnerSpecifications.index'));
        }

        $projectOwnerSpecification = $this->projectOwnerSpecificationRepository->update($request->all(), $id);

        Flash::success('Project Owner Specification updated successfully.');

        return redirect(route('projectOwnerSpecifications.index'));
    }

    /**
     * Remove the specified ProjectOwnerSpecification from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectOwnerSpecification = $this->projectOwnerSpecificationRepository->find($id);

        if (empty($projectOwnerSpecification)) {
            Flash::error('Project Owner Specification not found');

            return redirect(route('projectOwnerSpecifications.index'));
        }

        $this->projectOwnerSpecificationRepository->delete($id);

        Flash::success('Project Owner Specification deleted successfully.');

        return redirect(route('projectOwnerSpecifications.index'));
    }
}
