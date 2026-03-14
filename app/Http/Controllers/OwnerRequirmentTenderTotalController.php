<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOwnerRequirmentTenderTotalRequest;
use App\Http\Requests\UpdateOwnerRequirmentTenderTotalRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\OwnerRequirmentTenderTotalRepository;
use Illuminate\Http\Request;
use Flash;

class OwnerRequirmentTenderTotalController extends AppBaseController
{
    /** @var OwnerRequirmentTenderTotalRepository $ownerRequirmentTenderTotalRepository*/
    private $ownerRequirmentTenderTotalRepository;

    public function __construct(OwnerRequirmentTenderTotalRepository $ownerRequirmentTenderTotalRepo)
    {
        $this->ownerRequirmentTenderTotalRepository = $ownerRequirmentTenderTotalRepo;
    }

    /**
     * Display a listing of the OwnerRequirmentTenderTotal.
     */
    public function index(Request $request)
    {
        $ownerRequirmentTenderTotals = $this->ownerRequirmentTenderTotalRepository->paginate(10);

        return view('owner_requirment_tender_totals.index')
            ->with('ownerRequirmentTenderTotals', $ownerRequirmentTenderTotals);
    }

    /**
     * Show the form for creating a new OwnerRequirmentTenderTotal.
     */
    public function create()
    {
        return view('owner_requirment_tender_totals.create');
    }

    /**
     * Store a newly created OwnerRequirmentTenderTotal in storage.
     */
    public function store(CreateOwnerRequirmentTenderTotalRequest $request)
    {
        $input = $request->all();

        $ownerRequirmentTenderTotal = $this->ownerRequirmentTenderTotalRepository->create($input);

        Flash::success('Owner Requirment Tender Total saved successfully.');

        return redirect(route('ownerRequirmentTenderTotals.index'));
    }

    /**
     * Display the specified OwnerRequirmentTenderTotal.
     */
    public function show($id)
    {
        $ownerRequirmentTenderTotal = $this->ownerRequirmentTenderTotalRepository->find($id);

        if (empty($ownerRequirmentTenderTotal)) {
            Flash::error('Owner Requirment Tender Total not found');

            return redirect(route('ownerRequirmentTenderTotals.index'));
        }

        return view('owner_requirment_tender_totals.show')->with('ownerRequirmentTenderTotal', $ownerRequirmentTenderTotal);
    }

    /**
     * Show the form for editing the specified OwnerRequirmentTenderTotal.
     */
    public function edit($id)
    {
        $ownerRequirmentTenderTotal = $this->ownerRequirmentTenderTotalRepository->find($id);

        if (empty($ownerRequirmentTenderTotal)) {
            Flash::error('Owner Requirment Tender Total not found');

            return redirect(route('ownerRequirmentTenderTotals.index'));
        }

        return view('owner_requirment_tender_totals.edit')->with('ownerRequirmentTenderTotal', $ownerRequirmentTenderTotal);
    }

    /**
     * Update the specified OwnerRequirmentTenderTotal in storage.
     */
    public function update($id, UpdateOwnerRequirmentTenderTotalRequest $request)
    {
        $ownerRequirmentTenderTotal = $this->ownerRequirmentTenderTotalRepository->find($id);

        if (empty($ownerRequirmentTenderTotal)) {
            Flash::error('Owner Requirment Tender Total not found');

            return redirect(route('ownerRequirmentTenderTotals.index'));
        }

        $ownerRequirmentTenderTotal = $this->ownerRequirmentTenderTotalRepository->update($request->all(), $id);

        Flash::success('Owner Requirment Tender Total updated successfully.');

        return redirect(route('ownerRequirmentTenderTotals.index'));
    }

    /**
     * Remove the specified OwnerRequirmentTenderTotal from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $ownerRequirmentTenderTotal = $this->ownerRequirmentTenderTotalRepository->find($id);

        if (empty($ownerRequirmentTenderTotal)) {
            Flash::error('Owner Requirment Tender Total not found');

            return redirect(route('ownerRequirmentTenderTotals.index'));
        }

        $this->ownerRequirmentTenderTotalRepository->delete($id);

        Flash::success('Owner Requirment Tender Total deleted successfully.');

        return redirect(route('ownerRequirmentTenderTotals.index'));
    }
}
