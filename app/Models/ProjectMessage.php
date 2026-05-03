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
        'subject',
        'message',
        'attachment',
        'readed',
        'parent_id'
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
        'updated_at' => 'nullable',
        'parent_id' => 'nullable|exists:project_messages,id',
    ];




// الرسالة الأب
public function parent()
{
    return $this->belongsTo(ProjectMessage::class, 'parent_id');
}

// الردود
public function replies()
{
    return $this->hasMany(ProjectMessage::class, 'parent_id')->orderBy('created_at');
}



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
