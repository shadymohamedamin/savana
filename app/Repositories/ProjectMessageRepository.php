<?php

namespace App\Repositories;

use App\Models\ProjectMessage;
use App\Repositories\BaseRepository;

class ProjectMessageRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'project_id',
        'sender_id',
        'receiver_id',
        'cc_user_id',
        'message_type_id',
        'message',
        'attachment'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return ProjectMessage::class;
    }
}
