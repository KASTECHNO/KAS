@extends('layouts.adminlte')
@section('title', 'Candidature — ' . $candidature->nom)
@section('page_title', 'Candidature de ' . $candidature->nom)

@section('content')
<div class="row">
    <div class="col-md-7">
        <div class="card mb-3">
            <div class="card-header"><strong>Informations du candidat</strong></div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Nom</dt><dd class="col-sm-8">{{ $candidature->nom }}</dd>
                    <dt class="col-sm-4">Email</dt><dd class="col-sm-8"><a href="mailto:{{ $candidature->email }}">{{ $candidature->email }}</a></dd>
                    <dt class="col-sm-4">Téléphone</dt><dd class="col-sm-8">{{ $candidature->phone ?? '—' }}</dd>
                    <dt class="col-sm-4">Établissement</dt><dd class="col-sm-8">{{ $candidature->etablissement ?? '—' }}</dd>
                    <dt class="col-sm-4">Niveau</dt><dd class="col-sm-8">{{ $candidature->niveau_etudes ?? '—' }}</dd>
                    <dt class="col-sm-4">Spécialité</dt><dd class="col-sm-8">{{ $candidature->specialite ?? '—' }}</dd>
                    <dt class="col-sm-4">Offre</dt><dd class="col-sm-8"><strong>{{ $candidature->stage->titre ?? '?' }}</strong></dd>
                    <dt class="col-sm-4">Date envoi</dt><dd class="col-sm-8">{{ $candidature->created_at->format('d/m/Y H:i') }}</dd>
                    @if($candidature->cv_path)
                    <dt class="col-sm-4">CV</dt>
                    <dd class="col-sm-8">
                        <a href="{{ Storage::url($candidature->cv_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-file-pdf mr-1"></i> Télécharger le CV
                        </a>
                    </dd>
                    @endif
                </dl>
                @if($candidature->lettre_motivation)
                <hr>
                <strong>Lettre de motivation :</strong>
                <p class="mt-2" style="white-space:pre-line;">{{ $candidature->lettre_motivation }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header"><strong>Statut &amp; notes admin</strong></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.candidatures.update', $candidature) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <label>Statut</label>
                        <select name="statut" class="form-control">
                            @foreach(\App\Models\StageCandidature::statutLabels() as $key => $label)
                                <option value="{{ $key }}" {{ $candidature->statut === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Notes internes</label>
                        <textarea name="notes_admin" class="form-control" rows="5">{{ old('notes_admin', $candidature->notes_admin) }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-1"></i> Enregistrer</button>
                </form>
            </div>
        </div>
        <a href="{{ route('admin.candidatures.index') }}" class="btn btn-secondary mt-2"><i class="fas fa-arrow-left mr-1"></i> Retour</a>
    </div>
</div>
@endsection
