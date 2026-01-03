<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateNationalitRequest;
use App\Http\Requests\UpdateNationalitRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\NationalitRepository;
use Illuminate\Http\Request;
use Flash;

class NationalitController extends AppBaseController
{
    /** @var NationalitRepository $nationalitRepository*/
    private $nationalitRepository;

    public function __construct(NationalitRepository $nationalitRepo)
    {
        $this->nationalitRepository = $nationalitRepo;
    }

    /**
     * Display a listing of the Nationalit.
     */
    public function index(Request $request)
    {
        $nationalits = $this->nationalitRepository->paginate(10);

        return view('nationalits.index')
            ->with('nationalits', $nationalits);
    }

    /**
     * Show the form for creating a new Nationalit.
     */
    public function create()
    {
        return view('nationalits.create');
    }

    /**
     * Store a newly created Nationalit in storage.
     */
    public function store(CreateNationalitRequest $request)
    {
        $input = $request->all();

        $nationalit = $this->nationalitRepository->create($input);

        Flash::success('Nationalit saved successfully.');

        return redirect(route('nationalits.index'));
    }

    /**
     * Display the specified Nationalit.
     */
    public function show($id)
    {
        $nationalit = $this->nationalitRepository->find($id);

        if (empty($nationalit)) {
            Flash::error('Nationalit not found');

            return redirect(route('nationalits.index'));
        }

        return view('nationalits.show')->with('nationalit', $nationalit);
    }

    /**
     * Show the form for editing the specified Nationalit.
     */
    public function edit($id)
    {
        $nationalit = $this->nationalitRepository->find($id);

        if (empty($nationalit)) {
            Flash::error('Nationalit not found');

            return redirect(route('nationalits.index'));
        }

        return view('nationalits.edit')->with('nationalit', $nationalit);
    }

    /**
     * Update the specified Nationalit in storage.
     */
    public function update($id, UpdateNationalitRequest $request)
    {
        $nationalit = $this->nationalitRepository->find($id);

        if (empty($nationalit)) {
            Flash::error('Nationalit not found');

            return redirect(route('nationalits.index'));
        }

        $nationalit = $this->nationalitRepository->update($request->all(), $id);

        Flash::success('Nationalit updated successfully.');

        return redirect(route('nationalits.index'));
    }

    /**
     * Remove the specified Nationalit from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $nationalit = $this->nationalitRepository->find($id);

        if (empty($nationalit)) {
            Flash::error('Nationalit not found');

            return redirect(route('nationalits.index'));
        }

        $this->nationalitRepository->delete($id);

        Flash::success('Nationalit deleted successfully.');

        return redirect(route('nationalits.index'));
    }
}
