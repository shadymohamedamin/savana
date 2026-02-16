<?php

namespace App\Repositories;

use App\Models\ProjectOwnerSpecification;
use App\Repositories\BaseRepository;

class ProjectOwnerSpecificationRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'water_heater',
        'bathroom_chairs',
        'exhaust_fan',
        'insulation',
        'aluminum',
        'water_tank',
        'main_door',
        'paint_type',
        'hot_cold_water_for_bidet',
        'car_electric_point',
        'facade_lighting_points',
        'pantry_plumbing_first_floor',
        'roof_water_point',
        'roof_electric_point',
        'roof_plumbing_install',
        'ac_civil_works',
        'front_stairs',
        'floor_protection',
        'ac_water_recovery_tank',
        'washroom_faucets',
        'sanitary_drainage',
        'ceramic_tiles',
        'water_tank_capacity',
        'door_heights',
        'fence_water_points',
        'fence_electric_points',
        'exterior_stone_tiles',
        'camera_points',
        'annex_ceramic_price',
        'planting_basins',
        'hidden_plaster_beam',
        'first_floor_bath_drainage',
        'central_exhaust_fans',
        'bath_wall_niches',
        'garage_door_electric_point',
        'curb_grooves',
        'window_electric_points',
        'sound_system_pipes',
        'cleanout_rebates'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectOwnerSpecification::class;
    }
}
