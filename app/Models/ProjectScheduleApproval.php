<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectScheduleApproval extends Model
{
    public $table = 'project_schedules_approvals';

    public $fillable = [
        'project_id',
        'batch_id',
        'contractor_approved',
        'owner_approved',
        'consultant_approved'
    ];

    protected $casts = [
        'contractor_approved' => 'boolean',
        'owner_approved' => 'boolean',
        'consultant_approved' => 'boolean'
    ];

    public static array $rules = [
        'project_id' => 'required',
        'batch_id' => 'required',
        'contractor_approved' => 'required|boolean',
        'owner_approved' => 'required|boolean',
        'consultant_approved' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
