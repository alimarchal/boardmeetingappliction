@extends('layouts.app')

@section('content')
    <h1>Add Comment for Agenda Item: {{ $agendaItem->title }}</h1>

    <form action="{{ route('committee_meeting.agenda_item.comment.store', [$committeeMeeting->id, $agendaItem->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Comment</label>
        <textarea name="description" required></textarea>

        <label>Attachment</label>
        <input type="file" name="path_attachment">

        <button type="submit">Add Comment</button>
    </form>
@endsection