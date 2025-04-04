<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JetStream - Accueil</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <h1>Bienvenue sur JetStream</h1>
        <nav>
            <ul>
                <li><a href="{{ route('hotels.index') }}">Hôtels</a></li>
                <li><a href="{{ route('activities.index') }}">Activités</a></li>
                <li><a href="{{ route('restaurants.index') }}">Restaurants</a></li>
                <li><a href="{{ route('reservations.index') }}">Réservations</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Nos Services</h2>
        <p>Explorez les meilleures options de logement, activités, et restaurants.</p>
    </main>
    <footer>
        <p>&copy; 2023 JetStream</p>
    </footer>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>