<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\AgendaItems;
use App\Models\Comment;
use App\Models\Meeting;

class CommentController extends Controller
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
    public function store(StoreCommentRequest $request, Meeting $meeting,  AgendaItems $agendaItems)
    {
        if ($request->hasFile('path_attachment_file')) {
            $profile_path = $request->file('path_attachment_file')->store('meeting_main_attachment', 'public');
            $request->merge(['path_attachment' => $profile_path]);
        }
        $request->merge(['meeting_id' => $meeting->id]);
        $request->merge(['agenda_items_id' => $agendaItems->id]);
        $request->merge(['user_id' => auth()->user()->id]);

        $comment = Comment::create($request->all());
        session()->flash('success', 'Your Attachments / Documents / Comments has been successfully added to this meeting...');

        return to_route('meeting.agenda-item.show', [ $meeting->id, $agendaItems->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AgendaItems $agendaItems, Comment $comment)
    {
        $comment->delete();
        session()->flash('success', 'Your attachment has been successfully deleted...');

        return to_route('meeting.agenda-item.show', [$agendaItems->meeting_id,$agendaItems->id]);
    }
}
