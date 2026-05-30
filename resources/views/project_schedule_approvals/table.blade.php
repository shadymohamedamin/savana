<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-schedule-approvals-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>Batch Id</th>
                <th>Contractor Approved</th>
                <th>Owner Approved</th>
                <th>Consultant Approved</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectScheduleApprovals as $projectScheduleApproval)
                <tr>
                    <td>{{ $projectScheduleApproval->project_id }}</td>
                    <td>{{ $projectScheduleApproval->batch_id }}</td>
                    <td>{{ $projectScheduleApproval->contractor_approved }}</td>
                    <td>{{ $projectScheduleApproval->owner_approved }}</td>
                    <td>{{ $projectScheduleApproval->consultant_approved }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectScheduleApprovals.destroy', $projectScheduleApproval->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectScheduleApprovals.show', [$projectScheduleApproval->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectScheduleApprovals.edit', [$projectScheduleApproval->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projectScheduleApprovals])
        </div>
    </div>
</div>
