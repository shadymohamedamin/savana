<?php

namespace App\Repositories;

use App\Models\ProjectName;
use App\Repositories\BaseRepository;

class ProjectNameRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name_ar',
        'name_en',
        'status'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectName::class;
    }
}
