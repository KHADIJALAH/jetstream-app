@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Gestion des Avis pour l'Hôtel : {{ $hotel->name }}</h1>

    <!-- Affichage des avis -->
    <div class="reviews">
        <h3>Avis des clients</h3>
        @foreach($hotel->avis as $avis)
        <div class="review">
            <p><strong>{{ $avis->user->name }}</strong> a donné une note de {{ $avis->rating }} étoiles</p>
            <p>{{ $avis->comment }}</p>
            <p><small>Publié le {{ $avis->created_at->format('d/m/Y') }}</small></p>

            <!-- Actions pour l'administrateur -->
            <form action="{{ route('admin.avis.destroy', $avis->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>

            <!-- Option de modifier si besoin -->
            <a href="{{ route('admin.avis.edit', $avis->id) }}" class="btn btn-warning">Modifier</a>
        </div>
        @endforeach
    </div>
</div>
@endsection
