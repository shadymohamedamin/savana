<?php

namespace App\Repositories;

use App\Models\Alert;
use App\Repositories\BaseRepository;

class AlertRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'SenderID',
        'ReceiverID',
        'AlertMsg',
        'AlertDate',
        'ReadStatus'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Alert::class;
    }
}
