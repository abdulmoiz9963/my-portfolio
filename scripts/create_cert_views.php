<?php
// This file creates the necessary blade template files for certifications
$baseDir = __DIR__ . '/../resources/views/admin/certifications';
@mkdir($baseDir, 0755, true);

$indexContent = <<<'BLADE'
@extends('layouts.admin')

@section('page-title', 'Certifications')

@section('content')
<div class="content-header">
    <h2 class="content-title">Manage Certifications</h2>
    <a href="{{ route('admin.certifications.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Add Certification
    </a>
</div>

<div class="data-table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Certificate #</th>
                <th>Start Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($certifications as $certification)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($certification->image)
                    <img src="{{ $certification->image }}" alt="img" class="table-thumb">
                    @else
                    <div class="table-thumb-placeholder"><i class="fas fa-image"></i></div>
                    @endif
                </td>
                <td>
                    <p class="table-title">{{ $certification->name }}</p>
                </td>
                <td>
                    <span class="badge-info">{{ $certification->certificate_number }}</span>
                </td>
                <td>{{ $certification->start_date }}</td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.certifications.edit', $certification) }}" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.certifications.destroy', $certification) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete this certification?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="empty-row">No certifications found. <a href="{{ route('admin.certifications.create') }}">Add your first certification!</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
BLADE;

$formContent = <<<'BLADE'
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
                <input type="text" name="certificate_number" value="{{ old('certificate_number', $certification->certificate_number ?? '') }}" placeholder="e.g. AWS-12345678" required>
                @error('certificate_number') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Start Date *</label>
                <input type="date" name="start_date" value="{{ old('start_date', $certification->start_date ?? '') }}" required>
                @error('start_date') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Expiry Date (Optional)</label>
                <input type="date" name="expiry_date" value="{{ old('expiry_date', $certification->expiry_date ?? '') }}">
                @error('expiry_date') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $certification->sort_order ?? 0) }}" min="0">
                @error('sort_order') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group full-width">
                <label>Certificate Image</label>
                @if(isset($certification) && $certification->image)
                    <div class="current-img">
                        <img src="{{ $certification->image }}" alt="Current Image">
                        <p>Current image. Upload new to replace.</p>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*" id="imageInput">
                <div class="img-preview" id="imgPreview"></div>
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
BLADE;

file_put_contents($baseDir . '/index.blade.php', $indexContent);
echo "Created: " . $baseDir . '/index.blade.php' . PHP_EOL;

file_put_contents($baseDir . '/form.blade.php', $formContent);
echo "Created: " . $baseDir . '/form.blade.php' . PHP_EOL;

echo "All files created successfully!" . PHP_EOL;
