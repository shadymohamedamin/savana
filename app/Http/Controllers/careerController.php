<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecareerRequest;
use App\Http\Requests\UpdatecareerRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\careerRepository;
use Illuminate\Http\Request;
use Flash;

class careerController extends AppBaseController
{
    /** @var careerRepository $careerRepository*/
    private $careerRepository;

    public function __construct(careerRepository $careerRepo)
    {
        $this->careerRepository = $careerRepo;
    }

    /**
     * Display a listing of the career.
     */
    public function index(Request $request)
    {
        $careers = $this->careerRepository->paginate(10);

        return view('careers.index')
            ->with('careers', $careers);
    }

    /**
     * Show the form for creating a new career.
     */
    public function create()
    {
        return view('careers.create');
    }

    /**
     * Store a newly created career in storage.
     */
    public function store(CreatecareerRequest $request)
    {
        $input = $request->all();

        $career = $this->careerRepository->create($input);

        Flash::success('Career saved successfully.');

        return redirect(route('careers.index'));
    }

    /**
     * Display the specified career.
     */
    public function show($id)
    {
        $career = $this->careerRepository->find($id);

        if (empty($career)) {
            Flash::error('Career not found');

            return redirect(route('careers.index'));
        }

        return view('careers.show')->with('career', $career);
    }

    /**
     * Show the form for editing the specified career.
     */
    public function edit($id)
    {
        $career = $this->careerRepository->find($id);

        if (empty($career)) {
            Flash::error('Career not found');

            return redirect(route('careers.index'));
        }

        return view('careers.edit')->with('career', $career);
    }

    /**
     * Update the specified career in storage.
     */
    public function update($id, UpdatecareerRequest $request)
    {
        $career = $this->careerRepository->find($id);

        if (empty($career)) {
            Flash::error('Career not found');

            return redirect(route('careers.index'));
        }

        $career = $this->careerRepository->update($request->all(), $id);

        Flash::success('Career updated successfully.');

        return redirect(route('careers.index'));
    }

    /**
     * Remove the specified career from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $career = $this->careerRepository->find($id);

        if (empty($career)) {
            Flash::error('Career not found');

            return redirect(route('careers.index'));
        }

        $this->careerRepository->delete($id);

        Flash::success('Career deleted successfully.');

        return redirect(route('careers.index'));
    }
}
