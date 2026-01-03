<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HouseType extends Model
{
    public $table = 'house_types';

    public $fillable = [
        'HouseType'
    ];

    protected $casts = [
        'HouseType' => 'string'
    ];

    public static array $rules = [
        'HouseType' => 'nullable|string|max:50'
    ];

    public function primaryDatas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PrimaryData::class, 'HouseType');
    }
}
