<?php

namespace App\Repositories;

use App\Models\MaritalStatus;
use App\Repositories\BaseRepository;

class MaritalStatusRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'MaritalStatus'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return MaritalStatus::class;
    }
}
