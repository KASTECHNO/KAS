@extends('layouts.adminlte')

@section('content')
<h2>Add Quote</h2>

<form action="{{ route('admin.quotes.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Full Name *</label>
        <input type="text" name="fullname" class="form-control"
               value="{{ old('fullname') }}" required>
    </div>

    <div class="form-group">
        <label>Email *</label>
        <input type="email" name="email" class="form-control"
               value="{{ old('email') }}" required>
    </div>

    <div class="form-group">
        <label>Phone</label>
        <input type="text" name="phone" class="form-control"
               value="{{ old('phone') }}">
    </div>

    <div class="form-group">
        <label>Message</label>
        <textarea name="message" class="form-control">{{ old('message') }}</textarea>
    </div>

    <div class="form-group">
        <label>Service</label>
        <select name="service_id" class="form-control">
            <option value="">-- None --</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}"
                    {{ old('service_id') == $service->id ? 'selected' : '' }}>
                    {{ $service->title }}
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
                    {{ old('project_id') == $project->id ? 'selected' : '' }}>
                    {{ $project->title }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

