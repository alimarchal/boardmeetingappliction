@extends('layouts.app')

@section('content')
    <h1>{{ $agendaItem->title }}</h1>
    <p>{{ $agendaItem->description }}</p>
    <p>Order: {{ $agendaItem->order }}</p>
@endsection