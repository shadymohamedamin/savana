<?php

namespace App\Repositories;

use App\Models\ProjectStage;
use App\Repositories\BaseRepository;

class ProjectStageRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name_ar',
        'name_en',
        'order',
        'active'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectStage::class;
    }
}
