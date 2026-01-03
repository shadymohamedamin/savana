<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHouseTypeRequest;
use App\Http\Requests\UpdateHouseTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\HouseTypeRepository;
use Illuminate\Http\Request;
use Flash;

class HouseTypeController extends AppBaseController
{
    /** @var HouseTypeRepository $houseTypeRepository*/
    private $houseTypeRepository;

    public function __construct(HouseTypeRepository $houseTypeRepo)
    {
        $this->houseTypeRepository = $houseTypeRepo;
    }

    /**
     * Display a listing of the HouseType.
     */
    public function index(Request $request)
    {
        $houseTypes = $this->houseTypeRepository->paginate(10);

        return view('house_types.index')
            ->with('houseTypes', $houseTypes);
    }

    /**
     * Show the form for creating a new HouseType.
     */
    public function create()
    {
        return view('house_types.create');
    }

    /**
     * Store a newly created HouseType in storage.
     */
    public function store(CreateHouseTypeRequest $request)
    {
        $input = $request->all();

        $houseType = $this->houseTypeRepository->create($input);

        Flash::success('House Type saved successfully.');

        return redirect(route('houseTypes.index'));
    }

    /**
     * Display the specified HouseType.
     */
    public function show($id)
    {
        $houseType = $this->houseTypeRepository->find($id);

        if (empty($houseType)) {
            Flash::error('House Type not found');

            return redirect(route('houseTypes.index'));
        }

        return view('house_types.show')->with('houseType', $houseType);
    }

    /**
     * Show the form for editing the specified HouseType.
     */
    public function edit($id)
    {
        $houseType = $this->houseTypeRepository->find($id);

        if (empty($houseType)) {
            Flash::error('House Type not found');

            return redirect(route('houseTypes.index'));
        }

        return view('house_types.edit')->with('houseType', $houseType);
    }

    /**
     * Update the specified HouseType in storage.
     */
    public function update($id, UpdateHouseTypeRequest $request)
    {
        $houseType = $this->houseTypeRepository->find($id);

        if (empty($houseType)) {
            Flash::error('House Type not found');

            return redirect(route('houseTypes.index'));
        }

        $houseType = $this->houseTypeRepository->update($request->all(), $id);

        Flash::success('House Type updated successfully.');

        return redirect(route('houseTypes.index'));
    }

    /**
     * Remove the specified HouseType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $houseType = $this->houseTypeRepository->find($id);

        if (empty($houseType)) {
            Flash::error('House Type not found');

            return redirect(route('houseTypes.index'));
        }

        $this->houseTypeRepository->delete($id);

        Flash::success('House Type deleted successfully.');

        return redirect(route('houseTypes.index'));
    }
}
