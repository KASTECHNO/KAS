<div class="form-row">
    <div class="form-group col-md-6">
        <label>Nom opportunite</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $opportunity->name) }}" required>
    </div>
    <div class="form-group col-md-3">
        <label>Montant</label>
        <input type="number" step="0.01" min="0" name="amount" class="form-control" value="{{ old('amount', $opportunity->amount ?? 0) }}" required>
    </div>
    <div class="form-group col-md-3">
        <label>Devise</label>
        <input type="text" maxlength="3" name="currency" class="form-control text-uppercase" value="{{ old('currency', $opportunity->currency ?: 'EUR') }}" required>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Lead</label>
        <select name="lead_id" class="form-control">
            <option value="">-</option>
            @foreach($leads as $lead)
                <option value="{{ $lead->id }}" {{ (string) old('lead_id', $opportunity->lead_id) === (string) $lead->id ? 'selected' : '' }}>{{ $lead->fullname }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label>Client</label>
        <select name="client_id" class="form-control">
            <option value="">-</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ (string) old('client_id', $opportunity->client_id) === (string) $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label>Owner</label>
        <select name="owner_id" class="form-control">
            <option value="">-</option>
            @foreach($owners as $owner)
                <option value="{{ $owner->id }}" {{ (string) old('owner_id', $opportunity->owner_id) === (string) $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Etape</label>
        <select name="stage" class="form-control" required>
            @foreach($stages as $stage)
                <option value="{{ $stage }}" {{ old('stage', $opportunity->stage ?: 'DISCOVERY') === $stage ? 'selected' : '' }}>{{ $stage }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-2">
        <label>Probabilite</label>
        <input type="number" min="0" max="100" name="probability" class="form-control" value="{{ old('probability', $opportunity->probability ?? 20) }}" required>
    </div>
    <div class="form-group col-md-3">
        <label>Statut</label>
        <select name="status" class="form-control" required>
            @foreach($statuses as $status)
                <option value="{{ $status }}" {{ old('status', $opportunity->status ?: 'OPEN') === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label>Date de closing</label>
        <input type="date" name="expected_close_date" class="form-control" value="{{ old('expected_close_date', optional($opportunity->expected_close_date)->format('Y-m-d')) }}">
    </div>
</div>

<div class="form-group">
    <label>Notes</label>
    <textarea name="notes" rows="5" class="form-control">{{ old('notes', $opportunity->notes) }}</textarea>
</div>
