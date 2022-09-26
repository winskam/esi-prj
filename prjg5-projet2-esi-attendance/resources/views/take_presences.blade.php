@extends('canvas')
@section('title', 'Présence des étudiants au cours')
@section('title_header', 'PRJG5')
@section('content')

<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('css/takePresences.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @yield('css')
    <title>@yield('title')</title>
</head>

<body>
    <main>
        <h1>Les étudiants</h1>
        <form method="POST" action="/take_presences/{{$seance_id}}/validation">
            {{ csrf_field() }}
            <table>
                <tr>
                    <th>Matricule</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Présent(e) <input type="checkbox" id="select-all" dusk="select-all"> Tout sélectionner</th>
                </tr>
                @foreach ($students as $student)
                <tr>
                    <td dusk='id_student'>{{$student->id}}</td>
                    <td>{{$student->last_name}}</td>
                    <td>{{$student->first_name}}</td>
                    <td><input type="checkbox" name="checklist[]" id="{{$student->id}}" dusk="{{$student->id}}"></td>
                </tr>
                @endforeach
            </table>
            <br>
            <input type="submit" value="Valider les présences">
        </form>
    </main>
</body>

@endsection

@section('js')
<script src="{{ secure_asset('js/presence_taking.js') }}"></script>
@endsection