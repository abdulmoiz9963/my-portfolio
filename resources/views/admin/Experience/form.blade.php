@extends('layouts.admin')
@section('page-title', isset($experience) ? 'Edit Experience' : 'Add Experience')
@section('content')
<div class="content-header">
    <h2 class="content-title">{{ isset($experience) ? 'Edit Experience' : 'Add Experience' }}</h2>
    <a href="{{ route('admin.experience.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<div class="form-card">
    <form action="{{ isset($experience) ? route('admin.experience.update', $experience) : route('admin.experience.store') }}" method="POST">
        @csrf
        @if(isset($experience)) @method('PUT') @endif
        <div class="form-grid">
            <div class="form-group">
                <label>Job Role / Title *</label>
                <input type="text" name="role" value="{{ old('role', $experience->role ?? '') }}" placeholder="DevOps Engineer" required>
            </div>
            <div class="form-group">
                <label>Company / Institution *</label>
                <input type="text" name="company" value="{{ old('company', $experience->company ?? '') }}" placeholder="Hybytes" required>
            </div>
            <div class="form-group">
                <label>Start Date *</label>
                <input type="text" name="start_date" value="{{ old('start_date', $experience->start_date ?? '') }}" placeholder="June 2025" required>
            </div>
            <div class="form-group">
                <label>End Date (leave empty for Present)</label>
                <input type="text" name="end_date" value="{{ old('end_date', $experience->end_date ?? '') }}" placeholder="Present">
            </div>
            <div class="form-group">
                <label>Type</label>
                <select name="type">
                    <option value="Full Time" {{ old('type', $experience->type ?? '') == 'Full Time' ? 'selected' : '' }}>Full Time</option>
                    <option value="Part Time" {{ old('type', $experience->type ?? '') == 'Part Time' ? 'selected' : '' }}>Part Time</option>
                    <option value="Internship" {{ old('type', $experience->type ?? '') == 'Internship' ? 'selected' : '' }}>Internship</option>
                    <option value="Education" {{ old('type', $experience->type ?? '') == 'Education' ? 'selected' : '' }}>Education</option>
                </select>
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $experience->sort_order ?? 0) }}" min="0">
            </div>
            <div class="form-group full-width">
                <label>Description *</label>
                <textarea name="description" rows="6" required>{{ old('description', $experience->description ?? '') }}</textarea>
            </div>
            <div class="form-group full-width">
                <label>Tech Stack (comma-separated)</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack', $experience->tech_stack ?? '') }}" placeholder="AWS, Terraform, GitHub Actions, Docker">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save</button>
            <a href="{{ route('admin.experience.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
