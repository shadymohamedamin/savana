<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-design-preferences-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>Villa Style</th>
                <th>Floors Count</th>
                <th>Villa Door</th>
                <th>Villa Location</th>
                <th>Double Height</th>
                <th>Open Living</th>
                <th>Villa Connection</th>
                <th>Ceiling Height</th>
                <th>Internal Garden View</th>
                <th>Stairs Location</th>
                <th>Pantry Location</th>
                <th>Service Doors</th>
                <th>Future Elevator</th>
                <th>Internal Courtyard</th>
                <th>Villa Shape</th>
                <th>Dining Serves</th>
                <th>Stairs Type</th>
                <th>Ac Type</th>
                <th>Doors Height</th>
                <th>Furniture Level</th>
                <th>Bathroom Chairs</th>
                <th>Underground Tank</th>
                <th>Skirting Type</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectDesignPreferences as $projectDesignPreferences)
                <tr>
                    <td>{{ $projectDesignPreferences->project_id }}</td>
                    <td>{{ $projectDesignPreferences->villa_style }}</td>
                    <td>{{ $projectDesignPreferences->floors_count }}</td>
                    <td>{{ $projectDesignPreferences->villa_door }}</td>
                    <td>{{ $projectDesignPreferences->villa_location }}</td>
                    <td>{{ $projectDesignPreferences->double_height }}</td>
                    <td>{{ $projectDesignPreferences->open_living }}</td>
                    <td>{{ $projectDesignPreferences->villa_connection }}</td>
                    <td>{{ $projectDesignPreferences->ceiling_height }}</td>
                    <td>{{ $projectDesignPreferences->internal_garden_view }}</td>
                    <td>{{ $projectDesignPreferences->stairs_location }}</td>
                    <td>{{ $projectDesignPreferences->pantry_location }}</td>
                    <td>{{ $projectDesignPreferences->service_doors }}</td>
                    <td>{{ $projectDesignPreferences->future_elevator }}</td>
                    <td>{{ $projectDesignPreferences->internal_courtyard }}</td>
                    <td>{{ $projectDesignPreferences->villa_shape }}</td>
                    <td>{{ $projectDesignPreferences->dining_serves }}</td>
                    <td>{{ $projectDesignPreferences->stairs_type }}</td>
                    <td>{{ $projectDesignPreferences->ac_type }}</td>
                    <td>{{ $projectDesignPreferences->doors_height }}</td>
                    <td>{{ $projectDesignPreferences->furniture_level }}</td>
                    <td>{{ $projectDesignPreferences->bathroom_chairs }}</td>
                    <td>{{ $projectDesignPreferences->underground_tank }}</td>
                    <td>{{ $projectDesignPreferences->skirting_type }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectDesignPreferences.destroy', $projectDesignPreferences->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectDesignPreferences.show', [$projectDesignPreferences->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectDesignPreferences.edit', [$projectDesignPreferences->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projectDesignPreferences])
        </div>
    </div>
</div>
