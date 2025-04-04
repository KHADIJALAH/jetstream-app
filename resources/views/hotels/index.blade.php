@extends('layouts.app')

@section('content')
    <h1>Liste des Hôtels</h1>
    <ul>
        @foreach($hotels as $hotel)
            <li>
                <a href="{{ route('hotels.show', $hotel->id) }}">{{ $hotel->name }}</a>
                <p>Localisation: {{ $hotel->location }}</p>
            </li>
        @endforeach
    </ul>
@endsection