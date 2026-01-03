<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAlertRequest;
use App\Http\Requests\UpdateAlertRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AlertRepository;
use Illuminate\Http\Request;
use Flash;

class AlertController extends AppBaseController
{
    /** @var AlertRepository $alertRepository*/
    private $alertRepository;

    public function __construct(AlertRepository $alertRepo)
    {
        $this->alertRepository = $alertRepo;
    }

    /**
     * Display a listing of the Alert.
     */
    public function index(Request $request)
    {
        $alerts = $this->alertRepository->paginate(10);

        return view('alerts.index')
            ->with('alerts', $alerts);
    }

    /**
     * Show the form for creating a new Alert.
     */
    public function create()
    {
        return view('alerts.create');
    }

    /**
     * Store a newly created Alert in storage.
     */
    public function store(CreateAlertRequest $request)
    {
        $input = $request->all();

        $alert = $this->alertRepository->create($input);

        Flash::success('Alert saved successfully.');

        return redirect(route('alerts.index'));
    }

    /**
     * Display the specified Alert.
     */
    public function show($id)
    {
        $alert = $this->alertRepository->find($id);

        if (empty($alert)) {
            Flash::error('Alert not found');

            return redirect(route('alerts.index'));
        }

        return view('alerts.show')->with('alert', $alert);
    }

    /**
     * Show the form for editing the specified Alert.
     */
    public function edit($id)
    {
        $alert = $this->alertRepository->find($id);

        if (empty($alert)) {
            Flash::error('Alert not found');

            return redirect(route('alerts.index'));
        }

        return view('alerts.edit')->with('alert', $alert);
    }

    /**
     * Update the specified Alert in storage.
     */
    public function update($id, UpdateAlertRequest $request)
    {
        $alert = $this->alertRepository->find($id);

        if (empty($alert)) {
            Flash::error('Alert not found');

            return redirect(route('alerts.index'));
        }

        $alert = $this->alertRepository->update($request->all(), $id);

        Flash::success('Alert updated successfully.');

        return redirect(route('alerts.index'));
    }

    /**
     * Remove the specified Alert from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $alert = $this->alertRepository->find($id);

        if (empty($alert)) {
            Flash::error('Alert not found');

            return redirect(route('alerts.index'));
        }

        $this->alertRepository->delete($id);

        Flash::success('Alert deleted successfully.');

        return redirect(route('alerts.index'));
    }
}
