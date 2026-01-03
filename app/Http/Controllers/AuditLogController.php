<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;

class AuditLogController extends Controller
{


    public function index1(Request $request)
    {
        $query = Audit::with('user');

        if ($request->filled('user')) {
            $query->whereHas('user', fn($q) =>
                $q->where('name', 'like', '%'.$request->user.'%')
            );
        }

        if ($request->filled('event')) {
            $query->where('event', $request->event);
        }

        if ($request->filled('from')) {
            $query->whereDate('created_at', '>=', $request->from);
        }

        if ($request->filled('to')) {
            $query->whereDate('created_at', '<=', $request->to);
        }

        $audits = $query->latest()->paginate(20)->appends($request->query());

        return view('admin.audit-logs', compact('audits'));
    }

    public function index()
    {
        $audits = Audit::latest()->paginate(10);
        return view('admin.audit-logs', compact('audits'));
    }
}
