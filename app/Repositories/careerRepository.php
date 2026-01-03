<?php

namespace App\Repositories;

use App\Models\career;
use App\Repositories\BaseRepository;

class careerRepository extends BaseRepository
{
    protected $fieldSearchable = [
        
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return career::class;
    }
}
