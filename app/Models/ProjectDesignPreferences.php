<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectDesignPreferences extends Model
{
    public $table = 'project_design_preferences';

    public $fillable = [
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
        'insulation'
    ];

    protected $casts = [
        'villa_style' => 'string',
        'villa_door' => 'string',
        'villa_location' => 'string',
        'double_height' => 'boolean',
        'open_living' => 'boolean',
        'villa_connection' => 'string',
        'ceiling_height' => 'decimal:1',
        'internal_garden_view' => 'boolean',
        'stairs_location' => 'string',
        'pantry_location' => 'string',
        'service_doors' => 'string',
        'future_elevator' => 'boolean',
        'internal_courtyard' => 'boolean',
        'villa_shape' => 'string',
        'dining_serves' => 'string',
        'stairs_type' => 'string',
        'ac_type' => 'string',
        'doors_height' => 'string',
        'furniture_level' => 'string',
        'bathroom_chairs' => 'string',
        'underground_tank' => 'boolean',
        'insulation' => 'string'
    ];

    public static array $rules = [
        'project_id' => 'required',
        'villa_style' => 'nullable|string|max:255',
        'floors_count' => 'nullable',
        'villa_door' => 'nullable|string|max:255',
        'villa_location' => 'nullable|string|max:255',
        'double_height' => 'required|boolean',
        'open_living' => 'required|boolean',
        'villa_connection' => 'nullable|string|max:255',
        'ceiling_height' => 'nullable|numeric',
        'internal_garden_view' => 'required|boolean',
        'stairs_location' => 'nullable|string|max:255',
        'pantry_location' => 'nullable|string|max:255',
        'service_doors' => 'nullable|string|max:255',
        'future_elevator' => 'required|boolean',
        'internal_courtyard' => 'required|boolean',
        'villa_shape' => 'nullable|string|max:255',
        'dining_serves' => 'nullable|string|max:255',
        'stairs_type' => 'nullable|string|max:255',
        'ac_type' => 'nullable|string|max:255',
        'doors_height' => 'nullable|string|max:255',
        'furniture_level' => 'nullable|string|max:255',
        'bathroom_chairs' => 'nullable|string|max:255',
        'underground_tank' => 'required|boolean',
        'insulation' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}
