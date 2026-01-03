<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="house-types-table">
            <thead>
            <tr>
                <th>Housetype</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($houseTypes as $houseType)
                <tr>
                    <td>{{ $houseType->HouseType }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['houseTypes.destroy', $houseType->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('houseTypes.show', [$houseType->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('houseTypes.edit', [$houseType->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $houseTypes])
        </div>
    </div>
</div>
