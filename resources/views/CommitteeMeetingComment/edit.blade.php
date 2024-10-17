@extends('layouts.app')

@section('content')
    <h1>Edit Comment for Agenda Item: {{ $agendaItem->title }}</h1>

    <form action="{{ route('committee_meeting.agenda_item.comment.update', [$committeeMeeting->id, $agendaItem->id, $comment->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Comment</label>
        <textarea name="description" required>{{ $comment->description }}</textarea>

        <label>Attachment</label>
        <input type="file" name="path_attachment">

        <button type="submit">Update Comment</button>
    </form>
@endsection