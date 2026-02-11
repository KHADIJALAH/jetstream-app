@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Modifier l'avis</h1>
    <form action="{{ route('admin.avis.update', $avis->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="rating">Note (1 à 5)</label>
            <input type="number" name="rating" id="rating" value="{{ $avis->rating }}" min="1" max="5" required>
        </div>
        <div class="form-group">
            <label for="comment">Commentaire</label>
            <textarea name="comment" id="comment" rows="4" required>{{ $avis->comment }}</textarea>
        </div>
        <button type="submit">Mettre à jour l'avis</button>
    </form>
</div>
@endsection
