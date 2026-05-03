<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectMessageRequest;
use App\Http\Requests\UpdateProjectMessageRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectMessageRepository;
use Illuminate\Http\Request;
use Flash;

class ProjectMessageController extends AppBaseController
{
    /** @var ProjectMessageRepository $projectMessageRepository*/
    private $projectMessageRepository;

    public function __construct(ProjectMessageRepository $projectMessageRepo)
    {
        $this->projectMessageRepository = $projectMessageRepo;
    }

    /**
     * Display a listing of the ProjectMessage.
     */
    public function index($projectId)
    {
        $project = \App\Models\Project::findOrFail($projectId);

        $messages =  \App\Models\ProjectMessage::with(['sender','receiver','cc','type'])
            ->where('project_id', $projectId)
            ->latest()
            ->get();

        return view('messages.index', compact('project','messages'));
    }

    /**
     * Show the form for creating a new ProjectMessage.
     */
    public function create()
    {
        return view('project_messages.create');
    }

    /**
     * Store a newly created ProjectMessage in storage.
     */
    public function store(CreateProjectMessageRequest $request)
    {
        $input = $request->all();

        $projectMessage = $this->projectMessageRepository->create($input);

        Flash::success('Project Message saved successfully.');

        return redirect(route('projectMessages.index'));
    }

    /**
     * Display the specified ProjectMessage.
     */
    public function show($id)
    {
        $projectMessage = $this->projectMessageRepository->find($id);

        if (empty($projectMessage)) {
            Flash::error('Project Message not found');

            return redirect(route('projectMessages.index'));
        }

        return view('project_messages.show')->with('projectMessage', $projectMessage);
    }

    /**
     * Show the form for editing the specified ProjectMessage.
     */
    public function edit($id)
    {
        $projectMessage = $this->projectMessageRepository->find($id);

        if (empty($projectMessage)) {
            Flash::error('Project Message not found');

            return redirect(route('projectMessages.index'));
        }

        return view('project_messages.edit')->with('projectMessage', $projectMessage);
    }

    /**
     * Update the specified ProjectMessage in storage.
     */
    public function update($id, UpdateProjectMessageRequest $request)
    {
        $projectMessage = $this->projectMessageRepository->find($id);

        if (empty($projectMessage)) {
            Flash::error('Project Message not found');

            return redirect(route('projectMessages.index'));
        }

        $projectMessage = $this->projectMessageRepository->update($request->all(), $id);

        Flash::success('Project Message updated successfully.');

        return redirect(route('projectMessages.index'));
    }

    /**
     * Remove the specified ProjectMessage from storage.
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $projectMessage = $this->projectMessageRepository->find($id);

        if (empty($projectMessage)) {
            Flash::error('Project Message not found');

            return redirect(route('projectMessages.index'));
        }

        $this->projectMessageRepository->delete($id);

        Flash::success('Project Message deleted successfully.');

        return redirect(route('projectMessages.index'));
    }
}
