@extends('layouts.app')

@section('content')
    <h1>Edit Agenda Item for {{ $committeeMeeting->title }}</h1>

    <form action="{{ route('committee_meeting.agenda_item.update', [$committeeMeeting->id, $agendaItem->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Title</label>
        <input type="text" name="title" value="{{ $agendaItem->title }}" required>

        <label>Description</label>
        <textarea name="description" required>{{ $agendaItem->description }}</textarea>

        <label>Order</label>
        <input type="number" name="order" value="{{ $agendaItem->order }}" required>

        <button type="submit">Update</button>
    </form>
@endsection