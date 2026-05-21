<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProjectMessageRequest;
use App\Http\Requests\UpdateProjectMessageRequest;
use App\Http\Controllers\AppBaseController;
use App\Repositories\ProjectMessageRepository;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\Mail;
use Mpdf\Mpdf;

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

        /*$messages =  \App\Models\ProjectMessage::with(['sender','receiver','ccUser','messageType'])
            ->where('project_id', $projectId)
            ->orderBy('created_at')
            ->get();*/


            /*$messages = \App\Models\ProjectMessage::with([
        'sender','receiver','ccUser','messageType','replies.sender'
            ])
            ->where('project_id', $projectId)
            ->whereNull('parent_id') // ✅ الرسائل الأساسية فقط
            ->orderBy('created_at')
            ->get();*/


        $user = auth()->user();

        $query = \App\Models\ProjectMessage::with([
            'sender',
            'receiver',
            'ccUser',
            'messageType',
            'replies.sender'
        ])
        ->where('project_id', $projectId)
        ->whereNull('parent_id');

        // ================= صلاحيات الاستشاري =================

        // لو المستخدم مش استشاري
        if ($user->id != $project->consultant_id) {

            $query->where(function ($q) use ($user) {

                $q->where('sender_id', $user->id)

                ->orWhere('receiver_id', $user->id)

                ->orWhere('cc_user_id', $user->id);
            });
        }

        $messages = $query
            ->orderBy('created_at')
            ->get();
        //dd($messages);
        return view('project_messages.index', compact('project','messages'));
    }

    /**
     * Show the form for creating a new ProjectMessage.
     */
/*public function create($projectId, Request $request)
{
    $project = \App\Models\Project::findOrFail($projectId);

    //$users = \App\Models\User::pluck('name', 'id');
    $users = \App\Models\User::whereIn('id', [
    $project->owner_id,
    $project->contractor_id,
    $project->consultant_id
])->pluck('name', 'id');
    
    $types = \App\Models\MessageType::pluck('name_ar', 'id');

    $replyTo = null;

    if ($request->reply_to) {
        $replyTo = \App\Models\ProjectMessage::find($request->reply_to);
    }

    return view('project_messages.create', compact(
        'project','users','types','replyTo'
    ));
}*/





public function create($projectId, Request $request)
{
    $project = \App\Models\Project::findOrFail($projectId);

    $users = \App\Models\User::whereIn('id', [
        $project->owner_id,
        $project->contractor_id,
        $project->consultant_id
    ])->pluck('name', 'id');
    
    $types = \App\Models\MessageType::pluck('name_ar', 'id');

    $replyTo = null;

    if ($request->reply_to) {

        $replyTo = \App\Models\ProjectMessage::find($request->reply_to);

        // ================= تعليم الرسالة كمقروءة =================

        if ($replyTo) {

            // لازم يكون هو المرسل إليه أو الـ CC
            if (
                $replyTo->receiver_id == auth()->id()
                ||
                $replyTo->cc_user_id == auth()->id()
            ) {

                $replyTo->update([
                    'readed' => 1,
                    'read_at' => now(),
                ]);
            }
        }
    }

    return view('project_messages.create', compact(
        'project','users','types','replyTo'
    ));
}



    /**
     * Store a newly created ProjectMessage in storage.
     */
    /*public function store(Request $request, $projectId)
{
    // ✅ صلاحيات
    /*if (!in_array(auth()->user()->role_id, [1,4,11,12,7])) {
        return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'ليس لديك الصلاحيات الكافية'
        ]);
    }*/

    // ✅ validation
 /*   $request->validate([
        'message_type_id'     => 'required|exists:message_types,id',
        'receiver_id' => 'required|exists:users,id',
        'cc_id'       => 'nullable|exists:users,id',
        'subject'     => 'nullable|string|max:255',
        'message'     => 'required|string',
        'attachment'  => 'nullable|file|max:10240', // 10MB
        'parent_id' => 'nullable|exists:project_messages,id',
    ]);

    // ✅ تجهيز البيانات
    $data = $request->all();

    //dd($request);

    $data['project_id'] = $projectId;
    $data['sender_id']  = auth()->id();
    $data['parent_id'] = $request->parent_id;

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
}*/









