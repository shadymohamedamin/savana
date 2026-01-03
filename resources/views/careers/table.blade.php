<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="careers-table">
            <thead>
            <tr>
                <th>Career</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($careers as $career)
                <tr>
                    <td>{{ $career->Career }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['careers.destroy', $career->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('careers.show', [$career->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('careers.edit', [$career->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $careers])
        </div>
    </div>
</div>
