@extends('layouts.app')

@section('content')


<style>
    .attachment-complete {
        background-color: #e6fffa !important; /* أخضر فاتح */
        border-left: 5px solid #198754; /* Bootstrap green */
    }

    .attachment-pending {
        background-color: #fff3cd !important; /* أصفر */
    }


    .btn-olive {
        background-color: #2f3a1f;   /* زيتوني غامق */
        border: 1px solid #2f3a1f;
        color: #d4af37;              /* ذهبي */
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-olive:hover {
        background-color: #3e4a29;  /* زيتوني أفتح */
        border-color: #d4af37;       /* إطار ذهبي */
        color: #fff;                /* أبيض أنيق */
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(212,175,55,0.35);
    }
    .buttons_container{
        padding-bottom: 4rem;
    }


    .attachment-box input[type="file"] {
    font-size: 13px;
}

.attachment-box .btn {
    padding: 2px 8px;
    font-size: 12px;
}

.selected-file-name {
    font-size: 12px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>
@php
    $type = request('type');
@endphp

@php
    $isEdit = isset($attachments) && $attachments->count() > 0;
@endphp


<div class="container" style="background-color: #f5f5dc;">
    <!-- <h3>{{ __('Manage Attachments for') }}: {{ $model->name }}</h3> -->



    <h3>
        {{ $isEdit ? __('Edit Attachments for') : __('Manage Attachments for') }}
        : {{ $model->name }}
    </h3>
    @include('flash::message')

    <!-- @if($type === 'projects')
        <div class="card mb-4">
            <div class="card-header text-white" style="background:#d4af37">
                {{ __('Standard Templates') }}
            </div>

            <div class="card-body" style="background-color: #f5f5dc;">
                <ul>
                    <li>
                        <a href="{{ route('projects.contract.download', $model->id) }}" target="_blank">
                            📄 عقد الاتفاق (PDF)
                        </a>
                    </li>
                    <li><a href="{{ asset('templates/assignment.pdf') }}" download>خطاب التكليف</a></li>
                    <li><a href="{{ asset('templates/form.pdf') }}" download>فورم الفيزا</a></li>
                </ul>
            </div>
        </div>
    @endif -->





@if($type === 'projects')
<div class="card mb-4">
    <div class="card-header text-white" style="background:#d4af37">
        {{ __('Standard Templates') }}
    </div>

    <div class="card-body d-flex gap-3 flex-wrap" style="background-color: #f5f5dc;">

        
        {{--    Owner And Consultant Contract عقد المالك والاستشاري والمقاول --}}
        <!-- <div class="d-flex flex-column">
            <span class="mb-1">{{ __('Owner And Consultant Contract') }}</span>
            <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                👁 {{ __('Preview') }}
            </a>
            <a href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>
            <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
        </div>  -->

        {{-- عقد المالك والاستشاري --}}
        <div class="d-flex flex-column">
            <span class="mb-1">{{ __('Owner And Consultant And Contractor Contract') }}</span>
            <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                👁 {{ __('Preview') }}
            </a>
            <a href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>
            <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
        </div>

         {{-- خطاب التكليف --}}
        <div class="d-flex flex-column">
            <span class="mb-1">{{ __('Takleef Contract') }}</span>

            <a target="_blank"
            href="{{ route('projects.contract.takleef.pdf', ['id' => $model->id, 'action' => 'preview']) }}"
            class="btn btn-outline-primary btn-sm mb-1">
                👁 {{ __('Preview') }}
            </a>

            <a href="{{ route('projects.contract.takleef.pdf', ['id' => $model->id, 'action' => 'download']) }}"
            class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>

            <a target="_blank"
            href="{{ route('projects.contract.takleef.pdf', ['id' => $model->id, 'action' => 'print']) }}"
            class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
        </div>


        <div class="d-flex flex-column">
    <span class="mb-1">{{ __('احتياجات المالك') }}</span>

    <a target="_blank" href="{{ route('projects.contract.owner-requirements.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
        👁 {{ __('Preview') }}
    </a>

    <a href="{{ route('projects.contract.owner-requirements.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
        ⬇ {{ __('Download') }}
    </a>

    <a target="_blank" href="{{ route('projects.contract.owner-requirements.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
        🖨 {{ __('Print') }}
    </a>
</div>











        {{-- Hawya Contract --}}
 <!-- <div class="d-flex flex-column">
    <span class="mb-1">{{ __('Hawya Contract') }}</span>

    <a target="_blank" href="{{ route('projects.contract.hawya.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
        👁 {{ __('Preview') }}
    </a>

    <a href="{{ route('projects.contract.hawya.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
        ⬇ {{ __('Download') }}
    </a>

    <a target="_blank" href="{{ route('projects.contract.hawya.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
        🖨 {{ __('Print') }}
    </a>
</div> 



 
<div class="d-flex flex-column">
    <span class="mb-1">{{ __('Site Delivery Contract') }}</span>

    <a target="_blank" href="{{ route('projects.contract.site_delivery.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
        👁 {{ __('Preview') }}
    </a>

    <a href="{{ route('projects.contract.site_delivery.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
        ⬇ {{ __('Download') }}
    </a>

    <a target="_blank" href="{{ route('projects.contract.site_delivery.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
        🖨 {{ __('Print') }}
    </a>
</div>





<div class="d-flex flex-column">
    <span class="mb-1">{{ __('Bank Contract') }}</span>

    <a target="_blank" href="{{ route('projects.contract.bank.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
        👁 {{ __('Preview') }}
    </a>

    <a href="{{ route('projects.contract.bank.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
        ⬇ {{ __('Download') }}
    </a>

    <a target="_blank" href="{{ route('projects.contract.bank.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
        🖨 {{ __('Print') }}
    </a>
</div>







<div class="d-flex flex-column">
    <span class="mb-1">{{ __('Bank Table Contract') }}</span>

    <a target="_blank" href="{{ route('projects.contract.bank_table.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
        👁 {{ __('Preview') }}
    </a>

    <a href="{{ route('projects.contract.bank_table.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
        ⬇ {{ __('Download') }}
    </a>

    <a target="_blank" href="{{ route('projects.contract.bank_table.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
        🖨 {{ __('Print') }}
    </a>
</div> 

 -->


        <!--{{-- فورم الفيوا --}}
        <div class="d-flex flex-column">
            <span class="mb-1">{{ __('Fiwa Form') }}</span>
            <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                👁 {{ __('Preview') }}
            </a>
            <a href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>
            <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
        </div> -->

       
    </div>
</div>
@endif



    {{-- Upload attachments --}}
    <form action="{{ route('users.attachments.store', ['id' => $model->id, 'type' => $type]) }}"
      method="POST"
      enctype="multipart/form-data">

    



        @csrf

        <!-- <div class="alert alert-info text-right">
            <strong>{{ __('Instructions') }}:</strong><br>
            - {{ __('Maximum 10 files') }}.<br>
            - {{ __('Maximum 10 MB per file') }}.<br>
            - {{ __('Allowed types') }}: PDF, JPG, PNG.<br>
            - {{ __('You can add notes for each file') }}.<br>
            - {{ __('Click the X button to remove any attachment') }}.
        </div> -->


        <div class="card mb-4" style="background:#d4af37">
            <div class="card-header    d-flex justify-content-between align-items-center" style="background:#d4af37">
                <span>{{ __('Upload Attachments') }}</span>
                <button type="button" id="addAttachment" class="btn btn-olive px-4 btn-sm">
                    {{ __('Add Attachment') }}
                </button>

            </div>
            
            <div class="card-body" id="attachmentContainer" style="background-color: #f5f5dc;">
                {{-- Default 3 attachment cards --}}
                 @php
                    $defaultTypes = $defaultTypes ?? [];
                @endphp


                @if($isEdit)
                    @foreach($attachments as $index => $att)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body row attachment-row" style="background-color: #f5f5dc;">

                            <input type="hidden" name="attachments[{{ $index }}][id]" value="{{ $att->id }}">

                            <div class="col-md-2">
                                <select name="attachments[{{ $index }}][attachment_type_id]" class="form-control">
                                    @foreach($attTypes as $id => $name)
                                        <option value="{{ $id }}" {{ $att->attachment_type_id == $id ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- <div class="col-md-3">
                                <input type="file" name="attachments[{{ $index }}][file]" class="form-control">
                                <small class="text-muted d-block">{{ $att->file_name }}</small>

                                @if(!empty($att->web_path))
                                        <a href="{{ asset($att->web_path) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary mt-1">
                                            👁 {{ __('View') }}
                                        </a>
                                @endif

                                

                            </div> -->
                            <div class="col-md-3">
                                <div class="border rounded p-2 small bg-light">

                                    <input type="file"
                                        name="attachments[{{ $index }}][file]"
                                        class="form-control form-control-sm mb-1">

                                    <div class="text-truncate" title="{{ $att->file_name }}">
                                        📄 {{ $att->file_name }}
                                    </div>

                                    @if(!empty($att->web_path))
                                        <a href="{{ asset($att->web_path) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary w-100 mt-1">
                                            👁 View
                                        </a>
                                    @endif

                                </div>
                            </div>


                            <div class="col-md-3">
                                <input type="date"
                                    name="attachments[{{ $index }}][expiration_date]"
                                    value="{{ optional($att->expiration_date)->format('Y-m-d') }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-3">
                                <input type="text"
                                    placeholder={{ __('Notes') }}
                                    name="attachments[{{ $index }}][notes]"
                                    value="{{ $att->notes }}"
                                    class="form-control">
                            </div>

                            <div class="col-md-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger removeAttachment">X</button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                



                @else
                    {{-- @for ($i = 0; $i < sizeof($defaultTypes); $i++) --}}

                    @foreach ($defaultTypes as $i => $typeId)
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body row" style="background-color: #f5f5dc;" >

                                <div class="form-group col-md-2">
                                    <!-- <label>{{ __('Attachment Type') }}</label> -->
                                    <select name="attachments[{{ $i }}][attachment_type_id]" class="form-control">
                                        <option value="">{{ __('-- Select Type --') }}</option>

                                        @foreach($attTypes as $id => $name)
                                            <!-- <option value="{{ $id }}"
                                                {{ isset($defaultTypes[$i]) && $defaultTypes[$i] == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option> -->
                                            <option value="{{ $id }}"{{ $typeId == $id ? 'selected' : '' }}>
                                                {{ $name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- <div class="form-group col-md-3">
                                   
                                    <input type="file" name="attachments[{{ $i }}][file]" class="form-control">
                                    
                                    <small class="text-muted d-block selected-file-name d-none"></small>

                                    @if(isset($attachments[$i]) && $attachments[$i]->file_path)
                                        <a href="{{ asset('storage/'.$attachments[$i]->file_path) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary mt-1 stored-file">
                                            👁 {{ __('View File') }}
                                        </a>
                                    @endif

                                    <a href="#"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-success mt-1 preview-file d-none">
                                            👁 {{ __('View') }}
                                    </a> 
                                </div> -->

                                <div class="form-group col-md-3 attachment-box">
                                    <input type="file"
                                        name="attachments[{{ $i }}][file]"
                                        class="form-control attachment-input">

                                    <small class="text-muted d-block selected-file-name d-none"></small>

                                    {{-- file already stored in DB --}}
                                    @if(isset($attachments[$i]) && $attachments[$i]->file_path)
                                        <a href="{{ asset('storage/'.$attachments[$i]->file_path) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary mt-1 stored-file">
                                            👁 {{ __('View File') }}
                                        </a>
                                    @endif

                                    {{-- preview before submit --}}
                                    <a href="#"
                                    target="_blank"
                                    class="btn btn-sm btn-outline-success mt-1 preview-file d-none">
                                        👁 {{ __('View') }}
                                    </a>
                                </div>

                                <div class="form-group col-md-3">
                                    <input type="date"
                                        name="attachments[{{ $i }}][expiration_date]"
                                        class="form-control"
                                        placeholder="Expiration Date">
                                </div>

                                <div class="form-group col-md-3">
                                    <!-- <label>{{ __('Notes') }}</label> -->
                                    <input placeholder={{ __('Notes') }} type="text" name="attachments[{{ $i }}][notes]" class="form-control">
                                </div>

                                <div class="form-group col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger removeAttachment">X</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- <div class="text-center">
            <button type="submit" class="btn btn-success px-5">Save Attachments</button>
        </div> -->


        <div class="buttons_container text-center mt-4 d-flex justify-content-center gap-3">

            {{-- Save --}}
<button type="submit"
        name="action"
        value="save"
        class="btn btn-olive px-4">
    💾 {{ __('Save') }}
</button>

{{-- Show ONLY when type != projects --}}
@if ($type !== 'projects' && !$isAdminFiles)
    <button type="submit"
            name="action"
            value="save_create_project"
            class="btn btn-olive px-4">
        ➕ {{ __('Save & Create Project') }}
    </button>
@endif

{{-- Cancel Button --}}
<a href="{{ $type === 'projects'
            ? route('projects.index')
            : route('users.index') }}"
   class="btn btn-secondary px-4">
    ✖ {{ __('Cancel') }}
</a>



        </div>
    </form>
</div>
@endsection





@push('scripts')



<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.attachment-input').forEach(input => {

        input.addEventListener('change', function () {
            const file = this.files[0];
            const box = this.closest('.attachment-box');
            const fileNameEl = box.querySelector('.selected-file-name');
            const previewBtn = box.querySelector('.preview-file');
            const storedBtn = box.querySelector('.stored-file');

            if (!file) return;

            // show file name
            fileNameEl.textContent = file.name;
            fileNameEl.classList.remove('d-none');

            // hide stored file button if exists
            if (storedBtn) storedBtn.classList.add('d-none');

            // create temp url
            const fileURL = URL.createObjectURL(file);

            previewBtn.href = fileURL;
            previewBtn.classList.remove('d-none');
        });

    });

});
</script>





<script>
let attachmentIndex = 3; // start after default 3
const maxAttachments = 10;
const maxSizeMB = 10;

// Add remove functionality
function addRemove(button) {
    button.addEventListener('click', function() {
        button.closest('.attachment-card').remove();
        attachmentIndex--;
    });
}

// Attach remove to default 3 cards
document.querySelectorAll('.removeAttachment').forEach(btn => addRemove(btn));

// Add new attachment dynamically
document.getElementById('addAttachment').addEventListener('click', function () {
    if (attachmentIndex >= maxAttachments) { alert("{{ __('Maximum 10 files') }}"); return; }

    const card = document.createElement('div');
    card.className = 'card mb-3 shadow-sm attachment-card';
    card.querySelector('.attachment-row')?.classList.add('attachment-pending');

    /*.innerHTML = `
        <div class="card-body row">
            <div class="form-group col-md-6">
                <label>File</label>
                <input type="file" name="attachments[${attachmentIndex}][file]" class="form-control attachment-file" required>
            </div>
            <div class="form-group col-md-5">
                <label>Notes</label>
                <input type="text" name="attachments[${attachmentIndex}][notes]" class="form-control">
            </div>
            <div class="form-group col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger removeAttachment">X</button>
            </div>
        </div>
    `;*/

    card.innerHTML = `
<div class="card-body row" style="background-color: #f5f5dc;">

    <div class="form-group col-md-2">
        <select name="attachments[${attachmentIndex}][attachment_type_id]" class="form-control" required>
            <option value="">{{ __('-- Select Type --') }}</option>
            @foreach($attTypes as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-3">
        <input type="file"
            name="attachments[${attachmentIndex}][file]"
            class="form-control attachment-file"
            required>
    </div>

    <div class="form-group col-md-3">
        <input type="date"
            name="attachments[${attachmentIndex}][expiration_date]"
            class="form-control">
    </div>

    <div class="form-group col-md-3">
        <input type="text"
            name="attachments[${attachmentIndex}][notes]"
            class="form-control"
            placeholder="{{ __('Notes') }}">
    </div>

    <div class="form-group col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-danger removeAttachment">X</button>
    </div>
</div>
`;




    document.getElementById('attachmentContainer').appendChild(card);
    addRemove(card.querySelector('.removeAttachment'));

    const fileInput = card.querySelector('.attachment-file');
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        if (file.size > maxSizeMB * 1024 * 1024) {
           aalert("{{ __('File too big') }}"); this.value = '';
        }
    });

    attachmentIndex++;
});
</script>




