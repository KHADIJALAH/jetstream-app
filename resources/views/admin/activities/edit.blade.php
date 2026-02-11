{{-- edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b bg-gradient-to-r from-violet-600 to-violet-700">
                <h2 class="text-2xl font-bold text-white">Modifier l'activité #{{ $activity->id }}</h2>
            </div>

            <div class="p-6 space-y-6">
                <form method="POST" action="{{ route('admin.activities.update', $activity->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.activities._form', [
                        'activity' => $activity,
                        'submitText' => 'Mettre à jour'
                    ])
                </form>
            </div>
        </div>
    </div>
</div>
@endsection