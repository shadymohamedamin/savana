<?php

namespace App\Repositories;

use App\Models\ProjectUser;
use App\Repositories\BaseRepository;

class ProjectUserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'user_id',
        'role_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectUser::class;
    }
}
