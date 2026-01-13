<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectStage extends Model
{
    public $table = 'project_stages';

    public $fillable = [
        'name_ar',
        'name_en',
        'order',
        'active'
    ];

    protected $casts = [
        'name_ar' => 'string',
        'name_en' => 'string',
        'active' => 'boolean'
    ];

    public static array $rules = [
        'name_ar' => 'required|string|max:255',
        'name_en' => 'required|string|max:255',
        'order' => 'required',
        'active' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
