@extends('canvas')

@section('title', 'StudentList')

@section('content')
    <div>
        <form id="add" @submit="checkForm" action="{{ route('add') }}" method="POST">
            @csrf
            <h5>Ajouter un étudiant à un cours</h5>
            <p>
                <label for="id">Id de l'étudiant :</label>
                <select id="student_id" name="student_id">
                    <option value="" disabled selected>Sélectionnez l'ID d'un étudiant</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->id }}</option>
                    @endforeach
                </select>
            </p>
            <p>
                <label for="id">Nom du cours :</label>
                <select id="course_id" name="course_id">
                    <option value="" disabled selected>Sélectionnez un cours</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->ue }} - {{ $course->name }}</option>
                    @endforeach
                </select>
            </p>
            <p><input type="submit" value="Ajouter"></p>
        </form>
    </div>

    <div>
        <form id="delete" @submit="checkForm" action="{{ route('delete') }}" method="POST">
            @csrf
            <h5>Retirer un étudiant d'un cours</h5>
            <p>
                <label for="id">Id de l'étudiant :</label>
                <select id="student_id" name="student_id">
                    <option value="" disabled selected>Sélectionnez l'ID d'un étudiant</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->id }}</option>
                    @endforeach
                </select>
            </p>
            <p>
                <label for="id">Nom du cours :</label>
                <select id="course_id" name="course_id">
                    <option value="" disabled selected>Sélectionnez un cours</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->ue }} - {{ $course->name }}</option>
                    @endforeach
                </select>
            </p>
            <p><input type="submit" value="Retirer"></p>
        </form>
    </div>
@endsection
