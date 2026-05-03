<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="message-types-table">
            <thead>
            <tr>
                <th>Name Ar</th>
                <th>Name En</th>
                <th>Active</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($messageTypes as $messageType)
                <tr>
                    <td>{{ $messageType->name_ar }}</td>
                    <td>{{ $messageType->name_en }}</td>
                    <td>{{ $messageType->active }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['messageTypes.destroy', $messageType->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('messageTypes.show', [$messageType->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('messageTypes.edit', [$messageType->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $messageTypes])
        </div>
    </div>
</div>
