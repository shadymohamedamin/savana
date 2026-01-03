<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSexRequest;
use App\Http\Requests\UpdateSexRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\SexRepository;
use Illuminate\Http\Request;
use Flash;

class SexController extends AppBaseController
{
    /** @var SexRepository $sexRepository*/
    private $sexRepository;

    public function __construct(SexRepository $sexRepo)
    {
        $this->sexRepository = $sexRepo;
    }

    /**
     * Display a listing of the Sex.
     */
    public function index(Request $request)
    {
        $sexes = $this->sexRepository->paginate(10);

        return view('sexes.index')
            ->with('sexes', $sexes);
    }

    /**
     * Show the form for creating a new Sex.
     */
    public function create()
    {
        return view('sexes.create');
    }

    /**
     * Store a newly created Sex in storage.
     */
    public function store(CreateSexRequest $request)
    {
        $input = $request->all();

        $sex = $this->sexRepository->create($input);

        Flash::success('Sex saved successfully.');

        return redirect(route('sexes.index'));
    }

    /**
     * Display the specified Sex.
     */
    public function show($id)
    {
        $sex = $this->sexRepository->find($id);

        if (empty($sex)) {
            Flash::error('Sex not found');

            return redirect(route('sexes.index'));
        }

        return view('sexes.show')->with('sex', $sex);
    }

    /**
     * Show the form for editing the specified Sex.
     */
    public function edit($id)
    {
        $sex = $this->sexRepository->find($id);

        if (empty($sex)) {
            Flash::error('Sex not found');

            return redirect(route('sexes.index'));
        }

        return view('sexes.edit')->with('sex', $sex);
    }

    /**
     * Update the specified Sex in storage.
     */
    public function update($id, UpdateSexRequest $request)
    {
        $sex = $this->sexRepository->find($id);

        if (empty($sex)) {
            Flash::error('Sex not found');

            return redirect(route('sexes.index'));
        }

        $sex = $this->sexRepository->update($request->all(), $id);

        Flash::success('Sex updated successfully.');

        return redirect(route('sexes.index'));
    }

    /**
     * Remove the specified Sex from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $sex = $this->sexRepository->find($id);

        if (empty($sex)) {
            Flash::error('Sex not found');

            return redirect(route('sexes.index'));
        }

        $this->sexRepository->delete($id);

        Flash::success('Sex deleted successfully.');

        return redirect(route('sexes.index'));
    }
}
