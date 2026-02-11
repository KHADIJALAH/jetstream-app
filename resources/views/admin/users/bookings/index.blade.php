<!-- resources/views/admin/bookings/index.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1>Liste des réservations</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Service</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->service->name }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>
                        <!-- Boutons d'action -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
