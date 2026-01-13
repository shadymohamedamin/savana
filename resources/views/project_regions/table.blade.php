<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-regions-table">
            <thead>
            <tr>
                <th>Name Ar</th>
                <th>Name En</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectRegions as $projectRegion)
                <tr>
                    <td>{{ $projectRegion->name_ar }}</td>
                    <td>{{ $projectRegion->name_en }}</td>
                    <td>{{ $projectRegion->status }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectRegions.destroy', $projectRegion->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectRegions.show', [$projectRegion->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectRegions.edit', [$projectRegion->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projectRegions])
        </div>
    </div>
</div>
