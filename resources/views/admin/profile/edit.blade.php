@extends('layouts.admin')

@section('page-title', 'Edit Profile')

@section('content')
<div class="content-header">
    <h2 class="content-title">Edit Your Profile</h2>
</div>

<div class="form-card">
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-section">
            <h3 class="form-section-title"><i class="fas fa-user"></i> Basic Information</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label>Full Name *</label>
                    <input type="text" name="name" value="{{ old('name', $profile->name ?? '') }}" placeholder="Your full name" required>
                    @error('name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Email *</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email ?? '') }}" placeholder="your@email.com" required>
                    @error('email') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" placeholder="+1 (555) 000-0000">
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" value="{{ old('location', $profile->location ?? '') }}" placeholder="City, Country">
                </div>

                <div class="form-group full-width">
                    <label>Professional Tagline</label>
                    <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline ?? '') }}" placeholder="e.g. DevOps Engineer | Cloud Architect">
                </div>

                <div class="form-group full-width">
                    <label>About You</label>
                    <textarea name="about" rows="5" placeholder="Tell visitors about yourself...">{{ old('about', $profile->about ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title"><i class="fas fa-image"></i> Profile Photo</h3>
            <div class="form-grid">
                <div class="form-group full-width">
                    <label>Upload Profile Photo</label>
                    @if($profile->profile_image)
                        <div class="current-img" style="margin-bottom:1rem;">
                            <img src="{{ asset('storage/'.$profile->profile_image) }}" alt="Current Profile Photo">
                            <p>Current photo. Upload new to replace.</p>
                        </div>
                    @endif
                    <input type="file" name="profile_image" accept="image/*" id="profileImageInput">
                    @error('profile_image') <span class="error">{{ $message }}</span> @enderror
                    <div class="img-preview" id="profileImgPreview"></div>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title"><i class="fas fa-link"></i> Social Links</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label>LinkedIn Profile</label>
                    <input type="url" name="linkedin" value="{{ old('linkedin', $profile->linkedin ?? '') }}" placeholder="https://linkedin.com/in/yourprofile">
                </div>

                <div class="form-group">
                    <label>GitHub Profile</label>
                    <input type="url" name="github" value="{{ old('github', $profile->github ?? '') }}" placeholder="https://github.com/yourprofile">
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Save Profile
            </button>
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('profileImageInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
        document.getElementById('profileImgPreview').innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width:200px; margin-top:1rem; border-radius:8px;">`;
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
