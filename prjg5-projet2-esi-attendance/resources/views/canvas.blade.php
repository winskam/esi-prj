<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/canvas.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('css')
    <title>@yield('title')</title>
</head>

<header>
    <a href="/"><img id="logo" src="/he2b-esi.jpg" alt="HE2B-ESI" /></a>
    <h1 id="title_header">ESI Attendance - JOHNLOM</h1>
    <nav class="topnav">
            <a href="/import_groups_for_students">Importer des groupes</a>
            <a href="/export_stats_presences">Télécharger un fichier reprenant les présences</a>
            <a href="/seance-details/1">Prendre les présences (et ajouter/supprimer un étudiant d'un cours)</a>
            <a href="/import_schedule">Importer un horaire</a>
            <a href="/students_management">Gestion des étudiants</a>
            <a href="/calendar">Vue du calendrier</a>
    </nav>
</header>

<body>
    @yield('content')

  @yield('js')
</body>

<footer>JOHNLOM</footer>

</html>
