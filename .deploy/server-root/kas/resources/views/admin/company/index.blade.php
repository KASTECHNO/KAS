@extends('layouts.adminlte')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Entreprise</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($company)
        <table class="table table-bordered">
            <tr><th>Nom</th><td>{{ $company->name }}</td></tr>
            <tr><th>Slogan</th><td>{{ $company->slogan }}</td></tr>
            <tr><th>Email</th><td>{{ $company->email }}</td></tr>
            <tr><th>Telephone</th><td>{{ $company->phone }}</td></tr>
            <tr><th>Adresse</th><td>{{ $company->address }}</td></tr>
        </table>

        <a href="{{ route('admin.company.edit', $company) }}" class="btn btn-primary">Modifier</a>
    @else
        <div class="alert alert-warning">Aucune information entreprise trouvee.</div>
        <a href="{{ route('admin.company.create') }}" class="btn btn-primary">Ajouter Entreprise</a>
    @endif
</div>
@endsection

