<?php

namespace App\Repositories;

use App\Models\MessageType;
use App\Repositories\BaseRepository;

class MessageTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name_ar',
        'name_en',
        'active'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return MessageType::class;
    }
}
