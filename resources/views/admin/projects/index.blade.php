@extends('layouts.admin')

@section('content')
    <h2>Progetti</h2>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <form class="d-flex" action="{{ route('admin.projects.store') }}" method="POST">
        @csrf
        <input class="form-control me-2" placeholder="Nuovo progetto" name="title">
        <button class="btn btn-success" type="submit">Aggiungi</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Progetti</th>
                <th scope="col">Azioni</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <td>
                        <form action="{{ route('admin.projects.update', $project) }}" method="POST"
                            id="form-edit-{{ $project->id }}">
                            @csrf
                            @method('PUT')
                            <input type="text" value="{{ $project->title }}" name="title">

                        </form>
                    </td>
                    <td class="d-flex">

                        <button onclick="submitForm({{ $project->id }})" class="me-2 btn btn-warning"
                            type="submit">Modifica</button>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                            onsubmit="return confirm('Sei sicuro di voler cancellare l\'elemento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        function submitForm(id) {
            const form = document.getElementById(`form-edit-${id}`);
            form.submit();
        }
    </script>
@endsection
