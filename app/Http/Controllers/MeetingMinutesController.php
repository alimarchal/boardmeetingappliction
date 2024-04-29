<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingMinutesRequest;
use App\Http\Requests\UpdateMeetingMinutesRequest;
use App\Models\Meeting;
use App\Models\MeetingMinutes;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MeetingMinutesController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [

            new Middleware('role_or_permission:meeting-minutes-access|meeting-minutes-edit|meeting-minutes-view|meeting-minutes-delete', only: ['index']),
            new Middleware('role_or_permission:meeting-minutes-edit', only: ['edit']),
            new Middleware('role_or_permission:meeting-minutes-view', only: ['show']),
            new Middleware('role_or_permission:meeting-minutes-delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meetingMinutes = MeetingMinutes::with('meeting')->get();
        return view('meeting-minutes.index', compact('meetingMinutes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $meetings = Meeting::all();
        return view('meeting-minutes.create', compact('meetings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeetingMinutesRequest $request)
    {

        if ($request->hasFile('path_attachment_file')) {
            $file_path = $request->file('path_attachment_file')->store('minutes_of_meeting', 'public');
            $request->merge(['path_attachment' => $file_path]);
        }
        $request->merge(['user_id' => auth()->user()->id]);
        MeetingMinutes::create($request->all());
        return redirect()->route('meeting-minutes.index')->with('success', 'Meeting minutes created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MeetingMinutes $meetingMinutes)
    {
        return view('meeting-minutes.show', compact('meetingMinutes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeetingMinutes $meetingMinutes)
    {

        $meetings = Meeting::all();
        return view('meeting-minutes.edit', compact('meetingMinutes', 'meetings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeetingMinutesRequest $request, MeetingMinutes $meetingMinutes)
    {
        $meetingMinutes->update($request->all());
        return redirect()->route('meeting-minutes.index')->with('success', 'Meeting minutes updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MeetingMinutes $meetingMinutes)
    {
        $meetingMinutes->delete();
        return redirect()->route('meeting-minutes.index')->with('success', 'Meeting minutes deleted successfully.');
    }
}
