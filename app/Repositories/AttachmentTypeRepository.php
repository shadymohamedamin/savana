<?php

namespace App\Repositories;

use App\Models\AttachmentType;
use App\Repositories\BaseRepository;

class AttachmentTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'AttType',
        'Prefix',
        'MaxSizeKB'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return AttachmentType::class;
    }
}
