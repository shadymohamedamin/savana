<?php

namespace App\Repositories;

use App\Models\ProjectOwnerRequirement;
use App\Repositories\BaseRepository;

class ProjectOwnerRequirementRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'owner_requirement_id',
        'quantity'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectOwnerRequirement::class;
    }
}
