<?php

namespace App\Repositories;

use App\Models\BaladyaStatusType;
use App\Repositories\BaseRepository;

class BaladyaStatusTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name_ar',
        'name_en',
        'active'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return BaladyaStatusType::class;
    }
}
