<?php

namespace App\Repositories;

use App\Models\Support;
use App\Repositories\BaseRepository;

class SupportRepository extends BaseRepository
{
    protected $fieldSearchable = [
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
        'AppRemarks'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Support::class;
    }
}
