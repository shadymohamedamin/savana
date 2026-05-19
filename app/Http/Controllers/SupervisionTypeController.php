<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSupervisionTypeRequest;
use App\Http\Requests\UpdateSupervisionTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SupervisionTypeRepository;
use Illuminate\Http\Request;
use Flash;

class SupervisionTypeController extends AppBaseController
{
    /** @var SupervisionTypeRepository $supervisionTypeRepository*/
    private $supervisionTypeRepository;

    public function __construct(SupervisionTypeRepository $supervisionTypeRepo)
    {
        $this->supervisionTypeRepository = $supervisionTypeRepo;
    }

    /**
     * Display a listing of the SupervisionType.
     */
    public function index(Request $request)
    {
        $supervisionTypes = $this->supervisionTypeRepository->paginate(10);

        return view('supervision_types.index')
            ->with('supervisionTypes', $supervisionTypes);
    }

    /**
     * Show the form for creating a new SupervisionType.
     */
    public function create()
    {
        return view('supervision_types.create');
    }

    /**
     * Store a newly created SupervisionType in storage.
     */
    public function store(CreateSupervisionTypeRequest $request)
    {
        $input = $request->all();

        $supervisionType = $this->supervisionTypeRepository->create($input);

        Flash::success('Supervision Type saved successfully.');

        return redirect(route('supervisionTypes.index'));
    }

    /**
     * Display the specified SupervisionType.
     */
    public function show($id)
    {
        $supervisionType = $this->supervisionTypeRepository->find($id);

        if (empty($supervisionType)) {
            Flash::error('Supervision Type not found');

            return redirect(route('supervisionTypes.index'));
        }

        return view('supervision_types.show')->with('supervisionType', $supervisionType);
    }

    /**
     * Show the form for editing the specified SupervisionType.
     */
    public function edit($id)
    {
        $supervisionType = $this->supervisionTypeRepository->find($id);

        if (empty($supervisionType)) {
            Flash::error('Supervision Type not found');

            return redirect(route('supervisionTypes.index'));
        }

        return view('supervision_types.edit')->with('supervisionType', $supervisionType);
    }

    /**
     * Update the specified SupervisionType in storage.
     */
    public function update($id, UpdateSupervisionTypeRequest $request)
    {
        $supervisionType = $this->supervisionTypeRepository->find($id);

        if (empty($supervisionType)) {
            Flash::error('Supervision Type not found');

            return redirect(route('supervisionTypes.index'));
        }

        $supervisionType = $this->supervisionTypeRepository->update($request->all(), $id);

        Flash::success('Supervision Type updated successfully.');

        return redirect(route('supervisionTypes.index'));
    }

    /**
     * Remove the specified SupervisionType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $supervisionType = $this->supervisionTypeRepository->find($id);

        if (empty($supervisionType)) {
            Flash::error('Supervision Type not found');

            return redirect(route('supervisionTypes.index'));
        }

        $this->supervisionTypeRepository->delete($id);

        Flash::success('Supervision Type deleted successfully.');

        return redirect(route('supervisionTypes.index'));
    }
}
