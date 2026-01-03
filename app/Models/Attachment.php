<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Attachment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $primaryKey = 'id';
    public $table = 'attachments';
    public $timestamps = false;
    protected $fillable = [
        'attachable_id',
        'attachable_type',
        'attachment_type_id',
        'file_name',
        'file_type',
        'notes',
        'AttPath',
    ];


    protected $casts = [
        'expiration_date' => 'date',
        'is_expired' => 'boolean',
        //'AttPath' => 'string',
        //'Remarks' => 'string',
        //'uae_id' => 'string'
        //'Preview' => 'string',
        //'Delete' => 'string'
    ];

    public static array $rules = [
        //'CaseID' => 'required',
        //'AttID' => 'required',
        //'AttPath' => 'nullable|string|max:255',
        //'Remarks' => 'nullable|string|max:255',
        //'uae_id' => 'nullable|string'
        //'Preview' => 'nullable|string|max:10',
        //'Delete' => 'nullable|string|max:10'
    ];

    /*public function caseid(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'CaseID');
    }

    public function attid(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\AttachmentType::class, 'AttID','ID');
    }*/
    public function attachable()
    {
        return $this->morphTo();
    }
    public function type()
    {
        return $this->belongsTo(AttachmentType::class, 'attachment_type_id');
    }
    
}
