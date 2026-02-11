<!-- resources/views/admin/users/index.blade.php -->
@extends('layouts.admin')

@section('content')
    <h1>Gestion des utilisateurs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <!-- Boutons d'action -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
