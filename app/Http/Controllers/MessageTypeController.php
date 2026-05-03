<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMessageTypeRequest;
use App\Http\Requests\UpdateMessageTypeRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\MessageTypeRepository;
use Illuminate\Http\Request;
use Flash;

class MessageTypeController extends AppBaseController
{
    /** @var MessageTypeRepository $messageTypeRepository*/
    private $messageTypeRepository;

    public function __construct(MessageTypeRepository $messageTypeRepo)
    {
        $this->messageTypeRepository = $messageTypeRepo;
    }

    /**
     * Display a listing of the MessageType.
     */
    public function index(Request $request)
    {
        $messageTypes = $this->messageTypeRepository->paginate(10);

        return view('message_types.index')
            ->with('messageTypes', $messageTypes);
    }

    /**
     * Show the form for creating a new MessageType.
     */
    public function create()
    {
        return view('message_types.create');
    }

    /**
     * Store a newly created MessageType in storage.
     */
    public function store(CreateMessageTypeRequest $request)
    {
        $input = $request->all();

        $messageType = $this->messageTypeRepository->create($input);

        Flash::success('Message Type saved successfully.');

        return redirect(route('messageTypes.index'));
    }

    /**
     * Display the specified MessageType.
     */
    public function show($id)
    {
        $messageType = $this->messageTypeRepository->find($id);

        if (empty($messageType)) {
            Flash::error('Message Type not found');

            return redirect(route('messageTypes.index'));
        }

        return view('message_types.show')->with('messageType', $messageType);
    }

    /**
     * Show the form for editing the specified MessageType.
     */
    public function edit($id)
    {
        $messageType = $this->messageTypeRepository->find($id);

        if (empty($messageType)) {
            Flash::error('Message Type not found');

            return redirect(route('messageTypes.index'));
        }

        return view('message_types.edit')->with('messageType', $messageType);
    }

    /**
     * Update the specified MessageType in storage.
     */
    public function update($id, UpdateMessageTypeRequest $request)
    {
        $messageType = $this->messageTypeRepository->find($id);

        if (empty($messageType)) {
            Flash::error('Message Type not found');

            return redirect(route('messageTypes.index'));
        }

        $messageType = $this->messageTypeRepository->update($request->all(), $id);

        Flash::success('Message Type updated successfully.');

        return redirect(route('messageTypes.index'));
    }

    /**
     * Remove the specified MessageType from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $messageType = $this->messageTypeRepository->find($id);

        if (empty($messageType)) {
            Flash::error('Message Type not found');

            return redirect(route('messageTypes.index'));
        }

        $this->messageTypeRepository->delete($id);

        Flash::success('Message Type deleted successfully.');

        return redirect(route('messageTypes.index'));
    }
}
