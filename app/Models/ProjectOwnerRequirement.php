<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectOwnerRequirement extends Model
{
    public $table = 'project_owner_requirements';

    public $fillable = [
        'project_id',
        'owner_requirement_id',
        'quantity',
        'notes'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'project_id' => 'required',
        'owner_requirement_id' => 'required',
        'quantity' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'notes' => 'nullable'
    ];

    public function ownerRequirement(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\OwnerRequirement::class, 'owner_requirement_id');
    }


    public function ownerRequirements()
    {
        return $this->belongsToMany(
            OwnerRequirement::class,
            'project_owner_requirements'
        )
        ->withPivot(['quantity', 'notes'])
        ->withTimestamps();
    }


    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}
