<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaladyaStatusType extends Model
{
    public $table = 'baladya_status_types';

    public $fillable = [
        'name_ar',
        'name_en',
        'active'
    ];

    protected $casts = [
        'name_ar' => 'string',
        'name_en' => 'string',
        'active' => 'boolean'
    ];

    public static array $rules = [
        'name_ar' => 'required|string|max:255',
        'name_en' => 'nullable|string|max:255',
        'active' => 'required|boolean',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function baladyaApprovals(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\BaladyaApproval::class, 'status_type_id');
    }
}
