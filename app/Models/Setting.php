<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $table = 'settings';

    public $fillable = [
        'key',
        'value'
    ];

    protected $casts = [
        'key' => 'string',
        'value' => 'string'
    ];

    public static array $rules = [
        'key' => 'required|string|max:100',
        'value' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
