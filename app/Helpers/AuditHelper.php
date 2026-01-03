<?php

namespace App\Helpers;

use OwenIt\Auditing\Models\Audit;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
class AuditHelper
{
    public static function logAudit($event, $auditable, array $oldValues = [], array $newValues = [], $tags = 'manual')
    {
        $user = Auth::user();

        // Check if user exists and is a valid Eloquent model
        $userType = $user instanceof Model ? get_class($user) : null;
        $userId = $user instanceof Model ? $user->getKey() : null;

        Audit::create([
            'user_type'      => $userType,
            'user_id'        => $userId,
            'event'          => $event,
            'auditable_type' => is_object($auditable) ? get_class($auditable) : $auditable,
            'auditable_id'   => is_object($auditable) ? ($auditable->id ?? $auditable->ID ?? null) : null,
            'old_values'     => $oldValues,
            'new_values'     => $newValues,
            'url'            => Request::fullUrl(),
            'ip_address'     => Request::ip(),
            'user_agent'     => Request::userAgent(),
            'tags'           => $tags,
        ]);
    }
}
