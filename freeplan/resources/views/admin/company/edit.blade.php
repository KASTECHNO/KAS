@extends('layouts.adminlte')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Modifier Entreprise</h2>

    <form method="POST" action="{{ route('admin.company.update', $company) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nom</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $company->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slogan</label>
            <input type="text" name="slogan" class="form-control" value="{{ old('slogan', $company->slogan) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $company->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Adresse</label>
            <input type="text" name="address" class="form-control" value="{{ old('address', $company->address) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $company->email) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Telephone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->phone) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Site Web</label>
            <input type="text" name="website_url" class="form-control" value="{{ old('website_url', $company->website_url) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Logo URL</label>
            <input type="text" name="logo_url" class="form-control" value="{{ old('logo_url', $company->logo_url) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Logo Path (storage)</label>
            <input type="text" name="logo_path" class="form-control" value="{{ old('logo_path', $company->logo_path) }}" placeholder="company/filename.png">
        </div>

        <div class="mb-3">
            <label class="form-label">Logo Fichier</label>
            <input type="file" name="logo_file" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.company.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection

