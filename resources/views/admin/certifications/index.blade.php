@extends('layouts.admin')

@section('page-title', 'Certifications')

@section('content')
<div class="content-header">
    <h2 class="content-title">Manage Certifications</h2>
    <a href="{{ route('admin.certifications.create') }}" class="btn-add">
        <i class="fas fa-plus"></i> Add New Certification
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
                <td><span class="badge-info">{{ $certification->certificate_number }}</span></td>
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