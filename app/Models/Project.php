<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Status;
use App\Models\User;
use App\Models\Attachment;

class Project extends Model
{
    protected $table = 'projects';

    /**
     * Mass assignable fields
     */
    protected $fillable = [
        'project_code',
        'name',
        'description',
        'case_id_number',
        'building_number',
        'fence_number',
        'qasmia_number',
        'city_id',
        'owner_id',
        'contractor_id',
        'consultant_id',
        'status_id',
        'start_date',
        'end_date',


        'design_fee',
        'supervision_fee',
        'budget',
        'area',
    ];

    /**
     * Cast attributes
     */
   protected $casts = [
        'city_id'       => 'integer',
        'owner_id'      => 'integer',
        'contractor_id' => 'integer',
        'consultant_id' => 'integer',
        'start_date'    => 'date',
        'end_date'      => 'date',
    ];

    /**
     * Validation rules (InfyOm compatible)
     */
    public static array $rules = [
        'project_code'    => 'nullable|string|max:50|unique:projects,project_code',
        'name'            => 'required|string|max:255',
        'description'     => 'nullable|string',
        'case_id_number'  => 'nullable|string|max:50',
        'building_number' => 'nullable|string|max:50',
        'fence_number'    => 'nullable|string|max:50',
        'status_id'       => 'required|exists:statuses,id',
        'start_date'      => 'nullable|date',
        'end_date'        => 'nullable|date|after_or_equal:start_date',
        'design_fee'      => 'nullable|string|max:50',
        'supervision_fee' => 'nullable|string|max:50',
        'budget'          => 'nullable|string|max:50',  
        'area'            => 'nullable|string|max:50',
    ];

    /* ===================== Relationships ===================== */

    /*public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('role_id')
            ->withTimestamps();
    }*/

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_users')
            ->withPivot('role_id')
            ->withTimestamps();
    }

    public function owner()
{
    return $this->belongsToMany(User::class, 'project_users')
        ->withPivot('role_id')
        ->wherePivot('role_id', 2);
}

public function contractor()
{
    return $this->belongsToMany(User::class, 'project_users')
        ->withPivot('role_id')
        ->wherePivot('role_id', 3);
}

public function consultant()
{
    return $this->belongsToMany(User::class, 'project_users')
        ->withPivot('role_id')
        ->wherePivot('role_id', 7);
}


    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }




    public function city()
    {
        return $this->belongsTo(\App\Models\Region::class, 'city_id');
    }

    public function ownerUser()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function contractorUser()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    public function consultantUser()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

}
