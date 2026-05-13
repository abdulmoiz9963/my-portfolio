@extends('layouts.admin')

@section('page-title', 'Skills')

@section('content')
<div class="content-header">
    <h2 class="content-title">Manage Skills</h2>
    <a href="{{ route('admin.skills.create') }}" class="btn-add"><i class="fas fa-plus"></i> Add Skill</a>
</div>

<div class="data-table-wrap">
    <table class="data-table">
        <thead>
            <tr>
                <th>#</th><th>Skill Name</th><th>Category</th><th>Icon</th><th>Order</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($skills as $skill)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $skill->name }}</strong></td>
                <td><span class="category-badge">{{ $skill->category }}</span></td>
                <td>{{ $skill->icon ?? '—' }}</td>
                <td>{{ $skill->sort_order }}</td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="btn-edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete this skill?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="empty-row">No skills yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
