@extends('studentsConsultation')

@section('title', 'StudentList')

@section ('addStudentToCourse')
    <div>
        <form id="add" @submit="checkForm" action="{{URL::to('/seance-details', array($seance_id), false)}}" method="POST">
            @csrf
            <h5>Ajouter un étudiant à un cours</h5>
            <p>
                <label for="id">Liste des étudiants :</label>
                <select id="student_id" name="student_id" dusk="select_student_id">
                    <option value="" disabled selected>Sélectionnez un étudiant</option>
                    @foreach($studentsOut as $student)
                        <option value="{{ $student->id }}"> {{ $student->id }}
                            - {{$student->last_name}} {{$student->first_name}} </option>
                    @endforeach
                </select>
            </p>
            <p><input type="submit" value="Ajouter"></p>
            <div id="error"></div>
        </form>
    </div>

@endsection
