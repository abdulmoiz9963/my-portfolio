@extends('layouts.admin')
@section('page-title', 'Upload CV')
@section('content')
<div class="form-card" style="max-width:600px">
    <h3 class="form-section-title"><i class="fas fa-file-pdf"></i> Upload Your CV / Resume</h3>
    <p style="color:var(--muted); margin-bottom:1.5rem;">Upload a PDF file. Visitors will be able to download it from the portfolio.</p>
    <form action="{{ route('admin.cv.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($currentCv)
        <div class="current-cv">
            <i class="fas fa-file-pdf"></i>
            <p>Current CV: <strong>{{ basename($currentCv) }}</strong></p>
            <a href="{{ asset('storage/'.$currentCv) }}" target="_blank" class="btn-edit" style="font-size:.85rem; padding:.3rem .8rem;">Preview</a>
        </div>
        @endif
        <div class="form-group">
            <label>Select PDF File *</label>
            <input type="file" name="cv" accept=".pdf" required>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn-save"><i class="fas fa-upload"></i> Upload CV</button>
        </div>
    </form>
</div>
@endsection