/*public function store(Request $request, $projectId)
{
    $project = \App\Models\Project::findOrFail($projectId);

    $user = auth()->user();

    // IDs
    $consultantId = $project->consultant_id;
    $contractorId = $project->contractor_id;
    $ownerId      = $project->owner_id;

    // Validation
    $request->validate([
        'message' => 'required|string',
        'attachment' => 'nullable|file|max:10240',
    ]);

    $data = $request->all();

    $data['project_id'] = $projectId;
    $data['sender_id']  = $user->id;

    // 🧠 LOGIC
    if ($user->id == $consultantId) {

        // الاستشاري
        if (!in_array($request->receiver_id, [$ownerId, $contractorId])) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'يمكنك الإرسال فقط للمالك أو المقاول'
            ]);
        }

    } elseif ($user->id == $contractorId) {

        // المقاول
        $data['receiver_id'] = $consultantId;

        // المالك اختياري CC
        if ($request->cc_user_id && $request->cc_user_id != $ownerId) {
            return back()->with('toast', [
                'type' => 'error',
                'message' => 'يمكنك إضافة المالك فقط في CC'
            ]);
        }

    } elseif ($user->id == $ownerId) {

        // المالك
        $data['receiver_id'] = $contractorId;

        // الاستشاري لازم يكون CC
        $data['cc_user_id'] = $consultantId;

    }

    // reply logic
    if ($request->parent_id) {
        $data['parent_id'] = $request->parent_id;
    }

    // upload
    if ($request->hasFile('attachment')) {
        $file = $request->file('attachment');
        $name = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('Files'), $name);
        $data['attachment'] = $name;
    }

    \App\Models\ProjectMessage::create($data);

    return redirect()->route('projects.messages.index', $projectId)
        ->with([
            'toast' => [
                'type' => 'success',
                'message' => 'تم إرسال الرسالة بنجاح'
            ]
        ]);
}*/







public function store(Request $request, $projectId)
{
    $project = \App\Models\Project::findOrFail($projectId);

    $user = auth()->user();

    // IDs
    $consultantId = $project->consultant_id;
    $contractorId = $project->contractor_id;
    $ownerId      = $project->owner_id;

    // Validation
    $request->validate([
        'message' => 'required|string',
        'attachment' => 'nullable|file|max:10240',
    ]);

    $data = $request->all();

    $data['project_id'] = $projectId;
    $data['sender_id']  = $user->id;

    // ================= LOGIC =================

    /*if ($user->id == $consultantId) {

        // الاستشاري
        if (!in_array($request->receiver_id, [$ownerId, $contractorId])) {

            return back()->with('toast', [
                'type' => 'error',
                'message' => 'يمكنك الإرسال فقط للمالك أو المقاول'
            ]);
        }

    } elseif ($user->id == $contractorId) {

        // المقاول
        $data['receiver_id'] = $consultantId;

        // المالك اختياري CC
        if ($request->cc_user_id && $request->cc_user_id != $ownerId) {

            return back()->with('toast', [
                'type' => 'error',
                'message' => 'يمكنك إضافة المالك فقط في CC'
            ]);
        }

    } elseif ($user->id == $ownerId) {

        // المالك
        $data['receiver_id'] = $contractorId;

        // الاستشاري لازم يكون CC
        $data['cc_user_id'] = $consultantId;
    }*/













        // ================= REPLY LOGIC =================

if ($request->parent_id) {

    $parentMessage = \App\Models\ProjectMessage::find($request->parent_id);

    if ($parentMessage) {

        // الرد يروح لصاحب الرسالة الأصلية
        $data['receiver_id'] = $parentMessage->sender_id;

        // نفس نوع الرسالة
        $data['message_type_id'] = $parentMessage->message_type_id;

        // parent
        $data['parent_id'] = $parentMessage->id;

        // لو فيه CC في الرسالة الأصلية
        $data['cc_user_id'] = $parentMessage->cc_user_id;
    }

} else {

    // ================= NEW MESSAGE LOGIC =================

    if ($user->id == $consultantId) {

        if (!in_array($request->receiver_id, [$ownerId, $contractorId])) {

            return back()->with('toast', [
                'type' => 'error',
                'message' => 'يمكنك الإرسال فقط للمالك أو المقاول'
            ]);
        }

    } elseif ($user->id == $contractorId) {

        $data['receiver_id'] = $consultantId;

        if ($request->cc_user_id && $request->cc_user_id != $ownerId) {

            return back()->with('toast', [
                'type' => 'error',
                'message' => 'يمكنك إضافة المالك فقط في CC'
            ]);
        }

    } elseif ($user->id == $ownerId) {

        $data['receiver_id'] = $contractorId;

        $data['cc_user_id'] = $consultantId;
    }
}

    // ================= REPLY =================

    //if ($request->parent_id) {
    //    $data['parent_id'] = $request->parent_id;
    //}

    // ================= UPLOAD =================

    if ($request->hasFile('attachment')) {

        $file = $request->file('attachment');

        $name = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('Files'), $name);

        $data['attachment'] = $name;
    }

    // ================= SAVE MESSAGE =================

    $message = \App\Models\ProjectMessage::create($data);



    // ================= تحميل العلاقات =================

