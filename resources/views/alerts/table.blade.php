<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="alerts-table">
            <thead>
            <tr>
                <th>Senderid</th>
                <th>Receiverid</th>
                <th>Alertmsg</th>
                <th>Alertdate</th>
                <th>Readstatus</th>
                <!-- <th colspan="3">Action</th> -->
            </tr>
            </thead>
            <tbody>
            @foreach($alerts as $alert)
                <tr>
                    <td>{{ $alert->SenderID }}</td>
                    <td>{{ $alert->ReceiverID }}</td>
                    <td>{{ $alert->AlertMsg }}</td>
                    <td>{{ $alert->AlertDate }}</td>
                    <td>{{ $alert->ReadStatus }}</td>
                    <!-- <td  style="width: 120px">
                        {!! Form::open(['route' => ['alerts.destroy', $alert->ID], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('alerts.show', [$alert->ID]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('alerts.edit', [$alert->ID]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td> -->
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $alerts])
        </div>
    </div>
</div>
