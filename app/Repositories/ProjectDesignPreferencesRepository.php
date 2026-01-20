<?php

namespace App\Repositories;

use App\Models\ProjectDesignPreferences;
use App\Repositories\BaseRepository;

class ProjectDesignPreferencesRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'villa_style',
        'floors_count',
        'villa_door',
        'villa_location',
        'double_height',
        'open_living',
        'villa_connection',
        'ceiling_height',
        'internal_garden_view',
        'stairs_location',
        'pantry_location',
        'service_doors',
        'future_elevator',
        'internal_courtyard',
        'villa_shape',
        'dining_serves',
        'stairs_type',
        'ac_type',
        'doors_height',
        'furniture_level',
        'bathroom_chairs',
        'underground_tank',
        'skirting_type'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectDesignPreferences::class;
    }
}
