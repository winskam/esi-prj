@extends('canvas')
@section('title', 'StudentList')
@section ('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/statExport.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('css')
</head>

<body>
    <main>
        <h1>Exporter</h1>
        <p>Exporter la table "Présences" en Excel</p>
        <form method="POST" action="{{URL::to('/export_stats_presences', array(), true)}}">
            {{ csrf_field() }}
            <input type="text" name="name" placeholder="Nom de fichier">
            <select name="extension">
                <option value="xlsx">.xlsx</option>
                <option value="csv">.csv</option>
            </select>
            <button type="submit">Exporter</button>
        </form>
    </main>
</body>

@endsection