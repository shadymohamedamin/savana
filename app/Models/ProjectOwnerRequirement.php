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
        'unit',
        'unit_price',
        'total_price',
        'category',
        'context',
        'tender_user_id',
        'tender_status',
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

    protected static function booted()
    {
        static::saving(function ($model) {
            if ($model->quantity && $model->unit_price) {
                $model->total_price = $model->quantity * $model->unit_price;
            }



            $requirement = $model->ownerRequirement;

            while ($requirement && $requirement->parent_id) {
                $parent = $requirement->parent;

                $parent->total_price = ProjectOwnerRequirement::whereIn(
                    'owner_requirement_id',
                    $parent->children()->pluck('id')
                )->sum('total_price');

                $parent->save();

                $requirement = $parent;
            }
        });
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


    /*public function ownerRequirement()
    {
        return $this->belongsTo(OwnerRequirement::class, 'owner_requirement_id');
    }*/


    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }




    
}
