// Dans resources/views/dashboard.blade.php
@php
    // Remplacer les relations gourmandes par du lazy loading
    $user->loadMissing(['posts' => function ($query) {
        $query->select('id', 'title')->latest()->take(100);
    }]);
@endphp

{{-- Utiliser la pagination --}}
@foreach ($user->posts()->paginate(50) as $post)
    {{-- Contenu --}}
@endforeach