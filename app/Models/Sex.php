<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    public $table = 'sexes';

    public $fillable = [
        'Sex'
    ];

    protected $casts = [
        'Sex' => 'string'
    ];

    public static array $rules = [
        'Sex' => 'nullable|string|max:50'
    ];

    public function primaryDatas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PrimaryData::class, 'Sex');
    }
}
