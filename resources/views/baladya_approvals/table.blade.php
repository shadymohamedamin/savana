<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="baladya-approvals-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>Owner Id</th>
                <th>Status Type Id</th>
                <th>Case Number</th>
                <th>Opened At</th>
                <th>Approved At</th>
                <th>Days Diff</th>
                <th>Reason</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($baladyaApprovals as $baladyaApproval)
                <tr>
                    <td>{{ $baladyaApproval->project_id }}</td>
                    <td>{{ $baladyaApproval->owner_id }}</td>
                    <td>{{ $baladyaApproval->status_type_id }}</td>
                    <td>{{ $baladyaApproval->case_number }}</td>
                    <td>{{ $baladyaApproval->opened_at }}</td>
                    <td>{{ $baladyaApproval->approved_at }}</td>
                    <td>{{ $baladyaApproval->days_diff }}</td>
                    <td>{{ $baladyaApproval->reason }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['baladyaApprovals.destroy', $baladyaApproval->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('baladyaApprovals.show', [$baladyaApproval->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('baladyaApprovals.edit', [$baladyaApproval->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $baladyaApprovals])
        </div>
    </div>
</div>
