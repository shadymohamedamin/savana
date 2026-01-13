<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-stages-table">
            <thead>
            <tr>
                <th>Name Ar</th>
                <th>Name En</th>
                <th>Order</th>
                <th>Active</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectStages as $projectStage)
                <tr>
                    <td>{{ $projectStage->name_ar }}</td>
                    <td>{{ $projectStage->name_en }}</td>
                    <td>{{ $projectStage->order }}</td>
                    <td>{{ $projectStage->active }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectStages.destroy', $projectStage->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectStages.show', [$projectStage->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectStages.edit', [$projectStage->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projectStages])
        </div>
    </div>
</div>
