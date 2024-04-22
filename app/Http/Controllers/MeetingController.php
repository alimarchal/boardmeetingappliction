<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Models\Meeting;
use Spatie\QueryBuilder\QueryBuilder;

class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meetings = QueryBuilder::for(Meeting::class)
            ->allowedFilters(['id','title', 'description', 'path_attachment'])
            ->orderByDesc('id')
            ->get();

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
        $request->merge(['user_id' => auth()->user()->id]);
        $meeting = Meeting::create($request->all());
        session()->flash('success', 'Your meeting record has been successfully created.');
        return to_route('meeting.show', $meeting->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        return view('meetings.show', compact('meeting'));
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
        //
    }
}
