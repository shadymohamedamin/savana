<?php

namespace App\Repositories;

use App\Models\ProjectSchedule;
use App\Repositories\BaseRepository;

class ProjectScheduleRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'item_no',
        'title',
        'payment_percentage',
        'completion_percentage',
        'duration_days',
        'amount',
        'notes',
        'due_date'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectSchedule::class;
    }
}
