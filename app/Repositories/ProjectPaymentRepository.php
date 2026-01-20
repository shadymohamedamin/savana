<?php

namespace App\Repositories;

use App\Models\ProjectPayment;
use App\Repositories\BaseRepository;

class ProjectPaymentRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'payment_no',
        'payer_type',
        'total_amount',
        'vat_amount',
        'net_amount',
        'payment_date',
        'attachment'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectPayment::class;
    }
}
