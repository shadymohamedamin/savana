<?php

namespace App\Repositories;

use App\Models\HouseType;
use App\Repositories\BaseRepository;

class HouseTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'HouseType'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return HouseType::class;
    }
}
