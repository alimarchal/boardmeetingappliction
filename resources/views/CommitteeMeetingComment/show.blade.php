@extends('layouts.app')

@section('content')
    <h1>Comment</h1>
    <p>{{ $comment->description }}</p>
    @if($comment->path_attachment)
        <a href="{{ asset('storage/' . $comment->path_attachment) }}">Download Attachment</a>
    @endif
@endsection