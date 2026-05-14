@extends('layouts.admin')

@section('page-title', 'Projects')

@section('content')
<div class="content-header">
    <h2 class="content-title">Manage Projects</h2>
    <a href="{{ route('admin.projects.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Add New Project
    </a>
</div>

<div class="data-table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Tech Stack</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($project->image)
                    <img src="{{ $project->image }}" alt="img" class="table-thumb">
                    @else
                    <div class="table-thumb-placeholder"><i class="fas fa-image"></i></div>
                    @endif
                </td>
                <td>
                    <p class="table-title">{{ $project->title }}</p>
                    <p class="table-sub">{{ Str::limit($project->description, 60) }}</p>
                </td>
                <td><span class="tech-mini">{{ Str::limit($project->tech_stack, 40) }}</span></td>
                <td>
                    @if($project->is_featured)
                    <span class="badge-yes">Yes</span>
                    @else
                    <span class="badge-no">No</span>
                    @endif
                </td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete this project?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="empty-row">No projects found. <a href="{{ route('admin.projects.create') }}">Add your first project!</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
