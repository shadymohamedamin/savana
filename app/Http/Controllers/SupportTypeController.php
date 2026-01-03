<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupportTypeRequest;
use App\Http\Requests\UpdateSupportTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SupportTypeRepository;
use Illuminate\Http\Request;
use Flash;

class SupportTypeController extends AppBaseController
{
    /** @var SupportTypeRepository $supportTypeRepository*/
    private $supportTypeRepository;

    public function __construct(SupportTypeRepository $supportTypeRepo)
    {
        $this->supportTypeRepository = $supportTypeRepo;
    }

    /**
     * Display a listing of the SupportType.
     */
    public function index(Request $request)
    {
        $supportTypes = $this->supportTypeRepository->paginate(10);

        return view('support_types.index')
            ->with('supportTypes', $supportTypes);
    }

    /**
     * Show the form for creating a new SupportType.
     */
    public function create()
    {
        return view('support_types.create');
    }

    /**
     * Store a newly created SupportType in storage.
     */
    public function store(CreateSupportTypeRequest $request)
    {
        $input = $request->all();

        $supportType = $this->supportTypeRepository->create($input);

        Flash::success('Support Type saved successfully.');

        return redirect(route('supportTypes.index'));
    }

    /**
     * Display the specified SupportType.
     */
    public function show($id)
    {
        $supportType = $this->supportTypeRepository->find($id);

        if (empty($supportType)) {
            Flash::error('Support Type not found');

            return redirect(route('supportTypes.index'));
        }

        return view('support_types.show')->with('supportType', $supportType);
    }

    /**
     * Show the form for editing the specified SupportType.
     */
    public function edit($id)
    {
        $supportType = $this->supportTypeRepository->find($id);

        if (empty($supportType)) {
            Flash::error('Support Type not found');

            return redirect(route('supportTypes.index'));
        }

        return view('support_types.edit')->with('supportType', $supportType);
    }

    /**
     * Update the specified SupportType in storage.
     */
    public function update($id, UpdateSupportTypeRequest $request)
    {
        $supportType = $this->supportTypeRepository->find($id);

        if (empty($supportType)) {
            Flash::error('Support Type not found');

            return redirect(route('supportTypes.index'));
        }

        $supportType = $this->supportTypeRepository->update($request->all(), $id);

        Flash::success('Support Type updated successfully.');

        return redirect(route('supportTypes.index'));
    }

    /**
     * Remove the specified SupportType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $supportType = $this->supportTypeRepository->find($id);

        if (empty($supportType)) {
            Flash::error('Support Type not found');

            return redirect(route('supportTypes.index'));
        }

        $this->supportTypeRepository->delete($id);

        Flash::success('Support Type deleted successfully.');

        return redirect(route('supportTypes.index'));
    }
}
