@extends('layouts.app')

@section('content')
    <h1>Edit Committee Meeting</h1>

    <form action="{{ route('committee_meeting.update', $committeeMeeting->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label>Title</label>
        <input type="text" name="title" value="{{ $committeeMeeting->title }}" required>

        <label>Description</label>
        <textarea name="description">{{ $committeeMeeting->description }}</textarea>

        <label>Date and Time</label>
        <input type="datetime-local" name="date_and_time" value="{{ $committeeMeeting->date_and_time }}" required>

        <label>Location</label>
        <input type="text" name="location" value="{{ $committeeMeeting->location }}" required>

        <label>Attachment</label>
        <input type="file" name="path_attachment">

        <button type="submit">Update</button>
    </form>
@endsection