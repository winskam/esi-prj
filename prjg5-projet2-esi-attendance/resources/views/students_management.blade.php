@extends('canvas')

@section('title', 'StudentManagement')

@section ('content')
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{secure_asset('css/studentManagement.css') }}">
        <script type="text/javascript" src="{{secure_asset('js/studentManagement.js') }}"></script>
    </head>
    <h2>Student management</h2>
    @if (session('success'))
        <h3 class='success'>{{session('success')}}</h3>
    @endif

    @if (session('errors'))
        <h3 class='error'>{{session('errors')->first()}}</h3>
    @endif

    <div><button type="button" class="btnAdd" onclick="openFormAdd()" dusk="popupForm">Ajouter un étudiant</button></div>

    <input type="text" id="myInput" onkeyup="searchingInDB()" placeholder="Chercher un étudiant">

    <table id="myTable">
        <tr>
            <th style="width:80%">Etudiants</th>
        </tr>
        @foreach($students as $student)
            <tr>
                <td id="id_student{{$student->id}}"
                    dusk="id_student{{$student->id}}">
                    {{$student->id}} {{$student->last_name}} {{$student->first_name}}
                </td>
                <td>
                    <form action="{{URL::to('/students_management/delete', array($student->id), true)}}" method="POST"
                          onsubmit="return confirm('Vous êtes sûr ?');">
                        @csrf
                        <button type="submit" class="btnDelete" dusk="delete{{$student->id}}">Supprimer</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="form-popup" id="addForm">
        <form action="{{URL::to('/students_management/add', array(), true)}}" class="form-container" method="POST">
            @csrf
            <h3>Ajouter étudiant</h3>
            <input type="number" name="id" placeholder="Matricule" min="1" dusk="student_id">
            <input type="text" name="last_name" placeholder="Nom" dusk="student_last_name">
            <input type="text" name="first_name" placeholder="Prénom" dusk="student_first_name">
            <select dusk="group_name" id="group" name="group">
                <option value="" disabled selected>Sélectionnez un groupe</option>
                @foreach($groups as $group)
                    <option value="{{ $group->name }}">{{ $group->name }}</option>
                @endforeach
            </select>


            <button type="submit" class="btn" dusk="add">Ajouter</button>
            <button type="button" class="btn delete" onclick="closeFormAdd()">Close</button>
        </form>
    </div>
@endsection
