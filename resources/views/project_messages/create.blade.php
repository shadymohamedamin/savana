@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid d-flex justify-content-center">
        <h3>إنشاء رسالة جديدة</h3>
    </div>
</section>

@php
$user = auth()->user();
@endphp


<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4" style="background-color:#f5f5dc;">







{!! Form::open([
    'route' => ['projects.messages.store', $project->id],
    'files' => true,
    'id' => 'messageForm'
]) !!}





        @if(isset($replyTo))
<div class="card mb-3 border-left border-primary p-3" style="background:#eef2ff">

    <h5 class="mb-2">📩 الرد على رسالة</h5>

    <p><strong>الموضوع:</strong> {{ $replyTo->messageType->name_ar ?? '-' }}</p>

    <p><strong>رقم الرسالة:</strong> {{ $replyTo->id ?? '-' }}</p>

    <p><strong>الرسالة:</strong><br>
        {{ $replyTo->message }}
    </p>


    <p><strong>من:</strong> {{ $replyTo->sender->name ?? '-' }}</p>

    <p><strong>إلى:</strong> {{ $replyTo->receiver->name ?? '-' }}</p>

    <p><strong>CC:</strong> {{ $replyTo->ccUser->name ?? '-' }}</p>

    @if($replyTo->attachment)
        <a href="{{ asset('Files/'.$replyTo->attachment) }}" target="_blank">
            📎 فتح المرفق
        </a>
    @endif

