@extends('layouts.app')

@section('content')
    <h1>Create Agenda Item for {{ $committeeMeeting->title }}</h1>

    <form action="{{ route('committee_meeting.agenda_item.store', $committeeMeeting->id) }}" method="POST">
        @csrf
        <label>Title</label>
        <input type="text" name="title" required>

        <label>Description</label>
        <textarea name="description" required></textarea>

        <label>Order</label>
        <input type="number" name="order" required>

        <button type="submit">Create</button>
    </form>
@endsection