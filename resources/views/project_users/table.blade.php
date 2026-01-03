<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-users-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>User Id</th>
                <th>Role Id</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectUsers as $projectUser)
                <tr>
                    <td>{{ $projectUser->project_id }}</td>
                    <td>{{ $projectUser->user_id }}</td>
                    <td>{{ $projectUser->role_id }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectUsers.destroy', $projectUser->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectUsers.show', [$projectUser->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectUsers.edit', [$projectUser->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projectUsers])
        </div>
    </div>
</div>
