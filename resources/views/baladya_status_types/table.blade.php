<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="baladya-status-types-table">
            <thead>
            <tr>
                <th>Name Ar</th>
                <th>Name En</th>
                <th>Active</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($baladyaStatusTypes as $baladyaStatusType)
                <tr>
                    <td>{{ $baladyaStatusType->name_ar }}</td>
                    <td>{{ $baladyaStatusType->name_en }}</td>
                    <td>{{ $baladyaStatusType->active }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['baladyaStatusTypes.destroy', $baladyaStatusType->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('baladyaStatusTypes.show', [$baladyaStatusType->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('baladyaStatusTypes.edit', [$baladyaStatusType->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $baladyaStatusTypes])
        </div>
    </div>
</div>
