<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('role_or_permission:attendance-access|attendance-edit|attendance-delete', only: ['index']),
            new Middleware('role_or_permission:attendance-edit', only: ['edit']),
            new Middleware('role_or_permission:attendance-show', only: ['show']),
            new Middleware('role_or_permission:attendance-delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = null;
        if (Auth::user()->hasRole(['Super-Admin', 'Company Secretary'])) {
            $attendances = Attendance::with(['meeting', 'user'])->get();
        } else {
            $attendances = Attendance::where('user_id', Auth::user()->id)->with(['meeting', 'user'])->get();
        }

        return view('attendance.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $meetings = Meeting::all();
        $users = User::all();
        return view('attendance.create', compact('meetings', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttendanceRequest $request)
    {
        Attendance::create($request->all());
        return redirect()->route('attendance.index')->with('success', 'Attendance record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        return view('attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        $meetings = Meeting::all();
        $users = User::all();
        return view('attendance.edit', compact('attendance', 'meetings', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {

        $attendance->update($request->all());
        return redirect()->route('attendance.index')->with('success', 'Attendance record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Attendance record deleted successfully.');
    }
}
