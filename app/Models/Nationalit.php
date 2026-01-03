<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationalit extends Model
{
    public $table = 'nationalits';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    public $fillable = [
        'Nationality'
    ];

    protected $casts = [
        'Nationality' => 'string'
    ];

    public static array $rules = [
        'Nationality' => 'nullable|string|max:100'
    ];

    public function primaryDatas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PrimaryData::class, 'WifeNationality');
    }

    public function primaryData1s(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\PrimaryData::class, 'Nationality');
    }
}