<script>




/*document.addEventListener('change', function (e) {
    if (e.target.classList.contains('attachment-file')) {

        const fileInput = e.target;
        const row = fileInput.closest('.attachment-row');

        const previewBtn = row.querySelector('.preview-file');
        const fileNameText = row.querySelector('.selected-file-name');

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];

            // show row as completed
            row.classList.remove('attachment-pending');
            row.classList.add('attachment-complete');

            // show file name
            fileNameText.textContent = file.name;
            fileNameText.classList.remove('d-none');

            // create preview URL
            const fileURL = URL.createObjectURL(file);

            previewBtn.href = fileURL;
            previewBtn.classList.remove('d-none');
        } else {
            // remove highlight
            row.classList.remove('attachment-complete');
            row.classList.add('attachment-pending');

            fileNameText.classList.add('d-none');
            previewBtn.classList.add('d-none');
        }
    }
});*/






    
document.addEventListener('change', function (e) {
    if (e.target.classList.contains('attachment-file')) {
        const row = e.target.closest('.attachment-row');

        if (e.target.files.length > 0) {
            row.classList.remove('attachment-pending');
            row.classList.add('attachment-complete');
        } else {
            row.classList.remove('attachment-complete');
            row.classList.add('attachment-pending');
        }
    }
});
</script>

<script>
document.addEventListener('change', function (e) {
    if (e.target.type === 'file') {
        const fileInput = e.target;
        const row = fileInput.closest('.attachment-row');

        const previewBtn = row.querySelector('.preview-file');
        const storedBtn  = row.querySelector('.stored-file');

        if (fileInput.files.length > 0) {
            const fileURL = URL.createObjectURL(fileInput.files[0]);

            previewBtn.href = fileURL;
            previewBtn.classList.remove('d-none');

            if (storedBtn) {
                storedBtn.classList.add('d-none');
            }
        }
    }
});
</script>



@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
    });
});
</script>
@endif



@endpush










