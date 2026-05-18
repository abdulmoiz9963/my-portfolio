@extends('layouts.admin')

@section('page-title', isset($certification) ? 'Edit Certification' : 'Add Certification')

@section('content')
<div class="content-header">
    <h2 class="content-title">{{ isset($certification) ? 'Edit Certification' : 'Add New Certification' }}</h2>
    <a href="{{ route('admin.certifications.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="form-card">
    <form action="{{ isset($certification) ? route('admin.certifications.update', $certification) : route('admin.certifications.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($certification)) @method('PUT') @endif

        <div class="form-grid">
            <div class="form-group">
                <label>Certification Name *</label>
                <input type="text" name="name" value="{{ old('name', $certification->name ?? '') }}" placeholder="e.g. AWS Solutions Architect" required>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Certificate Number *</label>
                <input type="text" name="certificate_number" value="{{ old('certificate_number', $certification->certificate_number ?? '') }}" placeholder="e.g. CERT-2024-123456" required>
                @error('certificate_number') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Start Date *</label>
                <input type="date" name="start_date" value="{{ old('start_date', $certification->start_date ?? '') }}" required>
                @error('start_date') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Expiry Date</label>
                <input type="date" name="expiry_date" value="{{ old('expiry_date', $certification->expiry_date ?? '') }}">
                @error('expiry_date') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label>Certification Image</label>
                @if(isset($certification) && $certification->image)
                    <div class="current-img">
                        <img src="{{ $certification->image }}" alt="Current Image">
                        <p>Current image. Upload new to replace.</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" id="imageInput">
                <div class="img-preview" id="imgPreview"></div>
            </div>

            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $certification->sort_order ?? 0) }}" min="0">
                @error('sort_order') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> {{ isset($certification) ? 'Update Certification' : 'Save Certification' }}
            </button>
            <a href="{{ route('admin.certifications.index') }}" class="btn-cancel">Cancel</a>
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