$message->load([
    'sender',
    'receiver',
    'ccUser',
    'messageType'
]);

// ================= تجهيز بيانات الرسالة =================

$messageId = $message->id;

$projectCode = $project->project_code ?? '-';

$messageType = $message->messageType->name_ar ?? 'رسالة مشروع';



$projectName = $project->projectName->name_ar ?? '-';

$ownerName = $project->ownerUser->name ?? '-';

$contractorName = $project->contractorUser->name ?? '-';

$qasmiaNumber = $project->qasmia_number ?? '-';

$licenseNumber =
    optional(
        $project->baladyaApprovals->sortByDesc('id')->first()
    )->building_license_number ?? '-';

$messageText = nl2br(e($message->message));

$replyText = '';

if ($message->parent_id) {

    $replyText = '
        <p style="color:#b8860b;font-weight:bold;">
            رد على الرسالة رقم:
            #'.$message->parent_id.'
        </p>
    ';
}


    if ($message->parent_id) {

    $parentMessage = \App\Models\ProjectMessage::find($message->parent_id);

    if ($parentMessage) {

        // لو بيرد على رسالة
        // ابعت notification لصاحب الرسالة الأصلية

        $parentMessage->update([
            'readed' => 0,
            'read_at' => null,
        ]);
    }
}

    // ================= العلاقات =================

    $message->load([
        'sender',
        'receiver',
        'ccUser',
        'messageType'
    ]);

    // ================= إنشاء PDF =================

    $html = view('pdf.contract_message', [
        'project' => $project,
        'message' => $message,
    ])->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_footer' => 5,
        'margin_top' => 35
    ]);

    $mpdf->SetHTMLHeader('
        <div style="text-align:center;">
            <img src="'.public_path('images/tender_logo.jpeg').'"
                 style="height:90px;width:70%;">
        </div>
    ');

    $mpdf->WriteHTML($html);

    // حفظ الـ PDF مؤقت
    $pdfContent = $mpdf->Output('', 'S');

    $pdfFileName = 'message_'.$message->id.'.pdf';

    // ================= EMAIL =================

    try {

        $receiverEmail = $message->receiver->email ?? null;

        $ccEmail = $message->ccUser->email ?? null;

        if ($receiverEmail) {

            Mail::send([], [], function ($mail) use (
    $receiverEmail,
    $ccEmail,
    $pdfContent,
    $pdfFileName,
    $message,
    $project,
    $user,
    $messageId,
    $projectCode,
    $messageType,
    $messageText,
    $replyText
) {

                // المرسل إليه الأساسي
$mail->to($receiverEmail);

// CC الحالي
if ($ccEmail) {
    $mail->cc($ccEmail);
}

// إضافة المرسل في CC
if ($user->email) {

    if ($ccEmail && $ccEmail != $user->email) {

        $mail->cc($user->email);

    } elseif (!$ccEmail) {

        $mail->cc($user->email);
    }
}

// FROM باسم المرسل
if ($user->email) {

    $mail->from(
        $user->email,
        $user->name
    );

}

                // SUBJECT = نوع الرسالة
                $mail->subject(
                    $message->messageType->name_ar
                    ?? 'رسالة مشروع'
                );

                $mail->html('

<div dir="rtl"
     style="
        font-family:Tahoma;
        background:#f8f8f8;
        padding:25px;
     ">

    <div style="
        background:#ffffff;
        border-radius:10px;
        padding:25px;
        border:1px solid #ddd;
    ">

        

        <h2 style="
            text-align:center;
            color:#b8860b;
            margin-bottom:25px;
        ">
            '.$messageType.'
        </h2>

        <table style="
            width:100%;
            border-collapse:collapse;
            margin-bottom:20px;
        ">

            <tr>
                <td style="
                    padding:10px;
                    border:1px solid #ddd;
                    background:#faf3dd;
                    font-weight:bold;
                    width:30%;
                ">
                    رقم الرسالة
                </td>

                <td style="
                    padding:10px;
                    border:1px solid #ddd;
                ">
                    #'.$messageId.'
                </td>
            </tr>

            <tr>
                <td style="
                    padding:10px;
                    border:1px solid #ddd;
                    background:#faf3dd;
                    font-weight:bold;
                ">
                    كود المشروع
                </td>

                <td style="
                    padding:10px;
                    border:1px solid #ddd;
                ">
                    '.$projectCode.'
                </td>
            </tr>

            <tr>
                <td style="
                    padding:10px;
                    border:1px solid #ddd;
                    background:#faf3dd;
                    font-weight:bold;
                ">
                    المرسل
                </td>

                <td style="
                    padding:10px;
                    border:1px solid #ddd;
                ">
                    '.$message->sender->name.'
                </td>
            </tr>

            <tr>
                <td style="
                    padding:10px;
                    border:1px solid #ddd;
                    background:#faf3dd;
                    font-weight:bold;
                ">
                    نوع الرسالة
                </td>

                <td style="
                    padding:10px;
                    border:1px solid #ddd;
                ">
                    '.$messageType.'
                </td>
            </tr>














            <tr>
    <td style="
        padding:10px;
        border:1px solid #ddd;
        background:#faf3dd;
        font-weight:bold;
    ">
        اسم المشروع
    </td>

    <td style="
        padding:10px;
        border:1px solid #ddd;
    ">
        '.$projectName.'
    </td>
</tr>

<tr>
    <td style="
        padding:10px;
        border:1px solid #ddd;
        background:#faf3dd;
        font-weight:bold;
    ">
        اسم المالك
    </td>

    <td style="
        padding:10px;
        border:1px solid #ddd;
    ">
        '.$ownerName.'
    </td>
</tr>

<tr>
    <td style="
        padding:10px;
        border:1px solid #ddd;
        background:#faf3dd;
        font-weight:bold;
    ">
        اسم المقاول
    </td>

    <td style="
        padding:10px;
        border:1px solid #ddd;
    ">
        '.$contractorName.'
    </td>
</tr>

<tr>
    <td style="
        padding:10px;
        border:1px solid #ddd;
        background:#faf3dd;
        font-weight:bold;
    ">
        رقم القسيمة
    </td>

    <td style="
        padding:10px;
        border:1px solid #ddd;
    ">
        '.$qasmiaNumber.'
    </td>
</tr>

<tr>
    <td style="
        padding:10px;
        border:1px solid #ddd;
        background:#faf3dd;
        font-weight:bold;
    ">
        رقم الرخصة
    </td>

    <td style="
        padding:10px;
        border:1px solid #ddd;
    ">
        '.$licenseNumber.'
    </td>
</tr>

        </table>

        '.$replyText.'

        <div style="
            background:#fcfcfc;
            border:1px solid #ddd;
            border-radius:8px;
            padding:20px;
            line-height:2;
            margin-top:20px;
        ">

            <div style="
                margin-bottom:10px;
                font-weight:bold;
                color:#b8860b;
            ">
                نص الرسالة:
            </div>

            '.$messageText.'

        </div>

        <div style="
            text-align:center;
            margin-top:35px;
            color:#777;
            font-size:13px;
            line-height:2;
        ">

            سافانا ديزاين للإستشارات الهندسية<br>

            أبراج جلفار – الطابق الرابع – مكتب 407<br>

            هاتف: 2273478/07 – متحرك: 0525015080

        </div>

        

    </div>

</div>

');

                // Attach PDF
                $mail->attachData(
                    $pdfContent,
                    $pdfFileName,
                    [
                        'mime' => 'application/pdf',
                    ]
                );
            });
        }

    } catch (\Exception $e) {

        \Log::error('MAIL ERROR => '.$e->getMessage());
    }

    // ================= REDIRECT =================

    return redirect()
        ->route('projects.messages.index', $projectId)
        ->with([
            'toast' => [
                'type' => 'success',
                'message' => 'تم إرسال الرسالة بنجاح'
            ]
        ]);
}


public function previewPdf(Request $request, $id)
{
    $project = \App\Models\Project::findOrFail($id);

    // رسالة مؤقتة للمعاينة فقط
    $message = new \App\Models\ProjectMessage();

    $message->message = $request->message;

    $message->message_type_id = $request->message_type_id;

    $message->sender_id = auth()->id();

    $message->receiver_id = $request->receiver_id;

    $message->cc_user_id = $request->cc_user_id;

    $message->parent_id = $request->parent_id;

    $message->created_at = now();

    // تحميل العلاقات مؤقتاً
    $message->setRelation(
        'sender',
        \App\Models\User::find(auth()->id())
    );

    $message->setRelation(
        'receiver',
        \App\Models\User::find($request->receiver_id)
    );

    $message->setRelation(
        'ccUser',
        $request->cc_user_id
            ? \App\Models\User::find($request->cc_user_id)
            : null
    );

    $message->setRelation(
        'messageType',
        \App\Models\MessageType::find($request->message_type_id)
    );

    // رفع الملف مؤقت للمعاينة
    if ($request->hasFile('attachment')) {

        $file = $request->file('attachment');

        $tempName = 'preview_' . time() . '_' . $file->getClientOriginalName();

        $file->move(public_path('Files/temp'), $tempName);

        $message->attachment = 'temp/' . $tempName;
    }

    $html = view('pdf.contract_message', [
        'project' => $project,
        'message' => $message,
    ])->render();

    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => 'A4',
        'default_font' => 'amiri',
        'autoScriptToLang' => true,
        'autoLangToFont' => true,
        'margin_footer' => 5,
        'margin_top' => 35
    ]);

    $mpdf->SetHTMLHeader('
        <div style="text-align:center;">
            <img src="'.public_path('images/tender_logo.jpeg').'"
                 style="height:90px;width:60%;">
        </div>
    ');

    $mpdf->WriteHTML($html);

    return response(
        $mpdf->Output('', 'S'),
        200,
        [
            'Content-Type' => 'application/pdf'
        ]
    );
}
// <div style="text-align:center;margin-bottom:20px;">

