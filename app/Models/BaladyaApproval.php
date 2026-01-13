<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaladyaApproval extends Model
{
    public $table = 'baladya_approvals';

    public $fillable = [
        'project_id',
        'owner_id',
        'status_type_id',
        'case_number',
        'opened_at',
        'approved_at',
        'days_diff',
        'reason',
        'approved_file',
    ];

    protected $casts = [
        'case_number' => 'string',
        'opened_at' => 'date',
        'approved_at' => 'date',
        'reason' => 'string'
    ];

    public static array $rules = [
        'project_id' => 'required',
        'owner_id' => 'nullable',
        'status_type_id' => 'required',
        'case_number' => 'required|string|max:255',
        'opened_at' => 'required',
        'approved_at' => 'nullable',
        'days_diff' => 'nullable',
        'reason' => 'nullable|string|max:65535',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function statusType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\BaladyaStatusType::class, 'status_type_id');
    }


    public function owner(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'owner_id');
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
    //public function project()
    //{
    //    return $this->belongsTo(Project::class);
    //}
    protected static function booted()
    {
        static::saving(function ($row) {
            if ($row->opened_at && $row->approved_at) {
                $row->days_diff =
                    $row->opened_at->diffInDays($row->approved_at);
            }
        });

        static::saved(function ($row) {
            // 🔥 Sync last case number to projects table
            $row->project()->update([
                'case_id_number' => $row->case_number
            ]);
        });
    }
}
