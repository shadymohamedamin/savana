<?php

namespace App\Repositories;

use App\Models\SupportType;
use App\Repositories\BaseRepository;

class SupportTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'SupportType',
        'SupportTypeEn'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return SupportType::class;
    }
}
