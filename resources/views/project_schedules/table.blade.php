<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-schedules-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>Item No</th>
                <th>Title</th>
                <th>Payment Percentage</th>
                <th>Completion Percentage</th>
                <th>Duration Days</th>
                <th>Amount</th>
                <th>Notes</th>
                <th>Due Date</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectSchedules as $projectSchedule)
                <tr>
                    <td>{{ $projectSchedule->project_id }}</td>
                    <td>{{ $projectSchedule->item_no }}</td>
                    <td>{{ $projectSchedule->title }}</td>
                    <td>{{ $projectSchedule->payment_percentage }}</td>
                    <td>{{ $projectSchedule->completion_percentage }}</td>
                    <td>{{ $projectSchedule->duration_days }}</td>
                    <td>{{ $projectSchedule->amount }}</td>
                    <td>{{ $projectSchedule->notes }}</td>
                    <td>{{ $projectSchedule->due_date }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectSchedules.destroy', $projectSchedule->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectSchedules.show', [$projectSchedule->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectSchedules.edit', [$projectSchedule->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projectSchedules])
        </div>
    </div>
</div>
