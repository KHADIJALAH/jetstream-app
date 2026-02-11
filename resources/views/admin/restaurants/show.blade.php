@extends('app.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Détails du restaurant</h6>
            <div class="btn-group">
                <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i> Modifier
                </a>
                <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Confirmer la suppression ?')">
                        <i class="fas fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ $restaurant->getFirstMediaUrl('photos') }}" 
                         class="img-fluid rounded" 
                         alt="{{ $restaurant->name }}">
                </div>
                <div class="col-md-8">
                    <h3>{{ $restaurant->name }}</h3>
                    <p class="lead">{{ $restaurant->description }}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Informations</h5>
                            <ul class="list-unstyled">
                                <li><strong>Adresse:</strong> {{ $restaurant->address }}</li>
                                <li><strong>Téléphone:</strong> {{ $restaurant->phone }}</li>
                                <li><strong>Cuisine:</strong> {{ $restaurant->cuisine_type }}</li>
                                <li><strong>Note moyenne:</strong> 
                                    <div class="rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $restaurant->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection