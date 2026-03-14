<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerRequirmentTenderTotal extends Model
{
    // اسم الجدول
    protected $table = 'owner_requirements_tenders_totals';

    // الحقول القابلة للملء
    protected $fillable = [
        'project_id',
        'tender_user_id',
        'structureElectro',
        'structureWithFinishes',
        'footWithout',
        'footWith',
        'boundaryWall',
        'villaWithWall',
        'vat',
        'finalTotal',
        //'context'  // لو انت تبعت context من الفورم
    ];

    // تحويل نوع البيانات
    protected $casts = [
        'structureElectro' => 'decimal:2',
        'structureWithFinishes' => 'decimal:2',
        'footWithout' => 'decimal:2',
        'footWith' => 'decimal:2',
        'boundaryWall' => 'decimal:2',
        'villaWithWall' => 'decimal:2',
        'vat' => 'decimal:2',
        'finalTotal' => 'decimal:2',
        'context' => 'string',
        'project_id' => 'integer',
        'tender_user_id' => 'integer',
    ];

    // القواعد
    public static array $rules = [
        'project_id' => 'required|integer|exists:projects,id',
        'tender_user_id' => 'nullable|integer|exists:users,id',
        'structureElectro' => 'required|numeric',
        'structureWithFinishes' => 'required|numeric',
        'footWithout' => 'required|numeric',
        'footWith' => 'required|numeric',
        'boundaryWall' => 'required|numeric',
        'villaWithWall' => 'required|numeric',
        'vat' => 'required|numeric',
        'finalTotal' => 'required|numeric',
        //'context' => 'required|string|max:255'
    ];

    // العلاقات
    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class, 'project_id');
    }

    public function tenderUser()
    {
        return $this->belongsTo(\App\Models\User::class, 'tender_user_id');
    }
}