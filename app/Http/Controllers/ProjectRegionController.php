<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectRegionRequest;
use App\Http\Requests\UpdateProjectRegionRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectRegionRepository;
use Illuminate\Http\Request;
use Flash;

class ProjectRegionController extends AppBaseController
{
    /** @var ProjectRegionRepository $projectRegionRepository*/
    private $projectRegionRepository;

    public function __construct(ProjectRegionRepository $projectRegionRepo)
    {
        $this->projectRegionRepository = $projectRegionRepo;
    }

    /**
     * Display a listing of the ProjectRegion.
     */
    public function index(Request $request)
    {
        $projectRegions = $this->projectRegionRepository->paginate(10);

        return view('project_regions.index')
            ->with('projectRegions', $projectRegions);
    }

    /**
     * Show the form for creating a new ProjectRegion.
     */
    public function create()
    {
        return view('project_regions.create');
    }

    /**
     * Store a newly created ProjectRegion in storage.
     */
    public function store(CreateProjectRegionRequest $request)
    {
        $input = $request->all();

        $projectRegion = $this->projectRegionRepository->create($input);

        Flash::success('Project Region saved successfully.');

        return redirect(route('projectRegions.index'));
    }

    /**
     * Display the specified ProjectRegion.
     */
    public function show($id)
    {
        $projectRegion = $this->projectRegionRepository->find($id);

        if (empty($projectRegion)) {
            Flash::error('Project Region not found');

            return redirect(route('projectRegions.index'));
        }

        return view('project_regions.show')->with('projectRegion', $projectRegion);
    }

    /**
     * Show the form for editing the specified ProjectRegion.
     */
    public function edit($id)
    {
        $projectRegion = $this->projectRegionRepository->find($id);

        if (empty($projectRegion)) {
            Flash::error('Project Region not found');

            return redirect(route('projectRegions.index'));
        }

        return view('project_regions.edit')->with('projectRegion', $projectRegion);
    }

    /**
     * Update the specified ProjectRegion in storage.
     */
    public function update($id, UpdateProjectRegionRequest $request)
    {
        $projectRegion = $this->projectRegionRepository->find($id);

        if (empty($projectRegion)) {
            Flash::error('Project Region not found');

            return redirect(route('projectRegions.index'));
        }

        $projectRegion = $this->projectRegionRepository->update($request->all(), $id);

        Flash::success('Project Region updated successfully.');

        return redirect(route('projectRegions.index'));
    }

    /**
     * Remove the specified ProjectRegion from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectRegion = $this->projectRegionRepository->find($id);

        if (empty($projectRegion)) {
            Flash::error('Project Region not found');

            return redirect(route('projectRegions.index'));
        }

        $this->projectRegionRepository->delete($id);

        Flash::success('Project Region deleted successfully.');

        return redirect(route('projectRegions.index'));
    }
}
