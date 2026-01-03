@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
<style>
    /* Custom styling */
    table.dataTable thead {
        background: linear-gradient(90deg, #1d2b64, #f8cdda);
        color: white;
    }
    table.dataTable tbody tr:hover {
        background-color: #f1f7fd;
    }
    .dataTables_wrapper .dataTables_filter input {
        border-radius: .25rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <h2 class="text-2xl font-bold mb-4">Audit Logs</h2>

    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-3">
            <input name="user" value="{{ request('user') }}" class="form-control" placeholder="Search by user">
        </div>
        <div class="col-md-2">
            <select name="event" class="form-control">
                <option value="">All Events</option>
                @foreach(['created','updated','deleted','login','logout'] as $ev)
                    <option value="{{ $ev }}" {{ request('event')==$ev?'selected':'' }}>{{ ucfirst($ev) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="date" name="from" value="{{ request('from') }}" class="form-control" placeholder="From date">
        </div>
        <div class="col-md-2">
            <input type="date" name="to" value="{{ request('to') }}" class="form-control" placeholder="To date">
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('audit-logs.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table id="audit-table" class="table table-striped align-middle table-hover">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Action</th>
                    <th>Model</th>
                    <th>Record ID</th>
                    <th>Changes</th>
                    <th>IP</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($audits as $audit)
                    <tr>
                        <td>{{ optional($audit->user)->name ?? 'System' }}</td>
                        <td>{{ ucfirst($audit->event) }}</td>
                        <td>{{ class_basename($audit->auditable_type) }}</td>
                        <td>{{ $audit->auditable_id }}</td>
                        <!-- <td class="text-start">
                            @foreach($audit->new_values as $k => $v)
                                <div><strong>{{ $k }}:</strong> {{ $audit->old_values[$k] ?? '-' }} → {{ $v }}</div>
                            @endforeach
                        </td> -->
                        <td class="text-start">
                            @php
                                $changes = array_diff_assoc($audit->new_values, $audit->old_values ?? []);
                            @endphp

                            @if(count($changes))
                                @foreach($changes as $k => $newVal)
                                    @php
                                        $oldVal = $audit->old_values[$k] ?? '-';
                                    @endphp
                                    <div>
                                        <strong>{{ ucfirst(str_replace('_', ' ', $k)) }}:</strong>
                                        <span class="text-danger">{{ $oldVal }}</span>
                                        →
                                        <span class="text-success">{{ $newVal }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div><em>No changes detected</em></div>
                            @endif
                        </td>

                        <td>{{ $audit->ip_address }}</td>
                        <td>{{ $audit->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-3">{{ $audits->links() }}</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<script>
$(function() {
    $('#audit-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copy', className: 'btn btn-sm btn-outline-secondary' },
            { extend: 'excel', className: 'btn btn-sm btn-outline-success', title: 'Audit_Export' },
            { extend: 'pdf', className: 'btn btn-sm btn-outline-danger', title: 'Audit_Export' },
            { extend: 'print', className: 'btn btn-sm btn-outline-info' },
        ],
        paging: false,
        ordering: false,
        info: false,
        searching: false
    });
});
</script>
@endpush
