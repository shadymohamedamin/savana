<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-owner-requirements-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>Owner Requirement Id</th>
                <th>Quantity</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectOwnerRequirements as $projectOwnerRequirement)
                <tr>
                    <td>{{ $projectOwnerRequirement->project_id }}</td>
                    <td>{{ $projectOwnerRequirement->owner_requirement_id }}</td>
                    <td>{{ $projectOwnerRequirement->quantity }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectOwnerRequirements.destroy', $projectOwnerRequirement->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectOwnerRequirements.show', [$projectOwnerRequirement->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectOwnerRequirements.edit', [$projectOwnerRequirement->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projectOwnerRequirements])
        </div>
    </div>
</div>
