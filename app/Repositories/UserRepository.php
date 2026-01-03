<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'Active',
        'RoleID',
        'name',
        'password',
        'email',
        'role',
        'email_verified_at',
        'remember_token',
        'is_admin'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return User::class;
    }
    public function create($input)
    {
        return $this->model->create($input);
    }
}
