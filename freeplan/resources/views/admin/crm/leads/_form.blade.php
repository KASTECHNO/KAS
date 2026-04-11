<div class="form-row">
    <div class="form-group col-md-4">
        <label>Nom complet</label>
        <input type="text" name="fullname" class="form-control" value="{{ old('fullname', $lead->fullname) }}" required>
    </div>
    <div class="form-group col-md-4">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $lead->email) }}">
    </div>
    <div class="form-group col-md-4">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $lead->phone) }}">
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Source</label>
        <input type="text" name="source" class="form-control" value="{{ old('source', $lead->source ?: 'WEBSITE_CONTACT') }}">
    </div>
    <div class="form-group col-md-4">
        <label>Entreprise</label>
        <input type="text" name="company" class="form-control" value="{{ old('company', $lead->company) }}">
    </div>
    <div class="form-group col-md-4">
        <label>Secteur</label>
        <select name="sector_id" class="form-control">
            <option value="">-</option>
            @foreach($sectors as $sector)
                <option value="{{ $sector->id }}" {{ (string) old('sector_id', $lead->sector_id) === (string) $sector->id ? 'selected' : '' }}>{{ $sector->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-3">
        <label>Statut</label>
        <select name="status" class="form-control" required>
            @foreach($statuses as $status)
                <option value="{{ $status }}" {{ old('status', $lead->status ?: 'NEW') === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label>Score</label>
        <input type="number" name="score" min="0" max="100" class="form-control" value="{{ old('score', $lead->score ?? 0) }}" required>
    </div>
    <div class="form-group col-md-3">
        <label>Owner</label>
        <select name="owner_id" class="form-control">
            <option value="">-</option>
            @foreach($owners as $owner)
                <option value="{{ $owner->id }}" {{ (string) old('owner_id', $lead->owner_id) === (string) $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label>Client converti</label>
        <select name="converted_client_id" class="form-control">
            <option value="">-</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ (string) old('converted_client_id', $lead->converted_client_id) === (string) $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Dernier contact</label>
        <input type="datetime-local" name="last_contact_at" class="form-control" value="{{ old('last_contact_at', optional($lead->last_contact_at)->format('Y-m-d\\TH:i')) }}">
    </div>
</div>

<div class="form-group">
    <label>Notes</label>
    <textarea name="notes" rows="5" class="form-control">{{ old('notes', $lead->notes) }}</textarea>
</div>
