@extends('layouts.app')

@section('content')
<h2>Edit Quote</h2>

<form action="{{ route('admin.quotes.update', $quote) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Full Name *</label>
        <input type="text" name="fullname" class="form-control"
               value="{{ old('fullname', $quote->fullname) }}" required>
    </div>

    <div class="form-group">
        <label>Email *</label>
        <input type="email" name="email" class="form-control"
               value="{{ old('email', $quote->email) }}" required>
    </div>

    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control"
               value="{{ old('phone', $quote->phone) }}">
    </div>

    <div class="form-group">
        <label>Message</label>
        <textarea name="message" class="form-control">{{ old('message', $quote->message) }}</textarea>
    </div>

    <div class="form-group">
        <label>Service</label>
        <select name="service_id" class="form-control">
            <option value="">-- None --</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}"
                    {{ old('service_id', $quote->service_id) == $service->id ? 'selected' : '' }}>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Project</label>
        <select name="project_id" class="form-control">
            <option value="">-- None --</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}"
                    {{ old('project_id', $quote->project_id) == $project->id ? 'selected' : '' }}>
                    {{ $project->title }}
                </option>
            @endforeach
        </select>
    </div>

    <a href="{{ route('admin.quotes.index') }}" class="btn btn-primary">Update</a>
    <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
