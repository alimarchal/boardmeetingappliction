<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommitteeMeetingRequest;
use App\Http\Requests\UpdateCommitteeMeetingRequest;
use App\Models\CommitteeMeeting;
use App\Models\CommitteeMeetingAgendaItem;

class CommitteeMeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $committeeMeetings = CommitteeMeeting::all();
        return view('CommitteeMeeting.index', compact('committeeMeetings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CommitteeMeeting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommitteeMeetingRequest $request)
    {
        $meeting = CommitteeMeeting::create([
            'user_id' => auth()->id(), // Assuming you are using Laravel's built-in authentication
            ...$request->all() // Spread the request data
        ]);

        return redirect()->route('committee_meeting.index')->with('success', 'Committee Meeting created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommitteeMeeting $committeeMeeting)
    {
        return view('CommitteeMeeting.show', compact('committeeMeeting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommitteeMeeting $committeeMeeting)
    {
        return view('CommitteeMeeting.edit', compact('committeeMeeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommitteeMeetingRequest $request, CommitteeMeeting $committeeMeeting)
    {
        $committeeMeeting->update($request->all());
        return redirect()->route('committee_meeting.index')->with('success', 'Committee Meeting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommitteeMeeting $committeeMeeting)
    {
        $committeeMeeting->delete();
        return redirect()->route('committee_meeting.index')->with('success', 'Committee Meeting deleted successfully.');
    }
}