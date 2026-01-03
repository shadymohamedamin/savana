<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="sexes-table">
            <thead>
            <tr>
                <th>Sex</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sexes as $sex)
                <tr>
                    <td>{{ $sex->Sex }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['sexes.destroy', $sex->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('sexes.show', [$sex->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('sexes.edit', [$sex->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $sexes])
        </div>
    </div>
</div>
