<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRegion extends Model
{
    public $table = 'project_regions';

    public $fillable = [
        'name_ar',
        'name_en',
        'status'
    ];

    protected $casts = [
        'name_ar' => 'string',
        'name_en' => 'string',
        'status' => 'boolean'
    ];

    public static array $rules = [
        'name_ar' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
        'status' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function projects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Project::class, 'project_region_id');
    }
}
