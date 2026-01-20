<?php

namespace App\Repositories;

use App\Models\OwnerRequirement;
use App\Repositories\BaseRepository;

class OwnerRequirementRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'floor',
        'is_general'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return OwnerRequirement::class;
    }
}
