<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOwnerRequirementRequest;
use App\Http\Requests\UpdateOwnerRequirementRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OwnerRequirementRepository;
use Illuminate\Http\Request;
use Flash;
use App\Models\Project;
use App\Models\OwnerRequirement;

class OwnerRequirementController extends AppBaseController
{
    /** @var OwnerRequirementRepository $ownerRequirementRepository*/
    private $ownerRequirementRepository;

    public function __construct(OwnerRequirementRepository $ownerRequirementRepo)
    {
        $this->ownerRequirementRepository = $ownerRequirementRepo;
    }

    /**
     * Display a listing of the OwnerRequirement.
     */
    public function index(Project $project)
    {
        $requirements = OwnerRequirement::all()->groupBy('floor');

        $selected = $project->ownerRequirements
            ->keyBy('id');

        $design = $project->designPreferences; // العلاقة
        //dd($requirements);
        return view('projects.owner-requirements.index', compact(
            'project',
            'requirements',
            'selected',
            'design'
        ));

    }

    /**
     * Show the form for creating a new OwnerRequirement.
     */
    public function create()
    {
        return view('owner_requirements.create');
    }

    /**
     * Store a newly created OwnerRequirement in storage.
     */
    /*public function store(Request $request, Project $project)
{

    $syncData = [];

    foreach ($request->requirements ?? [] as $reqId => $data) {

        $qty = $data['quantity'] ?? null;
        $notes = $data['notes'] ?? null;

        if (!empty($qty) && $qty > 0) {
            $syncData[$reqId] = [
                'quantity' => $qty,
                'notes' => $notes,
            ];
        }
    }


    $project->ownerRequirements()->sync($syncData);

    if ($request->filled('design')) {
        $project->designPreferences()->updateOrCreate(
            ['project_id' => $project->id],
            $request->design
        );
    }

    return redirect()->back()->with('toast', [
        'type' => 'success',
        'message' => 'تم حفظ متطلبات المالك وأفكار التصميم بنجاح'
    ]);
}*/




public function store(Request $request, Project $project)
{
    $syncData = [];

    foreach ($request->requirements ?? [] as $reqId => $data) {

        $qty = $data['quantity'] ?? null;
        $notes = $data['notes'] ?? null;

        if ($qty !== null && $qty > 0) {
            $syncData[$reqId] = [
                'quantity' => (int)$qty,
                'notes' => $notes,
            ];
        }
    }

    try {
        $project->ownerRequirements()->sync($syncData);
    } catch (\Throwable $e) {
        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => $e->getMessage()
        ]);
    }


    if ($request->filled('design')) {
        $project->designPreferences()->updateOrCreate(
            ['project_id' => $project->id],
            $request->design
        );
    }

    return redirect()->back()->with('toast', [
        'type' => 'success',
        'message' => 'تم حفظ متطلبات المالك وأفكار التصميم بنجاح'
    ]);
}




    public function print(Project $project)
    {
        $requirements = $project->ownerRequirements
            ->groupBy('floor');

        return view('projects.owner-requirements.print', compact(
            'project',
            'requirements'
        ));
    }

    /**
     * Display the specified OwnerRequirement.
     */
    public function show($id)
    {
        $ownerRequirement = $this->ownerRequirementRepository->find($id);

        if (empty($ownerRequirement)) {
            Flash::error('Owner Requirement not found');

            return redirect(route('ownerRequirements.index'));
        }

        return view('owner_requirements.show')->with('ownerRequirement', $ownerRequirement);
    }

    /**
     * Show the form for editing the specified OwnerRequirement.
     */
    public function edit($id)
    {
        $ownerRequirement = $this->ownerRequirementRepository->find($id);

        if (empty($ownerRequirement)) {
            Flash::error('Owner Requirement not found');

            return redirect(route('ownerRequirements.index'));
        }

        return view('owner_requirements.edit')->with('ownerRequirement', $ownerRequirement);
    }

    /**
     * Update the specified OwnerRequirement in storage.
     */
    public function update($id, UpdateOwnerRequirementRequest $request)
    {
        $ownerRequirement = $this->ownerRequirementRepository->find($id);

        if (empty($ownerRequirement)) {
            Flash::error('Owner Requirement not found');

            return redirect(route('ownerRequirements.index'));
        }

        $ownerRequirement = $this->ownerRequirementRepository->update($request->all(), $id);

        Flash::success('Owner Requirement updated successfully.');

        return redirect(route('ownerRequirements.index'));
    }

    /**
     * Remove the specified OwnerRequirement from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ownerRequirement = $this->ownerRequirementRepository->find($id);

        if (empty($ownerRequirement)) {
            Flash::error('Owner Requirement not found');

            return redirect(route('ownerRequirements.index'));
        }

        $this->ownerRequirementRepository->delete($id);

        Flash::success('Owner Requirement deleted successfully.');

        return redirect(route('ownerRequirements.index'));
    }
}
