<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AttachmentType extends Model
{
    protected $table = 'attachment_types';

    // لو اسم العمود id صغير
    protected $primaryKey = 'id';

    protected $fillable = [
        'name_ar',
        'name_en',
        'MaxSizeKB',
        'active',
    ];

    protected $casts = [
        'name_ar'   => 'string',
        'name_en'   => 'string',
        'MaxSizeKB' => 'integer',
        'active'    => 'boolean',
    ];

    /* ===========================
       Relationships
    =========================== */

    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class, 'attachment_type_id', 'id');
    }
}


    //public function attachments(): \Illuminate\Database\Eloquent\Relations\HasMany
   // {
    //    return $this->hasMany(\App\Models\Attachment::class, 'AttID','ID');
   /// }
//}
