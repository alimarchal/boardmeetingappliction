<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommitteeMeetingCommentRequest;
use App\Http\Requests\UpdateCommitteeMeetingCommentRequest;
use App\Models\CommitteeMeetingComment;

class CommitteeMeetingCommentController extends Controller
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
    public function store(StoreCommitteeMeetingCommentRequest $request)
    {
        $comment = new CommitteeMeetingComment($request->all());
        $agendaItem->comments()->save($comment);
        return redirect()->route('committee_meeting_agenda_items.show', $agendaItem->id)->with('success', 'Comment added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CommitteeMeetingComment $committeeMeetingComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CommitteeMeetingComment $committeeMeetingComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommitteeMeetingCommentRequest $request, CommitteeMeetingComment $committeeMeetingComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CommitteeMeetingComment $committeeMeetingComment)
    {
        $comment->delete();
        return redirect()->route('committee_meeting_agenda_items.show', $agendaItem->id)->with('success', 'Comment deleted successfully.');
    }
}