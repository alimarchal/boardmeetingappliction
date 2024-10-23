<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommitteeMeetingCommentRequest;
use App\Http\Requests\UpdateCommitteeMeetingCommentRequest;
use App\Models\AgendaItems;
use App\Models\Comment;
use App\Models\CommitteeMeeting;
use App\Models\CommitteeMeetingAgendaItem;
use App\Models\CommitteeMeetingComment;
use App\Models\Meeting;
use http\Client\Request;

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
    public function store(\Illuminate\Http\Request $request, CommitteeMeeting $committeeMeeting, CommitteeMeetingAgendaItem $committeeMeetingAgendaItem)
    {
        if ($request->hasFile('path_attachment_file')) {
            $profile_path = $request->file('path_attachment_file')->store('committee_meeting_main_attachment', 'public');
            $request->merge(['path_attachment' => $profile_path]);
        }
        $request->merge(['committee_meeting_id' => $committeeMeeting->id]);
        $request->merge(['committee_meeting_agenda_item_id' => $committeeMeetingAgendaItem->id]);
        $request->merge(['user_id' => auth()->user()->id]);


        $comment = CommitteeMeetingComment::create($request->all());
        session()->flash('success', 'Your Attachments / Documents / Comments has been successfully added to this meeting...');

        return to_route('committee_meeting.agenda_item.show', [$committeeMeeting->id, $committeeMeetingAgendaItem->id]);
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
    public function destroy(CommitteeMeeting $committeeMeeting, CommitteeMeetingAgendaItem $committeeMeetingAgendaItem, CommitteeMeetingComment $comment)
    {
        $comment->delete();
        session()->flash('success', 'Your attachment has been successfully deleted...');
        return to_route('committee_meeting.agenda_item.show', [$committeeMeeting->id, $committeeMeetingAgendaItem->id]);
    }
}