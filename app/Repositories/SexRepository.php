<?php

namespace App\Repositories;

use App\Models\Sex;
use App\Repositories\BaseRepository;

class SexRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'Sex'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Sex::class;
    }
}
