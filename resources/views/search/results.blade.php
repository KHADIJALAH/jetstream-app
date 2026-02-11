@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Résultats pour : "{{ $searchTerm }}"</h2>
    
    @if($hotels->count())
        <div class="row g-4">
            @foreach($hotels as $hotel)
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        <img src="{{ asset($hotel->featured_image) }}" class="card-img-top" alt="{{ $hotel->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hotel->name }}</h5>
                            <p class="text-muted">{{ $hotel->location }}</p>
                            <p class="card-text">{{ Str::limit($hotel->description, 150) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-primary">{{ $hotel->price_per_night }}€/nuit</span>
                                <a href="{{ route('hotels.show', $hotel) }}" class="btn btn-primary">
                                    Voir détails
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $hotels->links() }}
        </div>
    @else
        <div class="alert alert-info">
            Aucun hôtel trouvé pour "{{ $searchTerm }}"
        </div>
    @endif
</div>
@endsection