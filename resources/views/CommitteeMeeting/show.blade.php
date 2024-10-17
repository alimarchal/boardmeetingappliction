@extends('layouts.app')

@section('content')
    <h1>{{ $committeeMeeting->title }}</h1>
    <p>{{ $committeeMeeting->description }}</p>
    <p>{{ $committeeMeeting->date_and_time }}</p>
    <p>{{ $committeeMeeting->location }}</p>
    @if($committeeMeeting->path_attachment)
        <a href="{{ asset('storage/' . $committeeMeeting->path_attachment) }}">Download Attachment</a>
    @endif
@endsection