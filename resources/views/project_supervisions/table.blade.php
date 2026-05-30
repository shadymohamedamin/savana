<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-supervisions-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>User Id</th>
                <th>Supervision Type Id</th>
                <th>Note</th>
                <th>Attachment</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectSupervisions as $projectSupervision)
                <tr>
                    <td>{{ $projectSupervision->project_id }}</td>
                    <td>{{ $projectSupervision->user_id }}</td>
                    <td>{{ $projectSupervision->supervision_type_id }}</td>
                    <td>{{ $projectSupervision->note }}</td>
                    <td>{{ $projectSupervision->attachment }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectSupervisions.destroy', $projectSupervision->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectSupervisions.show', [$projectSupervision->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectSupervisions.edit', [$projectSupervision->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projectSupervisions])
        </div>
    </div>
</div>
