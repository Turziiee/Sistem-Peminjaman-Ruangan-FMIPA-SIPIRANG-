<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $activities = ActivityLog::with('user')
            ->orderBy('log_date', 'desc')
            ->paginate(5);

        return view('admin.activity.index', compact('activities'));
    }
}