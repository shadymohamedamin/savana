<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerRequirement extends Model
{
    public $table = 'owner_requirements';

    public $fillable = [
        'name',
        'floor',
        'is_general'
    ];

    protected $casts = [
        'name' => 'string',
        'floor' => 'string',
        'is_general' => 'boolean'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'floor' => 'required|string|max:50',
        'is_general' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function projectOwnerRequirements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\ProjectOwnerRequirement::class, 'owner_requirement_id');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_owner_requirements')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
