@extends('layouts.app')

@section('content')
    <h1>Agenda Items for {{ $committeeMeeting->title }}</h1>
    <a href="{{ route('committee_meeting.agenda_item.create', $committeeMeeting->id) }}">Create New Agenda Item</a>

    <ul>
        @foreach($agendaItems as $agendaItem)
            <li>
                <a href="{{ route('committee_meeting.agenda_item.show', [$committeeMeeting->id, $agendaItem->id]) }}">{{ $agendaItem->title }}</a>
                <a href="{{ route('committee_meeting.agenda_item.edit', [$committeeMeeting->id, $agendaItem->id]) }}">Edit</a>
                <form action="{{ route('committee_meeting.agenda_item.destroy', [$committeeMeeting->id, $agendaItem->id]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection