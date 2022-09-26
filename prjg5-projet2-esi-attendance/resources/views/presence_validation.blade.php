@extends('canvas')
@section('title', 'Présence des étudiants au cours')
@section('title_header', 'PRJG5')
@section('content')
@section('css')
@section('content')

@if($success)
<p class="success" dusk="success">Les présences ont bien été enregistrées.</p>
@else
<p class="failed" dusk="failed">Une erreur s'est produite lors de l'enregistrement des présences.</p>
@endif

@endsection