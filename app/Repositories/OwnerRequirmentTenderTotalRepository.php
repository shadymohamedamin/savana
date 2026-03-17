<?php

namespace App\Repositories;

use App\Models\OwnerRequirmentTenderTotal;
use App\Repositories\BaseRepository;

class OwnerRequirmentTenderTotalRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'owner_requirement_id',
        'quantity',
        'unit_price',
        'total_price',
        'notes',
        'context',
        'tender_user_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return OwnerRequirmentTenderTotal::class;
    }
}