</div>
@endif
            @if(isset($replyTo))
            <!-- <div class="alert alert-info">
                <strong>رد على رسالة:</strong>
                <br>
                {{ \Illuminate\Support\Str::limit($replyTo->message, 100) }}
            </div> -->

                <!-- <input type="hidden" name="parent_id" value="{{ $replyTo->id }}">
                {{-- نوع الرسالة الأصلي --}}
                <input type="hidden" name="message_type_id" value="{{ $replyTo->message_type_id }}"> -->

                {{-- المرسل إليه الأصلي --}}
                <!-- <input type="hidden" name="receiver_id" value="{{ $replyTo->sender_id }}"> -->

                @if(isset($replyTo))

                    <input type="hidden" name="parent_id" value="{{ $replyTo->id }}">

                    <input type="hidden"
                        name="message_type_id"
                        value="{{ $replyTo->message_type_id }}">

                @endif
            @endif





        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input type="hidden" name="sender_id" value="{{ auth()->id() }}">

        <div class="card-body d-flex flex-wrap gap-3">
            @if(!isset($replyTo))
            {{-- نوع الرسالة --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('message_type_id', 'نوع الرسالة') !!}
                {!! Form::select('message_type_id', $types, null, [
                    'class' => 'form-control',
                    'placeholder' => '-- اختر --',
                    'required',
                    'id' => 'message_type_id',
                ]) !!}
            </div>




            {{-- المرسل إليه --}}
            <!-- <div style="min-width:250px;max-width:250px;">
                {!! Form::label('receiver_id', 'إلى') !!}
                {!! Form::select('receiver_id', $users, null, [
                    'class' => 'form-control',
                    'placeholder' => '-- اختر --',
                    'required'
                ]) !!}
            </div>
            @endif -->



@if($user->id == $project->consultant_id)
<div style="min-width:250px;max-width:250px;">
    {!! Form::label('receiver_id','إلى') !!}
    {!! Form::select('receiver_id', [
        $project->owner_id => 'المالك',
        $project->contractor_id => 'المقاول'
    ], null, ['class'=>'form-control','required']) !!}
</div>
@endif


@if($user->id == $project->contractor_id)

    <input type="hidden" name="receiver_id" value="{{ $project->consultant_id }}">

    <div class="form-control bg-light" style="min-width:250px;max-width:250px;">
        إلى: الاستشاري
    </div>

@endif


@if($user->id == $project->owner_id)

    <input type="hidden" name="receiver_id" value="{{ $project->contractor_id }}">

    <div class="form-control bg-light" style="min-width:250px;max-width:250px;">
        إلى: المقاول
    </div>

@endif













            {{-- CC (اختياري) --}}
            <!-- <div style="min-width:250px;max-width:250px;">
                {!! Form::label('cc_user_id', 'CC (اختياري)') !!}
                {!! Form::select('cc_user_id', $users, null, [
                    'class' => 'form-control',
                    'placeholder' => '-- بدون'
                ]) !!}
            </div> -->







@if($user->id == $project->consultant_id)
<div style="min-width:250px;max-width:250px;">
    {!! Form::label('cc_user_id','CC') !!}
    {!! Form::select('cc_user_id', [
        $project->owner_id => 'المالك',
        $project->contractor_id => 'المقاول'
    ], null, ['class'=>'form-control','placeholder'=>'اختياري']) !!}
</div>
@endif


@if($user->id == $project->contractor_id)
<div style="min-width:250px;max-width:250px;">
    {!! Form::label('cc_user_id','CC') !!}
    {!! Form::select('cc_user_id', [
        $project->owner_id => 'المالك'
    ], null, ['class'=>'form-control','placeholder'=>'اختياري']) !!}
</div>
@endif


@if($user->id == $project->owner_id)

    <input type="hidden" name="cc_user_id" value="{{ $project->consultant_id }}">

    <div class="form-control bg-light" style="min-width:250px;max-width:250px;">
        CC: الاستشاري
    </div>

@endif







            <!-- {{-- عنوان --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('subject', 'عنوان الرسالة') !!}
                {!! Form::text('subject', null, [
                    'class' => 'form-control'
                ]) !!}
            </div> -->



            {{-- مرفق واحد --}}
            <div class="col-md-3">
                <div class="border rounded p-2 small bg-light attachment-box">

                    <input type="file" name="attachment" class="form-control form-control-sm attachment-input mb-1">

                    <div class="text-truncate selected-file-name d-none"></div>

                    <a href="#" target="_blank"
                       class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">
                        👁 Preview
                    </a>

                    <button type="button"
                            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
                        🗑 Remove
                    </button>

                </div>
            </div>

            {{-- الرسالة --}}
            <div style="min-width:100%;">
                {!! Form::label('message', 'نص الرسالة') !!}
                {!! Form::textarea('message', null, [
                    'class' => 'form-control',
                    'rows' => 5,
                    'required',
                    'id' => 'message',
                ]) !!}
            </div>

            

        </div>

        <div class="card-footer d-flex justify-content-center gap-3">

    {!! Form::submit('إرسال', [
        'class' => 'btn btn-olive btn-sm',
        'style' => 'background-color:#2f3a1f;color:#d4af37;font-weight:600;'
    ]) !!}

    {{-- معاينة --}}
    <button type="button"
            id="previewBtn"
            class="btn btn-dark btn-sm">

        👁 معاينة قبل الإرسال

    </button>

    <a href="{{ route('projects.messages.index', $project->id) }}"
       class="btn btn-secondary btn-sm">

        رجوع

    </a>

</div>
        {!! Form::close() !!}
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.querySelector('.attachment-input');
    const box = document.querySelector('.attachment-box');

    input.addEventListener('change', function () {
        const fileName = box.querySelector('.selected-file-name');
        const preview = box.querySelector('.preview-file');

        if (!this.files.length) return;

        const file = this.files[0];

        fileName.textContent = file.name;
        fileName.classList.remove('d-none');

        preview.href = URL.createObjectURL(file);
        preview.classList.remove('d-none');
    });

    document.querySelector('.remove-file').addEventListener('click', function () {
        input.value = '';

        box.querySelectorAll('.preview-file,.selected-file-name')
            .forEach(el => el.classList.add('d-none'));
    });

});
</script>







<script>

document.getElementById('previewBtn').addEventListener('click', function () {

    let form = document.getElementById('messageForm');

    let formData = new FormData(form);

    fetch("{{ route('projects.messages.preview', $project->id) }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(async response => {

        const blob = await response.blob();

        const fileURL = URL.createObjectURL(blob);

        window.open(fileURL, '_blank');
    });

});

</script>






















<script>

