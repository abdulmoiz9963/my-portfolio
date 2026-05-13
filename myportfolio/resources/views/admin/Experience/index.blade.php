@extends('layouts.admin')
@section('page-title', 'Experience')
@section('content')
<div class="content-header">
    <h2 class="content-title">Manage Experience</h2>
    <a href="{{ route('admin.experience.create') }}" class="btn-add"><i class="fas fa-plus"></i> Add Experience</a>
</div>
<div class="data-table-wrap">
    <table class="data-table">
        <thead>
            <tr><th>#</th><th>Role</th><th>Company</th><th>Duration</th><th>Type</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($experiences as $exp)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td><strong>{{ $exp->role }}</strong></td>
                <td>{{ $exp->company }}</td>
                <td>{{ $exp->start_date }} — {{ $exp->end_date ?? 'Present' }}</td>
                <td><span class="type-badge {{ $exp->type == 'Education' ? 'edu' : '' }}">{{ $exp->type ?? 'Full Time' }}</span></td>
                <td>
                    <div class="action-btns">
                        <a href="{{ route('admin.experience.edit', $exp) }}" class="btn-edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.experience.destroy', $exp) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Delete?')"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="empty-row">No experience entries yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
