<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSupervision extends Model
{
    public $table = 'project_supervisions';

    public $fillable = [
        'project_id',
        'user_id',
        'supervision_type_id',
        'note',
        'attachment',
    'attachment_note',

    'attachment1',
    'attachment1_note',

    'attachment2',
    'attachment2_note',

    'attachment3',
    'attachment3_note',
    ];

    protected $casts = [
        'note' => 'string',
        'attachment' => 'string'
    ];

    public static array $rules = [
        'project_id' => 'required',
        'user_id' => 'required',
        'supervision_type_id' => 'required',
        'note' => 'nullable|string|max:65535',
        'attachment' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }

    public function supervisionType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\SupervisionType::class, 'supervision_type_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }



    public function attachments()
    {
        return $this->morphMany(
            \App\Models\Attachment::class,
            'attachable'
        );
    }

}
