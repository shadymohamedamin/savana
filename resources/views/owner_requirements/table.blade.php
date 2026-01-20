<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="owner-requirements-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Floor</th>
                <th>Is General</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ownerRequirements as $ownerRequirement)
                <tr>
                    <td>{{ $ownerRequirement->name }}</td>
                    <td>{{ $ownerRequirement->floor }}</td>
                    <td>{{ $ownerRequirement->is_general }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['ownerRequirements.destroy', $ownerRequirement->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('ownerRequirements.show', [$ownerRequirement->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('ownerRequirements.edit', [$ownerRequirement->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $ownerRequirements])
        </div>
    </div>
</div>
