<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
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
    public function store(StoreCommentRequest $request, Meeting $meeting)
    {
        if ($request->hasFile('path_attachment_file')) {
            $profile_path = $request->file('path_attachment_file')->store('meeting_main_attachment', 'public');
            $request->merge(['path_attachment' => $profile_path]);
        }
        $request->merge(['meeting_id' => $meeting->id]);
        $request->merge(['user_id' => auth()->user()->id]);

        $comment = Comment::create($request->all());
        session()->flash('success', 'Your attachment has been successfully added to this meeting...');

        return to_route('meeting.show', $meeting->id);
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
    public function destroy(Comment $comment)
    {
        $meeting_id = $comment->meeting_id;
        $comment->delete();
        session()->flash('success', 'Your attachment has been successfully deleted...');

        return to_route('meeting.show', $meeting_id);
    }
}
