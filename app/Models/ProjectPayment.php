<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectPayment extends Model
{
    public $table = 'project_payments';

    public $fillable = [
        'project_id',
        'payment_no',
        'payer_type',
        'total_amount',
        'vat_amount',
        'net_amount',
        'payment_date',
        'attachment',
        'attachment_2',   // الملف الثاني
        'attachment_3',   // الملف الثالث
    ];

    protected $casts = [
        'payer_type' => 'string',
        'total_amount' => 'decimal:2',
        'vat_amount' => 'decimal:2',
        'net_amount' => 'decimal:2',
        'payment_date' => 'date',
        'attachment' => 'string'
    ];

    public static array $rules = [
        'project_id' => 'required',
        'payment_no' => 'required',
        'payer_type' => 'nullable|string|max:255',
        'total_amount' => 'required|numeric',
        'vat_amount' => 'required|numeric',
        'net_amount' => 'required|numeric',
        'payment_date' => 'nullable',
        'attachment' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }
}
