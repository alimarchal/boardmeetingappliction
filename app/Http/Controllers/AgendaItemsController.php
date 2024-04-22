<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAgendaItemsRequest;
use App\Http\Requests\UpdateAgendaItemsRequest;
use App\Models\AgendaItems;

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
    public function store(StoreAgendaItemsRequest $request)
    {
        $validated = $request->validate([
            'meeting_id' => 'required|exists:meetings,id',
            'title' => 'required',
            'description' => 'required',
            'order' => 'required|integer',
        ]);

        AgendaItems::create($validated);
        return redirect()->route('agenda-items.index')->with('success', 'Agenda item created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(AgendaItems $agendaItem)
    {
        return view('agenda-items.show', compact('agendaItem'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AgendaItems $agendaItems)
    {
        $meetings = Meeting::all();
        return view('agenda-items.edit', compact('agendaItem', 'meetings'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAgendaItemsRequest $request, AgendaItems $agendaItems)
    {
        $validated = $request->validate([
            'meeting_id' => 'required|exists:meetings,id',
            'title' => 'required',
            'description' => 'required',
            'order' => 'required|integer',
        ]);

        $agendaItems->update($validated);
        return redirect()->route('agenda-items.index')->with('success', 'Agenda item updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AgendaItems $agendaItems)
    {
        $agendaItems->delete();
        return redirect()->route('agenda-items.index')->with('success', 'Agenda item deleted successfully.');

    }
}
