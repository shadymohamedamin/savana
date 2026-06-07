<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-messages-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>Sender Id</th>
                <th>Receiver Id</th>
                <th>Cc User Id</th>
                <th>Message Type Id</th>
                <th>Message</th>
                <th>Attachment</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectMessages as $projectMessage)
                <tr>
                    <td>{{ $projectMessage->project_id }}</td>
                    <td>{{ $projectMessage->sender_id }}</td>
                    <td>{{ $projectMessage->receiver_id }}</td>
                    <td>{{ $projectMessage->cc_user_id }}</td>
                    <td>{{ $projectMessage->message_type_id }}</td>
                    <td>{!! $projectMessage->message !!}</td>
                    <td>{{ $projectMessage->attachment }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectMessages.destroy', $projectMessage->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectMessages.show', [$projectMessage->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectMessages.edit', [$projectMessage->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projectMessages])
        </div>
    </div>
</div>
