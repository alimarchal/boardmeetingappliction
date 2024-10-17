<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommitteeMeetingAgendaItemRequest;
use App\Http\Requests\UpdateCommitteeMeetingAgendaItemRequest;
use App\Models\CommitteeMeetingAgendaItem;

class CommitteeMeetingAgendaItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */public function store(StoreCommitteeMeetingAgendaItemRequest $request, $committeeMeetingId)
{
    // Create a new agenda item and associate it with the committee meeting
    $agendaItem = new CommitteeMeetingAgendaItem();

    // Populate the fields based on the request
    $agendaItem->title = $request->title;
    $agendaItem->description = $request->description; // Use the actual description from the request
    $agendaItem->committee_meeting_id = $committeeMeetingId; // Set the committee meeting ID
    $agendaItem->order = $request->order; // Assuming order is part of your request
    $agendaItem->user_id = auth()->id(); // Get the authenticated user's ID

    // Save the agenda item
    $agendaItem->save();

    return redirect()->route('committee_meeting.show', $committeeMeetingId)
                     ->with('success', 'Agenda Item added successfully.');
}



    /**
     * Display the specified resource.
     */
    public function show(CommitteeMeetingAgendaItem $committeeMeetingAgendaItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommitteeMeetingAgendaItem $committeeMeetingAgendaItem)
    {
        return view('committee_meeting_agenda_items.edit', data: compact('committeeMeeting', 'agendaItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommitteeMeetingAgendaItemRequest $request, CommitteeMeetingAgendaItem $committeeMeetingAgendaItem)
    {
        $agendaItem->update($request->all());
        return redirect()->route('committee_meetings.show', $committeeMeeting->id)->with('success', 'Agenda Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommitteeMeetingAgendaItem $committeeMeetingAgendaItem)
    {
        $agendaItem->delete();
        return redirect()->route('committee_meetings.show', $committeeMeeting->id)->with('success', 'Agenda Item deleted successfully.');
    }
}