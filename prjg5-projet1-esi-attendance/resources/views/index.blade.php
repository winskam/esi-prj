@extends('canvas')
@section('content')
@section('title', 'Tous les étudiants')
@section('title_header', 'PRJG5 - Tous les étudiants')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/student.css') }}">
@endsection

@section('content')
<h1>Tous les étudiants</h1>

<table>
  <tr>
    <th>Numéro d'étudiant</th>
    <th>Nom de l'étudiant</th>
    <th>Prénom de l'étudiant</th>
    <th width="6%"></th>
  </tr>
  @foreach ($students as $student)
  <tr>

    <td>{{$student->id}}</td>
    <td>{{$student->last_name}}</td>
    <td>{{$student->first_name}}
    </td>
    <td>
      <form method="POST" action="{{ route('students.delete', $student->id) }}">
        @csrf
        <input name="_method" type="hidden" value="DELETE">
        <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'><i class='fa fa-trash-o'></i></button>
      </form>
    </td>
  </tr>
  @endforeach
</table>
<button class="open-button" onclick="openForm()">Ajouter un étudiant</button>

<div class="form-popup" id="myForm">
  <form method="POST" action="/add" class="form-container">
  @csrf

    <h1>Ajouter un étudiant</h1>

    <label for="id"><b>Numéro d'étudiant</b></label>
    <input type="text" placeholder="Numéro d'étudiant" name="id" required>

    <label for="lastname"><b>Nom</b></label>
    <input type="text" placeholder="Nom" name="lastname" required>


    <label for="firstname"><b>Prénom</b></label>
    <input type="text" placeholder="Prénom" name="firstname" required>

    <button type="submit" class="btn">Ajouter</button>
    <button type="button" class="btn cancel" onclick="closeForm()">Fermer</button>
  </form>
</div>

<script>
  function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
</script>

@endsection