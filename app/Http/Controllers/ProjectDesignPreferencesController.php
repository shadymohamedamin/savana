<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectDesignPreferencesRequest;
use App\Http\Requests\UpdateProjectDesignPreferencesRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectDesignPreferencesRepository;
use Illuminate\Http\Request;
use Flash;

class ProjectDesignPreferencesController extends AppBaseController
{
    /** @var ProjectDesignPreferencesRepository $projectDesignPreferencesRepository*/
    private $projectDesignPreferencesRepository;

    public function __construct(ProjectDesignPreferencesRepository $projectDesignPreferencesRepo)
    {
        $this->projectDesignPreferencesRepository = $projectDesignPreferencesRepo;
    }

    /**
     * Display a listing of the ProjectDesignPreferences.
     */
    public function index(Request $request)
    {
        $projectDesignPreferences = $this->projectDesignPreferencesRepository->paginate(10);

        return view('project_design_preferences.index')
            ->with('projectDesignPreferences', $projectDesignPreferences);
    }

    /**
     * Show the form for creating a new ProjectDesignPreferences.
     */
    public function create()
    {
        return view('project_design_preferences.create');
    }

    /**
     * Store a newly created ProjectDesignPreferences in storage.
     */
    public function store(CreateProjectDesignPreferencesRequest $request)
    {
        $input = $request->all();

        $projectDesignPreferences = $this->projectDesignPreferencesRepository->create($input);

        Flash::success('Project Design Preferences saved successfully.');

        return redirect(route('projectDesignPreferences.index'));
    }

    /**
     * Display the specified ProjectDesignPreferences.
     */
    public function show($id)
    {
        $projectDesignPreferences = $this->projectDesignPreferencesRepository->find($id);

        if (empty($projectDesignPreferences)) {
            Flash::error('Project Design Preferences not found');

            return redirect(route('projectDesignPreferences.index'));
        }

        return view('project_design_preferences.show')->with('projectDesignPreferences', $projectDesignPreferences);
    }

    /**
     * Show the form for editing the specified ProjectDesignPreferences.
     */
    public function edit($id)
    {
        $projectDesignPreferences = $this->projectDesignPreferencesRepository->find($id);

        if (empty($projectDesignPreferences)) {
            Flash::error('Project Design Preferences not found');

            return redirect(route('projectDesignPreferences.index'));
        }

        return view('project_design_preferences.edit')->with('projectDesignPreferences', $projectDesignPreferences);
    }

    /**
     * Update the specified ProjectDesignPreferences in storage.
     */
    public function update($id, UpdateProjectDesignPreferencesRequest $request)
    {
        $projectDesignPreferences = $this->projectDesignPreferencesRepository->find($id);

        if (empty($projectDesignPreferences)) {
            Flash::error('Project Design Preferences not found');

            return redirect(route('projectDesignPreferences.index'));
        }

        $projectDesignPreferences = $this->projectDesignPreferencesRepository->update($request->all(), $id);

        Flash::success('Project Design Preferences updated successfully.');

        return redirect(route('projectDesignPreferences.index'));
    }

    /**
     * Remove the specified ProjectDesignPreferences from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectDesignPreferences = $this->projectDesignPreferencesRepository->find($id);

        if (empty($projectDesignPreferences)) {
            Flash::error('Project Design Preferences not found');

            return redirect(route('projectDesignPreferences.index'));
        }

        $this->projectDesignPreferencesRepository->delete($id);

        Flash::success('Project Design Preferences deleted successfully.');

        return redirect(route('projectDesignPreferences.index'));
    }
}
