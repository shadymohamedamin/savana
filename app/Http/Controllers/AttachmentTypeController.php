<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAttachmentTypeRequest;
use App\Http\Requests\UpdateAttachmentTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\AttachmentTypeRepository;
use Illuminate\Http\Request;
use Flash;

class AttachmentTypeController extends AppBaseController
{
    /** @var AttachmentTypeRepository $attachmentTypeRepository*/
    private $attachmentTypeRepository;

    public function __construct(AttachmentTypeRepository $attachmentTypeRepo)
    {
        $this->attachmentTypeRepository = $attachmentTypeRepo;
    }

    /**
     * Display a listing of the AttachmentType.
     */
    public function index(Request $request)
    {
        $attachmentTypes = $this->attachmentTypeRepository->paginate(10);

        return view('attachment_types.index')
            ->with('attachmentTypes', $attachmentTypes);
    }

    /**
     * Show the form for creating a new AttachmentType.
     */
    public function create()
    {
        return view('attachment_types.create');
    }

    /**
     * Store a newly created AttachmentType in storage.
     */
    public function store(CreateAttachmentTypeRequest $request)
    {
        $input = $request->all();

        $attachmentType = $this->attachmentTypeRepository->create($input);

        Flash::success('Attachment Type saved successfully.');

        return redirect(route('attachmentTypes.index'));
    }

    /**
     * Display the specified AttachmentType.
     */
    public function show($id)
    {
        $attachmentType = $this->attachmentTypeRepository->find($id);

        if (empty($attachmentType)) {
            Flash::error('Attachment Type not found');

            return redirect(route('attachmentTypes.index'));
        }

        return view('attachment_types.show')->with('attachmentType', $attachmentType);
    }

    /**
     * Show the form for editing the specified AttachmentType.
     */
    public function edit($id)
    {
        $attachmentType = $this->attachmentTypeRepository->find($id);

        if (empty($attachmentType)) {
            Flash::error('Attachment Type not found');

            return redirect(route('attachmentTypes.index'));
        }

        return view('attachment_types.edit')->with('attachmentType', $attachmentType);
    }

    /**
     * Update the specified AttachmentType in storage.
     */
    public function update($id, UpdateAttachmentTypeRequest $request)
    {
        $attachmentType = $this->attachmentTypeRepository->find($id);

        if (empty($attachmentType)) {
            Flash::error('Attachment Type not found');

            return redirect(route('attachmentTypes.index'));
        }

        $attachmentType = $this->attachmentTypeRepository->update($request->all(), $id);

        Flash::success('Attachment Type updated successfully.');

        return redirect(route('attachmentTypes.index'));
    }

    /**
     * Remove the specified AttachmentType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $attachmentType = $this->attachmentTypeRepository->find($id);

        if (empty($attachmentType)) {
            Flash::error('Attachment Type not found');

            return redirect(route('attachmentTypes.index'));
        }

        $this->attachmentTypeRepository->delete($id);

        Flash::success('Attachment Type deleted successfully.');

        return redirect(route('attachmentTypes.index'));
    }
}
