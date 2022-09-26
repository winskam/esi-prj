@extends('canvas')
@section('title', 'Bienvenue')
@section('content')

@section('title', 'StudentList')

@section ('content')

<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
        <main>
            <H1>Bienvenue</H1>
            <table border="1">
                <thead>
                    <tr>
                        <th>Routes fonctionnelles</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="/import_groups_for_students">Importation des affectations de groupe pour les
                                étudiants (CSV)</a></td>
                    </tr>
                    <tr>
                        <td><a href="/export_stats_presences">Téléchargement des statistiques de présences (CSV ou
                                XLSX)</a></td>
                    </tr>
                    <tr>
                        <td><a href="/seance-details/1">Consultation des étudiants (pour une séance précise) & prise de
                                présences</a></td>
                    </tr>
                    <tr>
                        <td><a href="/import_schedule">Importation horaires des profs</a></td>
                    </tr>
                    <tr>
                        <td><a href="/students_management">Gestion des étudiants</a></td>
                    </tr>
                    <tr>
                        <td><a href="/calendar">Calendrier des séances</a></td>
                    </tr>
                </tbody>
            </table>
        </main>
    </body>

</html>

@endsection
