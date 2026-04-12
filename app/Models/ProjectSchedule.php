<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectSchedule extends Model
{
    public $table = 'project_schedules';

    public $fillable = [
        'project_id',
        'item_no',
        'title',
        'payment_percentage',
        'completion_percentage',
        'duration_days',
        'amount',
        'notes',
        'due_date',
        'target_percentage',
        'start_date'
    ];

    protected $casts = [
        'title' => 'string',
        'notes' => 'string',
        'due_date' => 'date'
    ];

    public static array $rules = [
        'project_id' => 'required',
        'item_no' => 'nullable',
        'title' => 'nullable|string|max:255',
        'payment_percentage' => 'nullable',
        'completion_percentage' => 'nullable',
        'duration_days' => 'nullable',
        'amount' => 'nullable',
        'notes' => 'nullable|string|max:65535',
        'due_date' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}
