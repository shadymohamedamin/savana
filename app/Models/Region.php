<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public $table = 'regions';

    public $fillable = [
        'Region'
    ];

    protected $casts = [
        'Region' => 'string'
    ];

    public static array $rules = [
        'Region' => 'nullable|string|max:50'
    ];

    public function primaryDatas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PrimaryData::class, 'Region');
    }
}
