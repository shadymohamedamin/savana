<?php

namespace App\Repositories;

use App\Models\BaladyaApproval;
use App\Repositories\BaseRepository;

class BaladyaApprovalRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'owner_id',
        'status_type_id',
        'case_number',
        'opened_at',
        'approved_at',
        'days_diff',
        'reason'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return BaladyaApproval::class;
    }
}