const messageTemplates = {

    1: `الموضوع : إشعار بخصوص تأخر صرف دفعة المقاول

السادة/ [اسم المالك] المحترمين،

نود إفادتكم بأنه تم ملاحظة تأخر في صرف الدفعة المستحقة للمقاول عن أعمال مشروع المذكور اعلاه ، والتي كان من المقرر اعتمادها وصرفها بتاريخ …………………..
وحيث إن استمرار التأخير في صرف المستحقات المالية قد يؤثر على سير العمل في الموقع والتزام المقاول بالبرنامج الزمني المعتمد، نأمل منكم التكرم بسرعة اتخاذ الإجراءات اللازمة لاعتماد وصرف الدفعة المستحقة في أقرب وقت ممكن، بما يضمن استمرار الأعمال دون تعطيل
نؤكد حرصنا على استمرار تنفيذ المشروع وفق الجدول الزمني المحدد، وتفادي أي تأخير قد ينتج عن توقف أو تباطؤ الأعمال بسبب المستحقات المالية

شاكرين لكم تعاونكم الدائم

وتفضلوا بقبول فائق الاحترام والتقدير`,



    2: `الموضوع : التذكير بضرورة بإجراءات السلامة قبل البدء في الأعمال

السادة/ [اسم المقاول] المحترمين،

نود تذكيركم بضرورة الالتزام الكامل بجميع متطلبات وإجراءات السلامة والصحة المهنية المعتمدة بالمشروع قبل البدء في تنفيذ أي أعمال بالموقع.

وعليه، يرجى التأكد من استكمال كافة المتطلبات اللازمة، بما في ذلك الحصول على تصاريح العمل المطلوبة، وتوفير معدات الوقاية الشخصية للعاملين، واعتماد تقييم المخاطر وخطط السلامة المتعلقة بالأعمال المزمع تنفيذها، والتأكد من جاهزية المعدات والأدوات المستخدمة وفقاً لمتطلبات السلامة المعتمدة.

كما نؤكد على عدم مباشرة أي أعمال قبل استيفاء جميع اشتراطات السلامة والحصول على الموافقات اللازمة، وذلك حفاظاً على سلامة العاملين والموقع والممتلكات، وتجنباً لأي مخالفات قد تؤثر على سير المشروع.

نأمل منكم التقيد بما ورد أعلاه وإبلاغ فرقكم العاملة بالموقع بذلك قبل الشروع في تنفيذ الأعمال.

وتفضلوا بقبول فائق الاحترام والتقدير`,



    3: `الموضوع : تمديد مدة تنفيذ المشروع

السادة المحترمين
تحية طيبة وبعد،

بالإشارة إلى عقد تنفيذ المشروع المذكور ، نتقدم نحن (المقاول) بطلب تمديد مدة تنفيذ المشروع لمدة ……. (…) أشهر إضافية، وذلك ابتداءً من تاريخ ………….. انتهاء تاريخ العقد، ليصبح تاريخ الانتهاء الجديد هو: *انتهاء تاريخ العقد + مدة التمديد.

كما نؤكد على التزامنا بتحمل جميع الغرامات أو التبعات المالية الناتجة عن فترة التأخير خلال مدة التمديد المطلوبة، وفقاً لشروط العقد.

نأمل منكم التكرم بالموافقة على هذا الطلب، مع خالص التقدير والاحترام.

وتفضلوا بقبول فائق الاحترام والتقدير`,



    4: `الموضوع : تنبيه بضرورة الحصول على اعتماد الاستشاري قبل البدء بأي أعمال أو مراحل تنفيذية

السادة/ شركة المقاولات المحترمين،

نفيدكم بضرورة عدم البدء بأي أعمال جديدة أو الانتقال إلى أي مرحلة تنفيذية لاحقة بالمشروع قبل تقديمها للاستشاري والحصول على اعتماده وموافقته الخطية المسبقة.

وعليه، فإن أي أعمال يتم تنفيذها دون الرجوع إلى الاستشاري أو دون الحصول على الاعتماد اللازم تعتبر مسؤولية المقاول الكاملة والمنفردة، ويتحمل المقاول جميع ما يترتب عليها من آثار أو تبعات فنية أو مالية أو زمنية، بما في ذلك أعمال الإزالة أو التعديل أو إعادة التنفيذ أو أي تأخير قد ينتج عنها، وذلك دون أي مسؤولية على المالك أو الاستشاري.

لذا يرجى الالتزام التام بعدم المباشرة بأي بند أو مرحلة جديدة إلا بعد الحصول على اعتماد الاستشاري وفق الأصول المتبعة بالمشروع.

وتفضلوا بقبول فائق الاحترام والتقدير`,



    5: `الموضوع : تركيب كاميرات المراقبة بالموقع

السادة/ [اسم المقاول] المحترمين،

نود التأكيد على ضرورة تركيب وتشغيل كاميرات المراقبة في موقع المشروع بشكل عاجل، وذلك وفقاً لمتطلبات المشروع وتعليمات الإشراف، لضمان متابعة سير الأعمال وتوثيق جميع مراحل التنفيذ والمحافظة على أمن وسلامة الموقع.

يرجى التأكد من تغطية جميع المناطق الرئيسية وأماكن تنفيذ الأعمال بالكاميرات، والتأكد من عملها بشكل مستمر مع حفظ التسجيلات وإتاحتها عند الطلب.

كما نأمل تزويدنا بما يفيد استكمال أعمال التركيب والتشغيل خلال المدة المحددة، مع الالتزام الكامل بأي متطلبات إضافية تصدر من الاستشاري أو إدارة المشروع.

شاكرين لكم تعاونكم.

وتفضلوا بقبول فائق الاحترام والتقدير`,



    6: `الموضوع : تنظيف الموقع

السادة/ [اسم المقاول] المحترمين،

نود التنبيه إلى ضرورة الالتزام بتنظيف موقع المشروع بشكل مستمر ورفع جميع المخلفات الناتجة عن الأعمال أولاً بأول، وذلك للحفاظ على سلامة الموقع وتحسين بيئة العمل وضمان سير الأعمال بالشكل المطلوب.

يرجى التأكد من إزالة المخلفات والمواد الزائدة وتنظيم المواد بالموقع في الأماكن المخصصة، مع الالتزام بعدم تراكم أي نفايات أو عوائق قد تؤثر على حركة العمل أو السلامة العامة.

كما نأمل منكم القيام بحملة تنظيف شاملة للموقع بشكل عاجل، والالتزام الدائم بالمحافظة على نظافة الموقع طوال فترة تنفيذ المشروع.

وتفضلوا بقبول فائق الاحترام والتقدير`,



    7: `الموضوع : طلب توفير مواد التشطيبات

السادة/ [اسم المالك] المحترمين،

بالإشارة إلى سير أعمال مشروع [اسم المشروع]، نود إفادتكم بضرورة توفير مواد التشطيبات الخاصة بالمشروع، وذلك لضمان استكمال الأعمال وفق البرنامج الزمني المعتمد دون أي تأخير.

نرجو التكرم باتخاذ ما يلزم لتأمين وتوريد مواد التشطيبات المطلوبة في أقرب وقت ممكن، بما في ذلك [يمكن ذكر المواد إن وجدت: البلاط، الدهانات، الأبواب، الأسقف المستعارة، إلخ]، وذلك لتمكين المقاول من مواصلة أعمال التنفيذ حسب المخططات والمواصفات المعتمدة.

كما نؤكد أن أي تأخير في توفير المواد قد يؤدي إلى تأخير في إنجاز الأعمال النهائية للمشروع، الأمر الذي قد يؤثر على الجدول الزمني المعتمد.

شاكرين لكم تعاونكم، ونأمل سرعة التجاوب لتفادي أي تأخير في سير العمل.

وتفضلوا بقبول فائق الاحترام والتقدير`,



    8: `الموضوع: إشعار بسوء تنفيذ الأعمال

السادة/ [اسم المقاول] المحترمين،

بالإشارة إلى العقد الخاص بمشروع المذكور أعلاه ، والمعاينة لوحظ وجود ملاحظات تتعلق بسوء تنفيذ بعض الأعمال وعدم مطابقتها للمواصفات الفنية والمخططات المعتمدة وشروط العقد.

وتشمل الملاحظات ما يلي :

……………………………………………….
……………………………………………….
……………………………………………….

وعليه، نطلب منكم اتخاذ الإجراءات التصحيحية اللازمة وإعادة تنفيذ الأعمال غير المطابقة وفقاً للمواصفات المعتمدة وعلى نفقتكم الخاصة، وذلك خلال مدة لا تتجاوز ……………. من تاريخ هذا الإشعار.

يرجى العلم بأن عدم معالجة هذه الملاحظات خلال المدة المحددة سيؤدي إلى اتخاذ الإجراءات التعاقدية اللازمة وفقاً لأحكام العقد، مع تحميلكم كامل المسؤولية عن أي آثار أو تكاليف ناتجة عن ذلك.

نأمل سرعة التجاوب ومعالجة الملاحظات المشار إليها.

وتفضلوا بقبول فائق الاحترام والتقدير`,



    9: `الموضوع: إشعار تأخير في تنفيذ الأعمال

السادة/ [اسم المقاول] المحترمين،

نود إشعاركم بأنه لوحظ وجود تأخير في تنفيذ الأعمال المتفق عليها بموجب العقد.

وعليه، نرجو منكم تزويدنا خلال [………] أيام بخطة عمل محدثة توضح أسباب التأخير والإجراءات التصحيحية المقترحة لتدارك الوضع والالتزام بالجدول الزمني المعتمد.

يرجى العلم أن استمرار التأخير قد يترتب عليه تطبيق البنود التعاقدية ذات الصلة، بما في ذلك الغرامات أو الإجراءات الأخرى المنصوص عليها في العقد.

نأمل اتخاذ الإجراءات اللازمة بشكل عاجل، وإفادتنا بما تم اتخاذه من خطوات لمعالجة التأخير.

وتفضلوا بقبول فائق الاحترام والتقدير`,



    10: `الموضوع : اعلام بزيادة أسعار

السادة/ مالك المشروع المحترمين،

نفيدكم بأن المقاول تقدم بطلب زيادة أسعار لبعض بنود الأعمال، مرفقاً به كافة المؤيدات والمستندات الداعمة للطلب.

وقد قام الاستشاري بمراجعة ودراسة الطلب من الناحية الفنية والتعاقدية، وانتهى إلى اعتماد الزيادة المطلوبة وفقاً لما ورد في تقريره وتوصياته المرفقة.

وعليه، نرفع لسيادتكم طلب المقاول المعتمد من قبل الاستشاري للاطلاع والتكرم باتخاذ ما ترونه مناسباً بشأنه، واستكمال الإجراءات اللازمة وفقاً لأحكام العقد.

1. طلب المقاول.
2. المستندات والمؤيدات الداعمة.
3. تقرير الاستشاري المتضمن الدراسة والاعتماد.

وتفضلوا بقبول فائق الاحترام والتقدير`,



    11: `الموضوع : إنذار بضرورة الالتزام بتعليمات الاستشاري

السادة/ [اسم المقاول] المحترمين

تحية طيبة وبعد،

نود لفت عنايتكم إلى ضرورة الالتزام التام بجميع تعليمات وتوجيهات الاستشاري الصادرة للمشروع، وتنفيذ الأعمال وفق المخططات والمواصفات المعتمدة وأصول المهنة، وعدم إجراء أي تعديل أو تنفيذ أي أعمال دون الرجوع إلى الاستشاري والحصول على الموافقات اللازمة.

ونؤكد أن أي أعمال يتم تنفيذها بالمخالفة لتعليمات الاستشاري أو للمخططات والمواصفات المعتمدة ستعتبر أعمالاً مخالفة، ويتحمل المقاول كامل المسؤولية المترتبة عليها، بما في ذلك إزالة الأعمال المخالفة وإعادة تنفيذها على نفقته الخاصة، دون أن يترتب على ذلك أي تمديد للمدة الزمنية أو أي مطالبات مالية إضافية.

كما نؤكد أن الاستمرار في عدم الالتزام بتعليمات الاستشاري أو تكرار المخالفات سيعرض المقاول لاتخاذ الإجراءات التعاقدية المناسبة وفقاً لشروط العقد، مع تحميله كافة التكاليف والمسؤوليات والآثار المترتبة على تلك المخالفات.

لذا يرجى اعتبار هذا الكتاب إنذاراً رسمياً ونهائياً بضرورة التقيد الكامل والفوري بتعليمات الاستشاري وجميع المخططات والمواصفات المعتمدة، وتلافي تكرار أي مخالفات مستقبلاً، بما يضمن حسن سير العمل وجودة التنفيذ وتجنب اتخاذ أي إجراءات تعاقدية وفقاً لأحكام العقد وشروطه.

وتفضلوا بقبول فائق الاحترام والتقدير`
};

document.getElementById('message_type_id').addEventListener('change', function () {

    let typeId = this.value;

    if(messageTemplates[typeId]) {
        document.getElementById('message').value = messageTemplates[typeId];
    }

});

</script>



@endpush