<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBaladyaStatusTypeRequest;
use App\Http\Requests\UpdateBaladyaStatusTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\BaladyaStatusTypeRepository;
use Illuminate\Http\Request;
use Flash;

class BaladyaStatusTypeController extends AppBaseController
{
    /** @var BaladyaStatusTypeRepository $baladyaStatusTypeRepository*/
    private $baladyaStatusTypeRepository;

    public function __construct(BaladyaStatusTypeRepository $baladyaStatusTypeRepo)
    {
        $this->baladyaStatusTypeRepository = $baladyaStatusTypeRepo;
    }

    /**
     * Display a listing of the BaladyaStatusType.
     */
    public function index(Request $request)
    {
        $baladyaStatusTypes = $this->baladyaStatusTypeRepository->paginate(10);

        return view('baladya_status_types.index')
            ->with('baladyaStatusTypes', $baladyaStatusTypes);
    }

    /**
     * Show the form for creating a new BaladyaStatusType.
     */
    public function create()
    {
        return view('baladya_status_types.create');
    }

    /**
     * Store a newly created BaladyaStatusType in storage.
     */
    public function store(CreateBaladyaStatusTypeRequest $request)
    {
        $input = $request->all();

        $baladyaStatusType = $this->baladyaStatusTypeRepository->create($input);

        Flash::success('Baladya Status Type saved successfully.');

        return redirect(route('baladyaStatusTypes.index'));
    }

    /**
     * Display the specified BaladyaStatusType.
     */
    public function show($id)
    {
        $baladyaStatusType = $this->baladyaStatusTypeRepository->find($id);

        if (empty($baladyaStatusType)) {
            Flash::error('Baladya Status Type not found');

            return redirect(route('baladyaStatusTypes.index'));
        }

        return view('baladya_status_types.show')->with('baladyaStatusType', $baladyaStatusType);
    }

    /**
     * Show the form for editing the specified BaladyaStatusType.
     */
    public function edit($id)
    {
        $baladyaStatusType = $this->baladyaStatusTypeRepository->find($id);

        if (empty($baladyaStatusType)) {
            Flash::error('Baladya Status Type not found');

            return redirect(route('baladyaStatusTypes.index'));
        }

        return view('baladya_status_types.edit')->with('baladyaStatusType', $baladyaStatusType);
    }

    /**
     * Update the specified BaladyaStatusType in storage.
     */
    public function update($id, UpdateBaladyaStatusTypeRequest $request)
    {
        $baladyaStatusType = $this->baladyaStatusTypeRepository->find($id);

        if (empty($baladyaStatusType)) {
            Flash::error('Baladya Status Type not found');

            return redirect(route('baladyaStatusTypes.index'));
        }

        $baladyaStatusType = $this->baladyaStatusTypeRepository->update($request->all(), $id);

        Flash::success('Baladya Status Type updated successfully.');

        return redirect(route('baladyaStatusTypes.index'));
    }

    /**
     * Remove the specified BaladyaStatusType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $baladyaStatusType = $this->baladyaStatusTypeRepository->find($id);

        if (empty($baladyaStatusType)) {
            Flash::error('Baladya Status Type not found');

            return redirect(route('baladyaStatusTypes.index'));
        }

        $this->baladyaStatusTypeRepository->delete($id);

        Flash::success('Baladya Status Type deleted successfully.');

        return redirect(route('baladyaStatusTypes.index'));
    }
}
