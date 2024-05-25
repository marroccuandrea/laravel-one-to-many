@extends('layouts.admin')

@section('content')
    <h1>Crea nuovo progetto</h1>
    <form class="d-flex my-5" action="{{ route('admin.projects.store') }}" method="POST">
        @csrf
        <input class="form-control me-2" placeholder="Nome progetto" name="title">
        <button class="btn btn-primary" type="submit">Aggiungi</button>
    </form>
@endsection
