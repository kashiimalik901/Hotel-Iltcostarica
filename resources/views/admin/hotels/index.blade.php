@extends('admin.layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Hotels</h1>
    <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i>
        Add New Hotel
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">All Hotels</h5>
    </div>
    <div class="card-body">
        @if($hotels->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Destination</th>
                            <th>Category</th>
                            <th>Total Rooms</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hotels as $hotel)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($hotel->primaryImage)
                                        <img src="{{ asset('storage/' . $hotel->primaryImage->image_url) }}" alt="{{ $hotel->name }}" 
                                             class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-hotel text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <h6 class="mb-0">{{ $hotel->name }}</h6>
                                        <small class="text-muted">{{ $hotel->city }}, {{ $hotel->country }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $hotel->destination->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $hotel->category->name }}</span>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark">{{ $hotel->total_rooms }} rooms</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $hotel->status === 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($hotel->status) }}
                                </span>
                            </td>
                            <td>
                                @if($hotel->featured)
                                    <span class="badge bg-warning">
                                        <i class="fas fa-star"></i> Featured
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.hotels.show', $hotel->id) }}" 
                                       class="btn btn-sm btn-outline-primary" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.hotels.edit', $hotel->id) }}" 
                                       class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this hotel?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $hotels->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-hotel fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No hotels found</h5>
                <p class="text-muted">Get started by adding your first hotel.</p>
                <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    Add First Hotel
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