//             <div style="text-align:center;">
//                 <img src="'.public_path('images/tender_logo.jpeg').'" style="height:90px;width:60%;">
//             </div>

//         </div>













    /**
     * Display the specified ProjectMessage.
     */
    /*public function show($id)
    {
        $projectMessage = $this->projectMessageRepository->find($id);

        if (empty($projectMessage)) {
            Flash::error('Project Message not found');

            return redirect(route('projectMessages.index'));
        }

        return view('project_messages.show')->with('projectMessage', $projectMessage);
    }*/


        public function show($projectId, $messageId)
{
    $message = \App\Models\ProjectMessage::findOrFail($messageId);

    // لو هو المستلم أو CC
    if (

        auth()->id() == $message->receiver_id
        ||
        auth()->id() == $message->cc_user_id

    ) {

        $message->update([
            'readed' => 1,
            'read_at' => now(),
        ]);
    }

    return redirect()
        ->route('projects.messages.index', $projectId);
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
    $msg = \App\Models\ProjectMessage::findOrFail($id);

    if ($msg->sender_id != auth()->id()) {
        return back()->with('toast', [
            'type' => 'error',
            'message' => 'غير مسموح لك حذف هذه الرسالة'
        ]);
    }

    $msg->delete();

    return back()->with('toast', [
        'type' => 'success',
        'message' => 'تم الحذف'
    ]);
}
}
