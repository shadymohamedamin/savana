<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Status;
use App\Models\User;
use App\Models\Attachment;
use App\Models\ProjectStage;
use App\Models\ProjectName;
use App\Models\Projec;
use App\Models\ProjectRegion;
use App\Models\OwnerRequirement;
use App\Models\ProjectDesignPreference;


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
        'building_number2',
        'building_number3',
        'fence_number',
        'qasmia_number',
        'city_id',
        'owner_id',
        'contractor_id',
        'consultant_id',
        'status_id',
        'stage_id',
        'start_date',
        'end_date',
        'duration',
        'project_name_id',
        'project_region_id',

        'design_fee',
        'supervision_fee',
        'budget',
        'area',
        'contractor_contract_end_date',
        'bank_contract_value',      // ✅
        'bank_contract_duration', 
        'financing_type',



        'foot_price',
        'approved_area',
        'linear_meter_area',
        'project_bank_support',
        'project_owner_support'
        
        
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
        'contractor_contract_end_date' => 'date',
    ];

    /**
     * Validation rules (InfyOm compatible)
     */
    public static array $rules = [
        'project_code'    => 'nullable|string|max:50|unique:projects,project_code',
        'name'            => 'nullable|string|max:255',
        'description'     => 'nullable|string',
        'case_id_number'  => 'nullable|string|max:50',
        'building_number' => 'nullable|string|max:50',
        'building_number2' => 'nullable|string|max:50',
        'building_number3' => 'nullable|string|max:50',
        'fence_number'    => 'nullable|string|max:50',
        'status_id'       => 'required|exists:statuses,id',
        'start_date'      => 'nullable|date',
        'end_date'        => 'nullable|date|after_or_equal:start_date',
        'design_fee'      => 'nullable|string|max:50',
        'supervision_fee' => 'nullable|string|max:50',
        'budget'          => 'nullable|string|max:50',  
        'area'            => 'nullable|string|max:50',
        'project_region_id'=>'nullable|string|max:50',

        'foot_price'        => 'nullable|numeric|min:0',
        'approved_area'     => 'nullable|numeric|min:0',
        'linear_meter_area' => 'nullable|numeric|min:0',
        'project_bank_support' => 'numeric|min:0',
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

    public function projectName()
    {
        return $this->belongsTo(ProjectName::class);
    }
    public function projectRegion()
    {
        return $this->belongsTo(ProjectRegion::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }


    public function payments()
    {
        return $this->hasMany(\App\Models\ProjectPayment::class);
    }

    public function getPaidWithVatAttribute()
    {
        return $this->payments->sum(function ($payment) {
            return $payment->total_amount;
        });
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


    public function stage()
    {
        return $this->belongsTo(ProjectStage::class);
    }

        public function baladyaApprovals()
    {
        return $this->hasMany(\App\Models\BaladyaApproval::class, 'project_id', 'id');
    }
    public function projectUsers()
{
    return $this->hasMany(\App\Models\ProjectUser::class);
}
    /*public function ownerRequirements()
    {
        return $this->belongsToMany(
            OwnerRequirement::class,
            'project_owner_requirements'
        )
        ->withPivot(['quantity', 'notes'])
        ->withTimestamps();
    }*/


    public function ownerRequirements()
    {
        return $this->belongsToMany(OwnerRequirement::class, 'project_owner_requirements')
            ->withPivot(['quantity', 'unit_price', 'total_price', 'notes', 'context'])
            ->withTimestamps();
    }

    public function ownerSpecification()
    {
        return $this->hasOne(ProjectOwnerSpecification::class);
    }

    public function ownerRequirementsOwner()
    {
        return $this->ownerRequirements()->wherePivot('context','owner');
    }

    public function ownerRequirementsPricing()
    {
        return $this->ownerRequirements()->wherePivot('context','pricing');
    }

     public function ownerRequirementsTender()
    {
        return $this->ownerRequirements()->wherePivot('context','tender');
    }

//     public function ownerRequirementsTender()
// {
//     return $this->belongsToMany(OwnerRequirement::class, 'project_owner_requirement')
//         ->withPivot(['quantity','unit_price','total_price','notes','context'])
//         ->wherePivot('context', 'tender');
// }


    public function designPreferences()
    {
        return $this->hasOne(ProjectDesignPreferences::class);
    }


    public function baladyaStatusType()
{
    return $this->belongsTo(\App\Models\BaladyaStatusType::class, 'baladya_status_type_id');
}






}
