@extends('layouts.app')

@section('content')
    <h1>Committee Meetings</h1>
    <a href="{{ route('committee_meeting.create') }}">Create New Meeting</a>

    <ul>
        @foreach($committeeMeetings as $meeting)
            <li>
                <a href="{{ route('committee_meeting.show', $meeting->id) }}">{{ $meeting->title }}</a>
                <a href="{{ route('committee_meeting.edit', $meeting->id) }}">Edit</a>
                <form action="{{ route('committee_meeting.destroy', $meeting->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection