<div class="form-row">
    <div class="form-group col-md-6">
        <label>Sujet</label>
        <input type="text" name="subject" class="form-control" value="{{ old('subject', $activity->subject) }}" required>
    </div>
    <div class="form-group col-md-3">
        <label>Type</label>
        <select name="type" class="form-control" required>
            @foreach($types as $type)
                <option value="{{ $type }}" {{ old('type', $activity->type ?: 'TASK') === $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-3">
        <label>Statut</label>
        <select name="status" class="form-control" required>
            @foreach($statuses as $status)
                <option value="{{ $status }}" {{ old('status', $activity->status ?: 'PENDING') === $status ? 'selected' : '' }}>{{ $status }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Lead</label>
        <select name="lead_id" class="form-control">
            <option value="">-</option>
            @foreach($leads as $lead)
                <option value="{{ $lead->id }}" {{ (string) old('lead_id', $activity->lead_id) === (string) $lead->id ? 'selected' : '' }}>{{ $lead->fullname }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label>Client</label>
        <select name="client_id" class="form-control">
            <option value="">-</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" {{ (string) old('client_id', $activity->client_id) === (string) $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label>Opportunite</label>
        <select name="opportunity_id" class="form-control">
            <option value="">-</option>
            @foreach($opportunities as $opportunity)
                <option value="{{ $opportunity->id }}" {{ (string) old('opportunity_id', $activity->opportunity_id) === (string) $opportunity->id ? 'selected' : '' }}>{{ $opportunity->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        <label>Echeance</label>
        <input type="datetime-local" name="due_at" class="form-control" value="{{ old('due_at', optional($activity->due_at)->format('Y-m-d\\TH:i')) }}">
    </div>
    <div class="form-group col-md-4">
        <label>Terminee le</label>
        <input type="datetime-local" name="completed_at" class="form-control" value="{{ old('completed_at', optional($activity->completed_at)->format('Y-m-d\\TH:i')) }}">
    </div>
    <div class="form-group col-md-4">
        <label>Owner</label>
        <select name="owner_id" class="form-control">
            <option value="">-</option>
            @foreach($owners as $owner)
                <option value="{{ $owner->id }}" {{ (string) old('owner_id', $activity->owner_id) === (string) $owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea name="description" rows="5" class="form-control">{{ old('description', $activity->description) }}</textarea>
</div>
