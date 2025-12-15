<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log(string $description)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'description' => $description,
            'log_date' => now(),
        ]);
    }
}