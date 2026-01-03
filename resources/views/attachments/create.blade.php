@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Manage Attachments for: {{ $user->name }}</h3>

    @include('flash::message')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- Standard template files --}}
    <div class="card mb-4">
        <div class="card-header bg-info text-white">
            Standard Templates (Download)
        </div>
        <div class="card-body">
            <ul>
                <li><a href="{{ asset('templates/template1.pdf') }}" download>Template 1</a></li>
                <li><a href="{{ asset('templates/template2.pdf') }}" download>Template 2</a></li>
                <li><a href="{{ asset('templates/template3.pdf') }}" download>Template 3</a></li>
            </ul>
        </div>
    </div>

    {{-- Upload attachments --}}
    <form action="{{ route('users.attachments.store', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="alert alert-info text-right">
            <strong>Instructions:</strong><br>
            - Maximum 10 files.<br>
            - Maximum 10 MB per file.<br>
            - Allowed types: PDF, JPG, PNG.<br>
            - You can add notes for each file.<br>
            - Click the X button to remove any attachment.
        </div>

        <div class="card mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span>Upload Attachments</span>
                <button type="button" id="addAttachment" class="btn btn-light btn-sm">Add Attachment</button>
            </div>
            <div class="card-body" id="attachmentContainer">
                {{-- Default 3 attachment cards --}}
                @for ($i = 0; $i < 3; $i++)
                <div class="card mb-3 shadow-sm attachment-card">
                    <div class="card-body row">
                        <div class="form-group col-md-6">
                            <label>File</label>
                            <input type="file" name="attachments[{{ $i }}][file]" class="form-control attachment-file" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Notes</label>
                            <input type="text" name="attachments[{{ $i }}][notes]" class="form-control">
                        </div>
                        <div class="form-group col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger removeAttachment">X</button>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success px-5">Save Attachments</button>
        </div>
    </form>
</div>
@endsection





















<!-- @push('scripts')
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










document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault(); // stop default submit
    const formData = new FormData(this);
    console.log('Form submitted!');
    for (let pair of formData.entries()) {
        console.log(pair[0], pair[1]);
    }

    // You can optionally submit via fetch to see the response
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(res => res.text())
    .then(data => console.log('Response:', data))
    .catch(err => console.error(err));
});












// Attach remove to default 3 cards
document.querySelectorAll('.removeAttachment').forEach(btn => addRemove(btn));

// Add new attachment dynamically
document.getElementById('addAttachment').addEventListener('click', function () {
    if (attachmentIndex >= maxAttachments) { alert('Maximum 10 files'); return; }

    const card = document.createElement('div');
    card.className = 'card mb-3 shadow-sm attachment-card';
    card.innerHTML = `
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
    `;
    document.getElementById('attachmentContainer').appendChild(card);
    addRemove(card.querySelector('.removeAttachment'));

    const fileInput = card.querySelector('.attachment-file');
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        if (file.size > maxSizeMB * 1024 * 1024) {
            alert('File too big'); this.value = '';
        }
    });

    attachmentIndex++;
});
</script>
@endpush -->





















@push('scripts')
<script>


document.querySelector('form').addEventListener('submit', function (e) {
    e.preventDefault();
    const data = new FormData(this);
    for (let pair of data.entries()) {
        console.log(pair[0], pair[1]);
    }
});

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
    if (attachmentIndex >= maxAttachments) { alert('Maximum 10 files'); return; }

    const card = document.createElement('div');
    card.className = 'card mb-3 shadow-sm attachment-card';
    card.innerHTML = `
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
    `;
    document.getElementById('attachmentContainer').appendChild(card);
    addRemove(card.querySelector('.removeAttachment'));

    const fileInput = card.querySelector('.attachment-file');
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        if (file.size > maxSizeMB * 1024 * 1024) {
            alert('File too big'); this.value = '';
        }
    });

    attachmentIndex++;
});


</script>
@endpush
