{{-- Formulaire partagé create/edit pricing --}}

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Type d'offre <span class="text-danger">*</span></label>
            <select name="type" class="form-control" required {{ isset($plan) ? 'disabled' : '' }}>
                <option value="">— Sélectionner —</option>
                @foreach($availableTypes ?? ['mensuel','annuel','licence'] as $t)
                    <option value="{{ $t }}"
                        {{ old('type', $plan->type ?? '') === $t ? 'selected' : '' }}>
                        @if($t === 'mensuel') Abonnement Mensuel (hébergement KAS)
                        @elseif($t === 'annuel') Abonnement Annuel (hébergement KAS)
                        @else Licence Perpétuelle (hébergement privé)
                        @endif
                    </option>
                @endforeach
            </select>
            @isset($plan)
                {{-- Le type ne peut pas changer une fois créé --}}
                <input type="hidden" name="type" value="{{ $plan->type }}">
                <small class="text-muted">Le type ne peut pas être modifié après création.</small>
            @endisset
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Prix affiché (DT) <span class="text-danger">*</span></label>
            <input type="number" step="0.01" min="0" name="prix" class="form-control" required
                value="{{ old('prix', $plan->prix ?? '') }}"
                placeholder="ex: 150.00">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Nom interne <small class="text-muted">(non affiché публично)</small></label>
            <input type="text" name="nom_application" class="form-control" maxlength="200"
                value="{{ old('nom_application', $plan->nom_application ?? '') }}"
                placeholder="ex: KAS Médicale">
        </div>
    </div>
</div>

<div class="form-group">
    <label>Description courte <small class="text-muted">(affichée sous le nom de l'offre)</small></label>
    <textarea name="description" class="form-control" rows="3"
        placeholder="Accédez à votre application hébergée sur les serveurs KAS...">{{ old('description', $plan->description ?? '') }}</textarea>
</div>

<div class="form-group">
    <label>Fonctionnalités incluses <small class="text-muted">(une par ligne, affichées comme liste à cocher)</small></label>
    <textarea name="fonctionnalites" class="form-control" rows="8"
        placeholder="Hébergement KAS inclus&#10;Mises à jour automatiques&#10;Support technique inclus&#10;Sans engagement de durée&#10;Accès multi-utilisateurs">{{ old('fonctionnalites', $plan->fonctionnalites ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Badge <small class="text-muted">(ex : Meilleure offre, Populaire)</small></label>
            <input type="text" name="badge" class="form-control" maxlength="80"
                value="{{ old('badge', $plan->badge ?? '') }}">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mt-4 pt-2">
            <div class="custom-control custom-switch mb-2">
                <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured" value="1"
                    {{ old('is_featured', $plan->is_featured ?? false) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_featured">Mettre en avant (fond coloré)</label>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" value="1"
                    {{ old('is_active', $plan->is_active ?? true) ? 'checked' : '' }}>
                <label class="custom-control-label" for="is_active">Offre active (affichée sur le site)</label>
            </div>
        </div>
    </div>
</div>
