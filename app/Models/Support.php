<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    public $table = 'supports';
    public $timestamps = false;

    public $fillable = [
        'Dat',
        'CaseID',
        'SupportRequiredArch',
        'SupportType',
        'NeedِAmount',
        'SupportAmount',
        'Note',
        'SalaryArch',
        'IncomeArch',
        'WifeSalaryArch',
        'OfflineSalaryArch',
        'SocialSalaryArch',
        'OtherSalaryArch',
        'ChildrenInArch',
        'LoanArch',
        'RentArch',
        'DriverArch',
        'FeesArch',
        'ServantArch',
        'EleWaterArch',
        'HouseArch',
        'BankArch',
        'FurnatureArch',
        'CarArch',
        'CourtArch',
        'ChildrenOutArch',
        'SearcherArch',
        'CaseDescription',
        'Application_Date',
        'AppRemarks',
        'request_reply',
        'request_status',
        'request_custom_reply',
        'archieved',
        'deleted',
        'uae_id'
    ];

    protected $casts = [
        'Dat' => 'datetime',
        'Note' => 'string',
        'CaseDescription' => 'string',
        'Application_Date' => 'datetime',
        'AppRemarks' => 'string',
        'request_reply' => 'string',
        'request_status' => 'string',
        'request_custom_reply' => 'string',
        'archieved' => 'boolean',
        'deleted' => 'boolean',
        'uae_id' => 'string'
    ];

    public static array $rules = [
        'Dat' => 'nullable',
        'CaseID' => 'nullable',
        'SupportRequiredArch' => 'required',
        'SupportType' => 'required',
        'NeedAmount' => 'nullable',
        'SupportAmount' => 'nullable',
        'Note' => 'nullable|string',
        'SalaryArch' => 'nullable',
        'IncomeArch' => 'nullable',
        'WifeSalaryArch' => 'nullable',
        'OfflineSalaryArch' => 'nullable',
        'SocialSalaryArch' => 'nullable',
        'OtherSalaryArch' => 'nullable',
        'ChildrenInArch' => 'nullable',
        'LoanArch' => 'nullable',
        'RentArch' => 'nullable',
        'DriverArch' => 'nullable',
        'FeesArch' => 'nullable',
        'ServantArch' => 'nullable',
        'EleWaterArch' => 'nullable',
        'HouseArch' => 'nullable',
        'BankArch' => 'nullable',
        'FurnatureArch' => 'nullable',
        'CarArch' => 'nullable',
        'CourtArch' => 'nullable',
        'ChildrenOutArch' => 'nullable',
        'SearcherArch' => 'nullable',
        'CaseDescription' => 'required',
        'Application_Date' => 'required',
        'AppRemarks' => 'required',
        'request_reply' => 'nullable',
        'request_status' => 'nullable',
        'request_custom_reply' => 'nullable',
        'archieved' => 'nullable|boolean',
        'deleted' => 'nullable|boolean',
        'uae_id' => 'nullable'
    ];

    public function caseid(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\PrimaryData::class, 'CaseID');
    }

    public function supporttype(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\SupportType::class, 'SupportType','ID');
    }

    public function searcherarch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'SearcherArch');
    }

    public function supportrequiredarch(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\SupportType::class, 'SupportRequiredArch','ID');
    }
}
