@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="text-center">
                    <h1 class="display-4">404</h1>
                    <p class="lead">Page Not Found</p>
                    <p>The requested page could not be found.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Go Back Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection