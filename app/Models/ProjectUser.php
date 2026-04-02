<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    public $table = 'project_users';

    public $fillable = [
        'project_id',
        'user_id',
        'role_id',
        'structureElectro' ,
        'structureWithFinishes',
        'footWithout',
        'footWith',
        'boundaryWall',
        'villaWithWall',
        'vat',
        'finalTotal',
        'context',
        'status',
        'tender_status'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'project_id' => 'required',
        'user_id' => 'required',
        'role_id' => 'required',
        'status' =>'nullable',

        'structureElectro' => 'decimal:2',
        'structureWithFinishes' => 'decimal:2',
        'footWithout' => 'decimal:2',
        'footWith' => 'decimal:2',
        'boundaryWall' => 'decimal:2',
        'villaWithWall' => 'decimal:2',
        'vat' => 'decimal:2',
        'finalTotal' => 'decimal:2',
        'context' => 'nullable',

        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }

    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Role::class, 'role_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }



    
}
