<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportType extends Model
{
    public $table = 'support_types';

    public $fillable = [
        'SupportType',
        'SupportTypeEn'
    ];

    protected $casts = [
        'SupportType' => 'string',
        'SupportTypeEn' => 'string'
    ];

    public static array $rules = [
        'SupportType' => 'nullable|string|max:50',
        'SupportTypeEn' => 'nullable|string|max:50'
    ];

    public function supports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Support::class, 'SupportType','ID');
    }

    public function support1s(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Support::class, 'SupportRequiredArch','ID');
    }
}
