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

        return view('project_messages.index', compact('project','messages'));
    }

    /**
     * Show the form for creating a new ProjectMessage.
     */
    public function create($projectId)
{
    $project = \App\Models\Project::findOrFail($projectId);

    $users = \App\Models\User::pluck('name', 'id');

    $types = \App\Models\MessageType::pluck('name_ar', 'id'); // زي baladya_status_types

    return view('project_messages.create', compact('project','users','types'));
}

    /**
     * Store a newly created ProjectMessage in storage.
     */
    public function store(Request $request, $projectId)
{
    // ✅ صلاحيات
    if (!in_array(auth()->user()->role_id, [1,4,11,12])) {
        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'ليس لديك الصلاحيات الكافية'
        ]);
    }

    // ✅ validation
    $request->validate([
        'type_id'     => 'required|exists:message_types,id',
        'receiver_id' => 'required|exists:users,id',
        'cc_id'       => 'nullable|exists:users,id',
        'subject'     => 'nullable|string|max:255',
        'message'     => 'required|string',
        'attachment'  => 'nullable|file|max:10240', // 10MB
    ]);

    // ✅ تجهيز البيانات
    $data = $request->all();

    $data['project_id'] = $projectId;
    $data['sender_id']  = auth()->id();

    // ✅ رفع ملف واحد
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $name = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $name);
        $data['attachment'] = $name;
    }

    // ✅ حفظ
    \App\Models\ProjectMessage::create($data);

    // ✅ رجوع
    return redirect()->route('projects.messages.index', $projectId)
        ->with([
            'toast' => [
                'type' => 'success',
                'message' => 'تم إرسال الرسالة بنجاح'
            ]
        ]);
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
