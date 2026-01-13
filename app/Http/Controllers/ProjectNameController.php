<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectNameRequest;
use App\Http\Requests\UpdateProjectNameRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectNameRepository;
use Illuminate\Http\Request;
use Flash;

class ProjectNameController extends AppBaseController
{
    /** @var ProjectNameRepository $projectNameRepository*/
    private $projectNameRepository;

    public function __construct(ProjectNameRepository $projectNameRepo)
    {
        $this->projectNameRepository = $projectNameRepo;
    }

    /**
     * Display a listing of the ProjectName.
     */
    public function index(Request $request)
    {
        $projectNames = $this->projectNameRepository->paginate(10);

        return view('project_names.index')
            ->with('projectNames', $projectNames);
    }

    /**
     * Show the form for creating a new ProjectName.
     */
    public function create()
    {
        return view('project_names.create');
    }

    /**
     * Store a newly created ProjectName in storage.
     */
    public function store(CreateProjectNameRequest $request)
    {
        $input = $request->all();

        $projectName = $this->projectNameRepository->create($input);

        Flash::success('Project Name saved successfully.');

        return redirect(route('projectNames.index'));
    }

    /**
     * Display the specified ProjectName.
     */
    public function show($id)
    {
        $projectName = $this->projectNameRepository->find($id);

        if (empty($projectName)) {
            Flash::error('Project Name not found');

            return redirect(route('projectNames.index'));
        }

        return view('project_names.show')->with('projectName', $projectName);
    }

    /**
     * Show the form for editing the specified ProjectName.
     */
    public function edit($id)
    {
        $projectName = $this->projectNameRepository->find($id);

        if (empty($projectName)) {
            Flash::error('Project Name not found');

            return redirect(route('projectNames.index'));
        }

        return view('project_names.edit')->with('projectName', $projectName);
    }

    /**
     * Update the specified ProjectName in storage.
     */
    public function update($id, UpdateProjectNameRequest $request)
    {
        $projectName = $this->projectNameRepository->find($id);

        if (empty($projectName)) {
            Flash::error('Project Name not found');

            return redirect(route('projectNames.index'));
        }

        $projectName = $this->projectNameRepository->update($request->all(), $id);

        Flash::success('Project Name updated successfully.');

        return redirect(route('projectNames.index'));
    }

    /**
     * Remove the specified ProjectName from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectName = $this->projectNameRepository->find($id);

        if (empty($projectName)) {
            Flash::error('Project Name not found');

            return redirect(route('projectNames.index'));
        }

        $this->projectNameRepository->delete($id);

        Flash::success('Project Name deleted successfully.');

        return redirect(route('projectNames.index'));
    }
}
