<?php

namespace App\Repositories;

use App\Models\ProjectScheduleApproval;
use App\Repositories\BaseRepository;

class ProjectScheduleApprovalRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'batch_id',
        'contractor_approved',
        'owner_approved',
        'consultant_approved'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectScheduleApproval::class;
    }
}
