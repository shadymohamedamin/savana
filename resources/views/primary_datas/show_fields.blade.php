
<div class="container mt-4">
    {{-- Tabs --}}
    <ul class="nav nav-tabs mb-4" id="caseTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab">Case Info</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="supports-tab" data-bs-toggle="tab" data-bs-target="#supports" type="button" role="tab">Supports</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="attachments-tab" data-bs-toggle="tab" data-bs-target="#attachments" type="button" role="tab">Attachments</button>
        </li>
    </ul>

    <div class="tab-content" id="caseTabsContent">
        {{-- Case Info --}}
        <div class="tab-pane fade show active" id="info" role="tabpanel">
            {{-- (Keep your existing Personal Info / Contact Info / etc. here) --}}
            {{-- [Insert the full personal/government/career sections you posted earlier here.] --}}
            @include('primary_datas.case_info', ['primaryData' => $primaryData]) 
        </div>

        {{-- Supports Table --}}
        <!-- <div class="tab-pane fade" id="supports" role="tabpanel">
            <div class="card shadow-sm border-primary">
                <div class="card-header bg-primary text-white">Supports</div>
                <div class="card-body table-responsive">
                    @if ($primaryData->supports->count())
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Support Date</th>
                                    <th>Support Required</th>
                                    <th>Support Done</th>
                                    <th>Need Amount</th>
                                    <th>Support Amount</th>
                                    <th>Note</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($primaryData->supports as $support)
                                    <tr>
                                        <td>{{ $support->ID }}</td>
                                        <td>{{ $support->Dat }}</td>
                                        <td>{{ $support->supportrequiredarch->SupportType ?? '' }}</td>
                                        <td>{{ $support->supporttype->SupportType ?? '' }}</td>
                                        <td>{{ $support->NeedAmount }}</td>
                                        <td>{{ $support->SupportAmount }}</td>
                                        <td>{{ $support->Note }}</td>
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No supports found for this case.</p>
                    @endif
                </div>
            </div>
        </div> -->
        {{-- Supports Table --}}
        <div class="tab-pane fade" id="supports" role="tabpanel">
            <div class="card shadow-sm border-success">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <span>Supports</span>
                    <a href="#" class="btn btn-sm btn-light text-success border" 
                            data-bs-toggle="modal" 
                            data-bs-target="#supportModal" 
                            data-url="{{ route('supports.create', ['case_id' => $primaryData->ID]) }}">
                        <i class="fas fa-plus"></i> Add New 
                    </a>
                </div>
                <div class="card-body table-responsive">
                    @if ($primaryData->supports->count())
                        <table class="table table-bordered table-striped table-hover align-middle text-center">
                            <thead class="table-success">
                                <tr>
                                    <th>Actions</th>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Support Required</th>
                                    <th>Support Done</th>
                                    <th>Need Amount</th>
                                    <th>Support Amount</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($primaryData->supports as $support)
                                    <tr>

                                        <td>
                                            <a href="{{ route('supports.download', $support->ID) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-file-download"></i> تحميل
                                            </a>

                                            <a href="{{ route('supports.print', $support->ID) }}" class="btn btn-sm btn-secondary" target="_blank">
                                                <i class="fas fa-print"></i> طباعة
                                            </a>
                                            <button class="btn btn-sm btn-warning" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#supportModal" 
                                                    data-url="{{ route('supports.edit', $support->ID) }}">
                                                <i class="fas fa-edit"></i> تعديل
                                            </button>
                                            <form action="{{ route('supports.destroy', $support->ID) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i> حذف
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $support->ID }}</td>
                                        <td>{{ $support->Dat }}</td>
                                        <td>{{ $support->supportrequiredarch->SupportType ?? '' }}</td>
                                        <td>{{ $support->supporttype->SupportType ?? '' }}</td>
                                        <td>{{ $support->NeedAmount }}</td>
                                        <td>{{ $support->SupportAmount }}</td>
                                        <td>{{ $support->Note }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No supports found for this case.</p>
                    @endif
                </div>
            </div>
        </div>


        
        {{-- Attachments Table --}}
        <div class="tab-pane fade" id="attachments" role="tabpanel">
            <div class="card shadow-sm border-secondary">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <span>Attachments</span>
                    <!-- <a href="{{ route('attachments.create', ['case_id' => $primaryData->ID]) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> Add New
                    </a> -->
                    <!-- Add New Button  data-bs-toggle="modal" data-bs-target="#attachmentModal" data-url="{{ route('attachments.create', ['case_id' => $primaryData->ID]) }}"-->
                    <button type="button" class="btn btn-sm btn-success" href="{{ route('attachments.create', ['case_id' => $primaryData->ID]) }}" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-url="{{ route('attachments.create', ['case_id' => $primaryData->ID]) }}">
                        <i class="fas fa-plus"></i> Add New
                    </button>

                </div>
                <div class="card-body table-responsive">
                    @if ($primaryData->attachments->count())
                        <table class="table table-bordered table-striped table-hover align-middle text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Actions</th>
                                    <th>ID</th>
                                    <th>Attachment Type</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($primaryData->attachments as $attachment)
                                    <tr>
                                        <td>
                                            @php
                                                $relativePath = str_replace('\\\\svr\\RAKcMainApp$\\', '', $attachment->AttPath);
                                                $publicPath = str_replace('\\', '/', $relativePath);
                                            @endphp
                                            <a href="{{ asset($publicPath) }}" target="_blank" class="btn btn-sm btn-primary" title="Preview">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ asset($publicPath) }}" download class="btn btn-sm btn-info" title="Download">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <!-- <a href="{{ route('attachments.edit', $attachment->ID) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>  -->
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#attachmentModal" data-url="{{ route('attachments.edit', $attachment->ID) }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('attachments.destroy', $attachment->ID) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this attachment?')" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td>{{ $attachment->ID }}</td>
                                        <td>{{ $attachment->attid->AttType ?? 'N/A' }}</td>
                                        <td>{{ $attachment->Remarks }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No attachments found for this case.</p>
                    @endif
                </div>
            </div>
        </div> 




    </div>
</div>


<!-- Modal for supports -->
<div class="modal fade" id="supportModal" tabindex="-1" aria-labelledby="supportModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="supportModalLabel">Support</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <div id="supportModalContent">
          <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>




<!-- Modal for attachments -->
<div class="modal fade" id="attachmentModal" tabindex="-1" aria-labelledby="attachmentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="attachmentModalLabel">Attachment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <div id="attachmentModalContent">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Include Bootstrap JS and dependencies for supports -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var supportModal = document.getElementById('supportModal');
        supportModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var url = button.getAttribute('data-url');

            document.getElementById('supportModalContent').innerHTML = `
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>`;

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('supportModalContent').innerHTML = html;
                })
                .catch(error => {
                    // document.getElementById('supportModalContent').innerHTML = `
                    //     <div class="alert alert-danger">Failed to load content.</div>
                    //     ${error.message}
                    // `;
                    console.error('Modal load error:', error);
                    window.location.href = url;
                    console.error('Modal load error:', error);
                });
        });
    });





    document.addEventListener('DOMContentLoaded', function () {
        const hash = window.location.hash;
        if (hash) {
            const triggerEl = document.querySelector(`button[data-bs-target="${hash}"]`);
            if (triggerEl) {
                const tab = new bootstrap.Tab(triggerEl);
                tab.show();
            }
        }
    });

</script>







<!-- Include Bootstrap JS and dependencies for attachments -->
 <script>

document.addEventListener('DOMContentLoaded', function () {
    var attachmentModal = document.getElementById('attachmentModal');
    attachmentModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var url = button.getAttribute('data-url');

        document.getElementById('attachmentModalContent').innerHTML = `
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>`;

        fetch(url)
            .then(response => response.text())
            .then(html => {
                document.getElementById('attachmentModalContent').innerHTML = html;
            })
            .catch(error => {
                
                //document.getElementById('attachmentModalContent').innerHTML = `
                //    <div class="alert alert-danger">Failed to load content. Please try again.</div>
                //    ${error.message}
                //`;

                    console.error('Modal load error:', error);
                    window.location.href = url;
                    console.error('Error loading modal content:', error);
            });
    });
});




    document.addEventListener('DOMContentLoaded', function () {
        const hash = window.location.hash;
        if (hash) {
            const triggerEl = document.querySelector(`button[data-bs-target="${hash}"]`);
            if (triggerEl) {
                const tab = new bootstrap.Tab(triggerEl);
                tab.show();
            }
        }
    });

</script>




@push('scripts')
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
