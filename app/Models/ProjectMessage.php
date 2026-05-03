<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectMessage extends Model
{
    public $table = 'project_messages';

    public $fillable = [
        'project_id',
        'sender_id',
        'receiver_id',
        'cc_user_id',
        'message_type_id',
        'message',
        'attachment'
    ];

    protected $casts = [
        'message' => 'string',
        'attachment' => 'string'
    ];

    public static array $rules = [
        'project_id' => 'required',
        'sender_id' => 'required',
        'receiver_id' => 'required',
        'cc_user_id' => 'nullable',
        'message_type_id' => 'required',
        'message' => 'required|string|max:65535',
        'attachment' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];








    public function ccUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'cc_user_id');
    }

    public function receiver(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'receiver_id');
    }

    public function messageType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\MessageType::class, 'message_type_id');
    }

    public function sender(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'sender_id');
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}
