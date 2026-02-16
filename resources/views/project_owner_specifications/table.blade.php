<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="project-owner-specifications-table">
            <thead>
            <tr>
                <th>Project Id</th>
                <th>Water Heater</th>
                <th>Bathroom Chairs</th>
                <th>Exhaust Fan</th>
                <th>Insulation</th>
                <th>Aluminum</th>
                <th>Water Tank</th>
                <th>Main Door</th>
                <th>Paint Type</th>
                <th>Hot Cold Water For Bidet</th>
                <th>Car Electric Point</th>
                <th>Facade Lighting Points</th>
                <th>Pantry Plumbing First Floor</th>
                <th>Roof Water Point</th>
                <th>Roof Electric Point</th>
                <th>Roof Plumbing Install</th>
                <th>Ac Civil Works</th>
                <th>Front Stairs</th>
                <th>Floor Protection</th>
                <th>Ac Water Recovery Tank</th>
                <th>Washroom Faucets</th>
                <th>Sanitary Drainage</th>
                <th>Ceramic Tiles</th>
                <th>Water Tank Capacity</th>
                <th>Door Heights</th>
                <th>Fence Water Points</th>
                <th>Fence Electric Points</th>
                <th>Exterior Stone Tiles</th>
                <th>Camera Points</th>
                <th>Annex Ceramic Price</th>
                <th>Planting Basins</th>
                <th>Hidden Plaster Beam</th>
                <th>First Floor Bath Drainage</th>
                <th>Central Exhaust Fans</th>
                <th>Bath Wall Niches</th>
                <th>Garage Door Electric Point</th>
                <th>Curb Grooves</th>
                <th>Window Electric Points</th>
                <th>Sound System Pipes</th>
                <th>Cleanout Rebates</th>
                <th colspan="3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projectOwnerSpecifications as $projectOwnerSpecification)
                <tr>
                    <td>{{ $projectOwnerSpecification->project_id }}</td>
                    <td>{{ $projectOwnerSpecification->water_heater }}</td>
                    <td>{{ $projectOwnerSpecification->bathroom_chairs }}</td>
                    <td>{{ $projectOwnerSpecification->exhaust_fan }}</td>
                    <td>{{ $projectOwnerSpecification->insulation }}</td>
                    <td>{{ $projectOwnerSpecification->aluminum }}</td>
                    <td>{{ $projectOwnerSpecification->water_tank }}</td>
                    <td>{{ $projectOwnerSpecification->main_door }}</td>
                    <td>{{ $projectOwnerSpecification->paint_type }}</td>
                    <td>{{ $projectOwnerSpecification->hot_cold_water_for_bidet }}</td>
                    <td>{{ $projectOwnerSpecification->car_electric_point }}</td>
                    <td>{{ $projectOwnerSpecification->facade_lighting_points }}</td>
                    <td>{{ $projectOwnerSpecification->pantry_plumbing_first_floor }}</td>
                    <td>{{ $projectOwnerSpecification->roof_water_point }}</td>
                    <td>{{ $projectOwnerSpecification->roof_electric_point }}</td>
                    <td>{{ $projectOwnerSpecification->roof_plumbing_install }}</td>
                    <td>{{ $projectOwnerSpecification->ac_civil_works }}</td>
                    <td>{{ $projectOwnerSpecification->front_stairs }}</td>
                    <td>{{ $projectOwnerSpecification->floor_protection }}</td>
                    <td>{{ $projectOwnerSpecification->ac_water_recovery_tank }}</td>
                    <td>{{ $projectOwnerSpecification->washroom_faucets }}</td>
                    <td>{{ $projectOwnerSpecification->sanitary_drainage }}</td>
                    <td>{{ $projectOwnerSpecification->ceramic_tiles }}</td>
                    <td>{{ $projectOwnerSpecification->water_tank_capacity }}</td>
                    <td>{{ $projectOwnerSpecification->door_heights }}</td>
                    <td>{{ $projectOwnerSpecification->fence_water_points }}</td>
                    <td>{{ $projectOwnerSpecification->fence_electric_points }}</td>
                    <td>{{ $projectOwnerSpecification->exterior_stone_tiles }}</td>
                    <td>{{ $projectOwnerSpecification->camera_points }}</td>
                    <td>{{ $projectOwnerSpecification->annex_ceramic_price }}</td>
                    <td>{{ $projectOwnerSpecification->planting_basins }}</td>
                    <td>{{ $projectOwnerSpecification->hidden_plaster_beam }}</td>
                    <td>{{ $projectOwnerSpecification->first_floor_bath_drainage }}</td>
                    <td>{{ $projectOwnerSpecification->central_exhaust_fans }}</td>
                    <td>{{ $projectOwnerSpecification->bath_wall_niches }}</td>
                    <td>{{ $projectOwnerSpecification->garage_door_electric_point }}</td>
                    <td>{{ $projectOwnerSpecification->curb_grooves }}</td>
                    <td>{{ $projectOwnerSpecification->window_electric_points }}</td>
                    <td>{{ $projectOwnerSpecification->sound_system_pipes }}</td>
                    <td>{{ $projectOwnerSpecification->cleanout_rebates }}</td>
                    <td  style="width: 120px">
                        {!! Form::open(['route' => ['projectOwnerSpecifications.destroy', $projectOwnerSpecification->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('projectOwnerSpecifications.show', [$projectOwnerSpecification->id]) }}"
                               class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('projectOwnerSpecifications.edit', [$projectOwnerSpecification->id]) }}"
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
            @include('adminlte-templates::common.paginate', ['records' => $projectOwnerSpecifications])
        </div>
    </div>
</div>
