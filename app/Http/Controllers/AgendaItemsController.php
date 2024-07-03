<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgendaItemsRequest;
use App\Http\Requests\UpdateAgendaItemsRequest;
use App\Models\AgendaItems;
use App\Models\Meeting;

class AgendaItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendaItems = AgendaItems::with('meeting')->get();
        return view('agenda-items.index', compact('agendaItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $meetings = Meeting::all();
        return view('agenda-items.create', compact('meetings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAgendaItemsRequest $request, Meeting $meeting)
    {
        $validated = $request->validate([
            'meeting_id' => 'required|exists:meetings,id',
            'title' => 'required',
            'description' => 'required',
            'order' => 'required',
        ]);

        if ($request->hasFile('path_attachment_file')) {
            $file_path = $request->file('path_attachment_file')->store('meeting_agenda_item', 'public');
            $request->merge(['path_attachment' => $file_path]);
        }
        $request->merge(['user_id' => auth()->user()->id]);
        $agenda_item = AgendaItems::create($request->all());
        return to_route('meeting.show', $meeting->id)->with('success', 'Agenda item created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting, AgendaItems $agendaItems)
    {
        $auth_id = auth()->user()->id;
        return view('agenda-items.show', compact('agendaItems','meeting','auth_id'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting, AgendaItems $agendaItems)
    {
        return view('agenda-items.edit', compact('agendaItems', 'meeting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendaItemsRequest $request, Meeting $meeting, AgendaItems $agendaItems)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'order' => 'required|integer',
        ]);

        $request->merge(['user_id' => auth()->user()->id]);
        $agendaItems->update($request->all());

        return to_route('meeting.agenda-item.show',[$agendaItems->meeting_id, $agendaItems->id])->with('success', 'Agenda item updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting, AgendaItems $agendaItems)
    {
        $agendaItems->delete();
        return to_route('meeting.show', $meeting->id)->with('success', 'Agenda item has been deleted successfully.');

    }
}
