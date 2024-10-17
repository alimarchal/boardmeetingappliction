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
     */
    public function store(StoreCommitteeMeetingAgendaItemRequest $request)
    {
        $agendaItem = new CommitteeMeetingAgendaItem($request->all());
        $committeeMeeting->agendaItems()->save($agendaItem);
        return redirect()->route('committee_meetings.show', $committeeMeeting->id)->with('success', 'Agenda Item added successfully.');
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
        return view('committee_meeting_agenda_items.edit', compact('committeeMeeting', 'agendaItem'));
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
