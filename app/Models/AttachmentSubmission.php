<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AttachmentSubmission extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $primaryKey = 'ID';
    public $table = 'attachments_submissions';
    public $timestamps = false;
    public $fillable = [
        'CaseID',
        'AttID',
        'AttPath',
        'Remarks',
        'uae_id'
        //'Preview',
        //'Delete'
    ];

    protected $casts = [
        'AttPath' => 'string',
        'Remarks' => 'string',
        'uae_id' =>'string'
        //'Preview' => 'string',
        //'Delete' => 'string'
    ];

    public static array $rules = [
        'CaseID' => 'required',
        'AttID' => 'required',
        'AttPath' => 'nullable|string|max:255',
        'Remarks' => 'nullable|string|max:255',
        'uae_id' => 'nullable'
        //'Preview' => 'nullable|string|max:10',
        //'Delete' => 'nullable|string|max:10'
    ];

    public function caseid(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'CaseID');
    }

    public function attid(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\AttachmentType::class, 'AttID','ID');
    }
}
