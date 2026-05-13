@extends('layouts.admin')

@section('page-title', isset($project) ? 'Edit Project' : 'Add Project')

@section('content')
<div class="content-header">
    <h2 class="content-title">{{ isset($project) ? 'Edit Project' : 'Add New Project' }}</h2>
    <a href="{{ route('admin.projects.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="form-card">
    <form action="{{ isset($project) ? route('admin.projects.update', $project) : route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($project)) @method('PUT') @endif

        <div class="form-grid">
            <div class="form-group">
                <label>Project Title *</label>
                <input type="text" name="title" value="{{ old('title', $project->title ?? '') }}" placeholder="e.g. Travel Budgetor" required>
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Category</label>
                <input type="text" name="category" value="{{ old('category', $project->category ?? '') }}" placeholder="e.g. DevOps, Web App">
            </div>

            <div class="form-group full-width">
                <label>Description *</label>
                <textarea name="description" rows="5" placeholder="Describe your project..." required>{{ old('description', $project->description ?? '') }}</textarea>
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label>Tech Stack (comma-separated)</label>
                <input type="text" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack ?? '') }}" placeholder="React.js, Node.js, Docker, AWS, Jenkins">
            </div>

            <div class="form-group">
                <label>Live Demo URL</label>
                <input type="url" name="live_url" value="{{ old('live_url', $project->live_url ?? '') }}" placeholder="https://example.com">
            </div>

            <div class="form-group">
                <label>GitHub URL</label>
                <input type="url" name="github_url" value="{{ old('github_url', $project->github_url ?? '') }}" placeholder="https://github.com/...">
            </div>

            <div class="form-group full-width">
                <label>Project Image</label>
                @if(isset($project) && $project->image)
                    <div class="current-img">
                        <img src="{{ asset('storage/'.$project->image) }}" alt="Current Image">
                        <p>Current image. Upload new to replace.</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" id="imageInput">
                <div class="img-preview" id="imgPreview"></div>
            </div>

            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" min="0">
            </div>

            <div class="form-group checkbox-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>
                    <span>Mark as Featured Project</span>
                </label>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> {{ isset($project) ? 'Update Project' : 'Save Project' }}
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('imageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        document.getElementById('imgPreview').innerHTML = `<img src="${e.target.result}" alt="Preview">`;
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
