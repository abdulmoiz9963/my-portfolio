@extends('layouts.admin')
@section('page-title', isset($skill) ? 'Edit Skill' : 'Add Skill')
@section('content')
<div class="content-header">
    <h2 class="content-title">{{ isset($skill) ? 'Edit Skill' : 'Add New Skill' }}</h2>
    <a href="{{ route('admin.skills.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<div class="form-card">
    <form action="{{ isset($skill) ? route('admin.skills.update', $skill) : route('admin.skills.store') }}" method="POST">
        @csrf
        @if(isset($skill)) @method('PUT') @endif
        <div class="form-grid">
            <div class="form-group">
                <label>Skill Name *</label>
                <input type="text" name="name" value="{{ old('name', $skill->name ?? '') }}" placeholder="e.g. Docker" required>
            </div>
            <div class="form-group">
                <label>Category *</label>
                <input type="text" name="category" value="{{ old('category', $skill->category ?? '') }}" placeholder="e.g. Cloud & AWS, CI/CD, Containerization" required list="categories">
                <datalist id="categories">
                    <option value="Cloud & AWS">
                    <option value="CI/CD">
                    <option value="Containerization">
                    <option value="Infrastructure as Code">
                    <option value="Monitoring & Logging">
                    <option value="Version Control">
                </datalist>
            </div>
            <div class="form-group">
                <label>Icon Class (FontAwesome)</label>
                <input type="text" name="icon" value="{{ old('icon', $skill->icon ?? '') }}" placeholder="fab fa-docker">
            </div>
            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order ?? 0) }}" min="0">
            </div>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-save"><i class="fas fa-save"></i> Save Skill</button>
            <a href="{{ route('admin.skills.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
