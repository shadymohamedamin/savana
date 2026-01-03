<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    public $table = 'alerts';
    protected $primaryKey = 'ID';

    public $fillable = [
        'SenderID',
        'ReceiverID',
        'AlertMsg',
        'AlertDate',
        'ReadStatus'
    ];

    protected $casts = [
        'AlertMsg' => 'string',
        'AlertDate' => 'datetime',
        'ReadStatus' => 'boolean'
    ];

    public static array $rules = [
        'SenderID' => 'required',
        'ReceiverID' => 'required',
        'AlertMsg' => 'nullable|string',
        'AlertDate' => 'required',
        'ReadStatus' => 'nullable|boolean'
    ];

    public function receiverid(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'ReceiverID');
    }

    public function senderid(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'SenderID');
    }
}
