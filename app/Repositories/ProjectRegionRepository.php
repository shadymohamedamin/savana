<?php

namespace App\Repositories;

use App\Models\ProjectRegion;
use App\Repositories\BaseRepository;

class ProjectRegionRepository extends BaseRepository
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
        return ProjectRegion::class;
    }
}
