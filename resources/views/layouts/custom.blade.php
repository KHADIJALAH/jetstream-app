{{-- resources/views/layouts/custom.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
</head>
<body>
    <nav class="bg-gray-800 text-white p-4">
        <ul class="flex gap-4">
            <li><a href="/" class="hover:underline">Accueil</a></li>
            <li><a href="/hotels" class="hover:underline">Hôtels</a></li>
            <li><a href="/activities" class="hover:underline">Activités</a></li>
            <li><a href="/reservations" class="hover:underline">Réservations</a></li>
        </ul>
    </nav>

    <div class="p-6">
        @yield('content')
    </div>
</body>
</html>
