<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerRequirement extends Model
{
    public $table = 'owner_requirements';

    public $fillable = [
        'name',
        'floor',
        'is_general',
        'unit',
        'main_category',
        'notes',
        'name_ar',
        'name_en',
        'parent_id',
        'type',
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
        'updated_at' => 'nullable',
        'notes' => 'nullable'
    ];
    

    public function projects()
    {
        return $this->belongsToMany(
            Project::class,
            'project_owner_requirements'
        )
        ->withPivot(['quantity', 'notes'])
        ->withTimestamps();
    }

    public function projectOwnerRequirements()
    {
        return $this->hasMany(
            ProjectOwnerRequirement::class,
            'owner_requirement_id'
        );
    }


    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function items()
    {
        return $this->children()->where('type', 'item');
    }


    public function sections()
    {
        return $this->children()->where('type', 'section');
    }
    /*public function projectOwnerRequirements()
    {
        return $this->belongsToMany(Project::class, 'project_owner_requirements')
            ->withPivot(['quantity', 'unit_price', 'total_price', 'notes', 'context'])
            ->withTimestamps();
    }*/

}
