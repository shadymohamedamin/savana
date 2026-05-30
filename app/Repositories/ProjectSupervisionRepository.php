<?php

namespace App\Repositories;

use App\Models\ProjectSupervision;
use App\Repositories\BaseRepository;

class ProjectSupervisionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'user_id',
        'supervision_type_id',
        'note',
        'attachment'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectSupervision::class;
    }
}
