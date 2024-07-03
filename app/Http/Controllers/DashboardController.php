<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $lock_unlock_chart_data = ['Lock' => Meeting::where('status','Lock')->count(), 'Un-Lock' => Meeting::where('status','Unlock')->count()];
        $sixMonthsAgo = now()->subMonths(6)->startOfMonth();

        $meetingCounts = DB::table('meetings')
            ->selectRaw('YEAR(date_and_time) as year, MONTH(date_and_time) as month, COUNT(*) as count')
            ->where('date_and_time', '>=', $sixMonthsAgo)
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        return view('dashboard', compact('lock_unlock_chart_data', 'meetingCounts'));
    }
}
