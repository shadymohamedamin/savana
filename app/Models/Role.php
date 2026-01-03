<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $table = 'roles';

    public $fillable = [
        'Role'
    ];

    protected $casts = [
        'Role' => 'string'
    ];

    public static array $rules = [
        'Role' => 'nullable|string|max:255'
    ];

    public function pages(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Page::class, 'permissionss');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\User::class, 'RoleID');
    }
}
