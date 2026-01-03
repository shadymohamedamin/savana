<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaritalStatus extends Model
{
    public $table = 'marital_statuses';

    public $fillable = [
        'MaritalStatus'
    ];

    protected $casts = [
        'MaritalStatus' => 'string'
    ];

    public static array $rules = [
        'MaritalStatus' => 'nullable|string|max:30'
    ];

    public function primaryDatas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PrimaryData::class, 'MaritalStatus');
    }
}
