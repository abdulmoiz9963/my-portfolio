@extends('layouts.admin')

@section('page-title', 'Dashboard')

@section('content')
<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-icon projects-icon"><i class="fas fa-folder-open"></i></div>
        <div class="stat-info">
            <h3 class="stat-title">Total Projects</h3>
            <p class="stat-value">{{ $stats['projects'] ?? 0 }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon skills-icon"><i class="fas fa-code"></i></div>
        <div class="stat-info">
            <h3 class="stat-title">Total Skills</h3>
            <p class="stat-value">{{ $stats['skills'] ?? 0 }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon exp-icon"><i class="fas fa-briefcase"></i></div>
        <div class="stat-info">
            <h3 class="stat-title">Experience Entries</h3>
            <p class="stat-value">{{ $stats['experience'] ?? 0 }}</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon msg-icon"><i class="fas fa-envelope"></i></div>
        <div class="stat-info">
            <h3 class="stat-title">Messages</h3>
            <p class="stat-value">{{ $stats['messages'] ?? 0 }}</p>
        </div>
    </div>
</div>

<div class="admin-panels">
    <div class="admin-panel">
        <div class="panel-header">
            <h2>Quick Actions</h2>
        </div>
        <div class="quick-actions">
            <a href="{{ route('admin.projects.create') }}" class="quick-action-btn">
                <i class="fas fa-plus"></i> Add Project
            </a>
            <a href="{{ route('admin.skills.create') }}" class="quick-action-btn">
                <i class="fas fa-plus"></i> Add Skill
            </a>
            <a href="{{ route('admin.experience.create') }}" class="quick-action-btn">
                <i class="fas fa-plus"></i> Add Experience
            </a>
            <a href="{{ route('admin.profile.edit') }}" class="quick-action-btn">
                <i class="fas fa-user-edit"></i> Edit Profile
            </a>
            <a href="{{ route('admin.cv.upload') }}" class="quick-action-btn">
                <i class="fas fa-upload"></i> Upload CV
            </a>
            <a href="{{ route('portfolio') }}" target="_blank" class="quick-action-btn outline">
                <i class="fas fa-eye"></i> View Portfolio
            </a>
        </div>
    </div>
    <div class="admin-panel">
        <div class="panel-header">
            <h2>Recent Projects</h2>
            <a href="{{ route('admin.projects.index') }}" class="panel-link">View All</a>
        </div>
        <div class="recent-list">
            @forelse($recentProjects ?? [] as $project)
            <div class="recent-item">
                <div class="recent-info">
                    <p class="recent-title">{{ $project->title }}</p>
                    <p class="recent-meta">{{ Str::limit($project->description, 60) }}</p>
                </div>
                <div class="recent-actions">
                    <a href="{{ route('admin.projects.edit', $project) }}" class="icon-btn"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="icon-btn danger" onclick="return confirm('Delete this project?')"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </div>
            @empty
            <p class="empty-state">No projects yet. <a href="{{ route('admin.projects.create') }}">Add one!</a></p>
            @endforelse
        </div>
    </div>
</div>
@endsection
