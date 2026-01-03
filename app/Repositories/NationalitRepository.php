<?php

namespace App\Repositories;

use App\Models\Nationalit;
use App\Repositories\BaseRepository;

class NationalitRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'Nationality'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Nationalit::class;
    }
}
