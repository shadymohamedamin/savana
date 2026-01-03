<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrimaryData extends Model
{
    public $table = 'primary_datas';
    public $timestamps = false;
    protected $primaryKey = 'ID';
    protected $guarded = [];

    public $fillable = [
        'Accomodation',
        'Approved',
        'Cancel',
        'Career',
        'CareerAddress',
        'CaseDate',
        'DateOfBirth',
        'Email',
        'FamilyCount',
        'FileNo',
        'HeadRemarks',
        'HouseType',
        'IBAN',
        'IDExpiry',
        'IDNo',
        'InSchool',
        'LastUpdate',
        'MaritalStatus',
        'mob',
        'Nam',
        'NamEn',
        'Nationality',
        'Permission_Date',
        'Permission_No',
        'Region',
        'Renew_Date',
        'Revised',
        'Section',
        'Sex',
        'Tel1',
        'Tel2',
        'Trustee',
        'TrusteeEn',
        'UserAdd',
        'UserEdit',
        'WifeAddress',
        'WifeCareer',
        'WifeName',
        'WifeNationality',
        'request_status_user_id',
        'is_completed',
        'request_reply',
        'request_status',
        'request_custom_reply',
        'request_transfer_to_admin',
        'archieved',
        'deleted'
        //'Email'
    ];

    protected $casts = [
        'Accomodation' => 'boolean',
        'Approved' => 'boolean',
        'Cancel' => 'boolean',
        'CareerAddress' => 'string',
        'CaseDate' => 'datetime',
        'DateOfBirth' => 'datetime',
        'Email' => 'string',
        'HeadRemarks' => 'string',
        'IBAN' => 'string',
        'IDExpiry' => 'datetime',
        'IDNo' => 'string',
        'LastUpdate' => 'datetime',
        'mob' => 'string',
        'Nam' => 'string',
        'NamEn' => 'string',
        'Permission_Date' => 'datetime',
        'Renew_Date' => 'datetime',
        'Revised' => 'boolean',
        'Tel1' => 'string',
        'Tel2' => 'string',
        'Trustee' => 'string',
        'TrusteeEn' => 'string',
        'WifeAddress' => 'string',
        'WifeName' => 'string',
        'request_reply' => 'string',
        'request_status' => 'string',
        'request_custom_reply' => 'string',
        'request_transfer_to_admin' => 'boolean',
        'archieved' => 'boolean',
        'deleted' => 'boolean',
        

    ];

    public static array $rules = [
        'Accomodation' => 'nullable|boolean',
        'Approved' => 'nullable|boolean',
        'Cancel' => 'nullable|boolean',
        'Career' => 'nullable',
        'CareerAddress' => 'nullable|string|max:255',
        'CaseDate' => 'nullable',
        'DateOfBirth' => 'nullable',
        'Email' => 'nullable|string|max:255',
        'FamilyCount' => 'nullable',
        'FileNo' => 'nullable',
        'HeadRemarks' => 'nullable|string',
        'HouseType' => 'nullable',
        'IBAN' => 'nullable|string|max:255',
        'IDExpiry' => 'nullable',
        'IDNo' => 'nullable|string|max:255',
        'InSchool' => 'nullable',
        'LastUpdate' => 'nullable',
        'MaritalStatus' => 'nullable',
        'mob' => 'nullable|string|max:10',
        'Nam' => 'nullable|string|max:255',
        'NamEn' => 'nullable|string|max:255',
        'Nationality' => 'nullable',
        'Permission_Date' => 'nullable',
        'Permission_No' => 'nullable',
        'Region' => 'nullable',
        'Renew_Date' => 'required',
        'Revised' => 'nullable|boolean',
        'Section' => 'required',
        'Sex' => 'nullable',
        'Tel1' => 'nullable|string|max:100',
        'Tel2' => 'nullable|string|max:100',
        'Trustee' => 'nullable|string|max:255',
        'TrusteeEn' => 'nullable|string|max:255',
        'UserAdd' => 'nullable',
        'UserEdit' => 'nullable',
        'WifeAddress' => 'nullable|string|max:255',
        'WifeCareer' => 'nullable',
        'WifeName' => 'nullable|string|max:255',
        'WifeNationality' => 'nullable',
        'request_reply' => 'nullable',
        'request_status' => 'nullable',
        'request_custom_reply' => 'nullable',
        'request_transfer_to_admin' => 'nullable|boolean',
        'archieved' => 'nullable|boolean',
        'deleted' => 'nullable|boolean',
        
    ];

    public function career(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Career::class, 'Career', 'ID');
    }

    public function wifecareer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Career::class, 'WifeCareer', 'ID');
    }

    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Region::class, 'Region', 'ID');
    }

    public function housetype(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\HouseType::class, 'HouseType', 'ID');
    }

    public function wifenationality(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Nationalit::class, 'WifeNationality', 'ID');
    }

    public function sex(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Sex::class, 'Sex', 'ID');
    }

    public function maritalStatus(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\MaritalStatus::class, 'MaritalStatus', 'ID');
    }

    public function nationality(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Nationalit::class, 'Nationality', 'ID');
    }

    public function supports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Support::class, 'CaseID');
    }
    public function attachments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Attachment::class, 'CaseID');
    }
    public function userAdd() {
        return $this->belongsTo(User::class, 'UserAdd');
    }

    public function userEdit() {
        return $this->belongsTo(User::class, 'UserEdit');
    }
    public function userRequest() {
        return $this->belongsTo(User::class, 'request_status_user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'IDNo', 'uae_id');
    }

}