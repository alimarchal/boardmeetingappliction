<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Models\Meeting;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class MeetingController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [

            new Middleware('role_or_permission:meetings-access|meeting-view|meeting-edit', only: ['index']),
            new Middleware('role_or_permission:meeting-edit', only: ['edit']),
            new Middleware('role_or_permission:meeting-view', only: ['show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meetings = null;
        if (Auth::user()->hasRole(['Super-Admin', 'Company Secretary'])) {
            $meetings = QueryBuilder::for(Meeting::class)
                ->allowedFilters(['id', 'title', 'description', 'path_attachment', AllowedFilter::exact('meeting_status')])
//                ->with('comments')
                ->orderByDesc('id')
                ->get();
        } else {
            $meetings = QueryBuilder::for(Meeting::class)
                ->allowedFilters(['id', 'title', 'description', 'path_attachment',AllowedFilter::exact('meeting_status')])
                ->where('status','Unlock')
//                ->with('comments')
                ->orderByDesc('id')
                ->get();
        }

        return view('meetings.index', compact('meetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meetings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMeetingRequest $request)
    {
        if ($request->hasFile('path_attachment_file')) {
            $profile_path = $request->file('path_attachment_file')->store('meeting_main_attachment', 'public');
            $request->merge(['path_attachment' => $profile_path]);
        }



        $meeting_status = "Digital";
        if ($request->me_id <= 75) {
            $meeting_status = "Manual";
        }

        $request->merge(['user_id' => auth()->user()->id, 'meeting_status' => $meeting_status]);
        $meeting = Meeting::create($request->all());
        session()->flash('success', 'Your meeting record has been successfully created.');
        return to_route('meeting.show', $meeting->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        $auth_id = auth()->user()->id;
        return view('meetings.show', compact('meeting','auth_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        return view('meetings.edit', compact('meeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {

        if ($request->hasFile('path_attachment_file')) {
            $profile_path = $request->file('path_attachment_file')->store('meeting_main_attachment', 'public');
            $request->merge(['path_attachment' => $profile_path]);
        }
        $meeting->update($request->all());
        session()->flash('success', 'Your meeting record has been successfully updated.');
        return to_route('meeting.show', $meeting->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        $meeting->delete();
        session()->flash('success', 'Your meeting record has been successfully deleted.');
        return to_route('meeting.index');
    }
}
