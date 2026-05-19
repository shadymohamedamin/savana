<?php

namespace App\Repositories;

use App\Models\SupervisionType;
use App\Repositories\BaseRepository;

class SupervisionTypeRepository extends BaseRepository
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
        return SupervisionType::class;
    }
}
