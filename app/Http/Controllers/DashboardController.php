<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DashboardController extends Controller
{
    public function dashboard()
    {


//        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

//        Permission::create(['name' => 'view all committee meetings', 'guard_name' => 'web']);
//        Permission::create(['name' => 'view own committee meetings', 'guard_name' => 'web']);
//        Permission::create(['name' => 'view member committee meetings', 'guard_name' => 'web']);
//        Permission::create(['name' => 'create committee meetings', 'guard_name' => 'web']);
//        Permission::create(['name' => 'edit committee meetings', 'guard_name' => 'web']);
//        Permission::create(['name' => 'delete committee meetings', 'guard_name' => 'web']);


//
//
//        Role::create(['name' => 'DH and Committee Secretary','guard_name' => 'web']);
//
//        // Reset cached roles and permissions
//        app()[PermissionRegistrar::class]->forgetCachedPermissions();


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
