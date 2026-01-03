<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="nationalits-table">
            <thead>
            <tr>
                <th>Nationality</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($nationalits as $nationalit)
                <tr>
                    <td>{{ $nationalit->Nationality }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['nationalits.destroy', $nationalit->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('nationalits.show', [$nationalit->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('nationalits.edit', [$nationalit->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $nationalits])
        </div>
    </div>
</div>
