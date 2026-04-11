{{-- Formulaire partagé create/edit stages --}}
<div class="form-group">
    <label>Titre de l'offre <span class="text-danger">*</span></label>
    <input type="text" name="titre" class="form-control" required
        value="{{ old('titre', $stage->titre ?? '') }}">
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Domaine <span class="text-danger">*</span></label>
            <input type="text" name="domaine" class="form-control" required
                value="{{ old('domaine', $stage->domaine ?? '') }}"
                placeholder="ex: Développement, IoT, IA">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Type de stage <span class="text-danger">*</span></label>
            <select name="type_stage" class="form-control" required>
                @foreach(['PFE', 'Initiation', 'Perfectionnement', 'Observation'] as $type)
                    <option value="{{ $type }}" {{ old('type_stage', $stage->type_stage ?? 'PFE') === $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Niveau requis</label>
            <input type="text" name="niveau_requis" class="form-control"
                value="{{ old('niveau_requis', $stage->niveau_requis ?? '') }}"
                placeholder="ex: Licence, Master, Ingénierie">
        </div>
    </div>
</div>

<div class="form-group">
    <label>Description <span class="text-danger">*</span></label>
    <textarea name="description" class="form-control" rows="5" required>{{ old('description', $stage->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Technologies utilisées</label>
    <input type="text" name="technologies" class="form-control"
        value="{{ old('technologies', $stage->technologies ?? '') }}"
        placeholder="ex: Laravel, Vue.js, Docker">
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Date limite de candidature</label>
            <input type="date" name="date_limite" class="form-control"
                value="{{ old('date_limite', isset($stage->date_limite) ? $stage->date_limite->format('Y-m-d') : '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mt-4">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1"
                    {{ old('is_active', $stage->is_active ?? true) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_active">Offre active (visible sur le site)</label>
            </div>
        </div>
    </div>
</div>
