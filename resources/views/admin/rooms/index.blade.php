@extends('admin.layouts.app')

@section('content')
<div class="card mb-3">
  <div class="card-header">
    <div class="row flex-between-end">
      <div class="col-auto align-self-center">
        <h5 class="mb-0 text-nowrap py-2 py-xl-0">Rooms Management</h5>
      </div>
      <div class="col-auto ms-auto">
        <a class="btn btn-falcon-primary btn-sm" href="{{ route('admin.rooms.create') }}">
          <i class="fas fa-plus me-1"></i>Add New Room
        </a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <!-- Search and Filter Bar -->
    <div class="row g-3 mb-3">
      <div class="col-sm-6 col-md-4">
        <div class="search-box">
          <input class="form-control search-input" type="search" placeholder="Search rooms..." id="searchInput" />
          <i class="fas fa-search search-box-icon"></i>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <select class="form-select" id="hotelFilter">
          <option value="">All Hotels</option>
          @foreach($hotels ?? [] as $hotel)
            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-6 col-md-3">
        <select class="form-select" id="statusFilter">
          <option value="">All Status</option>
          <option value="available">Available</option>
          <option value="occupied">Occupied</option>
          <option value="maintenance">Maintenance</option>
        </select>
      </div>
      <div class="col-sm-6 col-md-2">
        <button class="btn btn-falcon-default btn-sm w-100" type="button" id="clearFilters">
          <i class="fas fa-times me-1"></i>Clear
        </button>
      </div>
    </div>

    <!-- Rooms Table -->
    <div class="table-responsive scrollbar">
      <table class="table table-bordered table-striped fs--1 mb-0" id="roomsTable">
        <thead class="bg-200 text-900">
          <tr>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="room_number">
              <i class="fas fa-sort me-1"></i>Room Number
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="hotel">
              <i class="fas fa-sort me-1"></i>Hotel
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="type">
              <i class="fas fa-sort me-1"></i>Type
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="capacity">
              <i class="fas fa-sort me-1"></i>Capacity
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="price">
              <i class="fas fa-sort me-1"></i>Base Price
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="status">
              <i class="fas fa-sort me-1"></i>Status
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="actions">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="list" id="roomsTableBody">
          @forelse($rooms ?? [] as $room)
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-2xl me-3">
                  @if($room->images && count($room->images) > 0)
                    <img class="rounded-soft" src="{{ asset('storage/' . $room->images->first()->image_url) }}" alt="{{ $room->room_name }}" />
                  @else
                    <div class="avatar-name rounded-soft bg-soft-primary">
                      <span class="fs-0 text-primary">{{ substr($room->room_name, 0, 2) }}</span>
                    </div>
                  @endif
                </div>
                <div class="flex-1">
                  <h6 class="mb-0 fw-semi-bold">
                    <a class="text-900" href="{{ route('admin.rooms.show', $room->id) }}">
                      {{ $room->room_name }}
                    </a>
                  </h6>
                  <small class="text-500">{{ $room->room_type }}</small>
                </div>
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-2xl me-3">
                  @if($room->hotel && $room->hotel->images && count($room->hotel->images) > 0)
                    <img class="rounded-soft" src="{{ asset('storage/' . $room->hotel->images->first()->image_url) }}" alt="{{ $room->hotel->name }}" />
                  @else
                    <div class="avatar-name rounded-soft bg-soft-info">
                      <span class="fs-0 text-info">{{ substr($room->hotel->name ?? 'N/A', 0, 2) }}</span>
                    </div>
                  @endif
                </div>
                <div class="flex-1">
                  <h6 class="mb-0 fw-semi-bold">{{ $room->hotel->name ?? 'N/A' }}</h6>
                  <small class="text-500">{{ $room->hotel->city ?? 'N/A' }}</small>
                </div>
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              <span class="badge badge-soft-primary">{{ $room->room_type }}</span>
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <i class="fas fa-user me-2 text-500"></i>
                <span>{{ $room->capacity_adults ?? 0 }} Adults</span>
                @if(($room->capacity_children ?? 0) > 0)
                  <span class="ms-2 text-500">+ {{ $room->capacity_children }} Children</span>
                @endif
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <span class="fw-semi-bold text-900">${{ number_format($room->base_price ?? 0, 2) }}</span>
                <small class="text-500 ms-1">{{ $room->currency ?? 'USD' }}</small>
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              @if(($room->status ?? 'available') === 'available')
                <span class="badge badge-soft-success">
                  <i class="fas fa-check-circle me-1"></i>Available
                </span>
              @elseif(($room->status ?? 'available') === 'occupied')
                <span class="badge badge-soft-warning">
                  <i class="fas fa-user-check me-1"></i>Occupied
                </span>
              @elseif(($room->status ?? 'available') === 'maintenance')
                <span class="badge badge-soft-danger">
                  <i class="fas fa-tools me-1"></i>Maintenance
                </span>
              @else
                <span class="badge badge-soft-secondary">
                  <i class="fas fa-question-circle me-1"></i>{{ ucfirst($room->status ?? 'unknown') }}
                </span>
              @endif
            </td>
            <td class="align-middle white-space-nowrap text-end">
              <div class="dropdown font-sans-serif position-static">
                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="roomActions{{ $room->id }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-h fs--1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="roomActions{{ $room->id }}">
                  <a class="dropdown-item" href="{{ route('admin.rooms.show', $room->id) }}">
                    <i class="fas fa-eye me-1"></i>View Details
                  </a>
                  <a class="dropdown-item" href="{{ route('admin.rooms.edit', $room->id) }}">
                    <i class="fas fa-edit me-1"></i>Edit Room
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-warning" href="{{ route('admin.rooms.edit', $room->id) }}#pricing">
                    <i class="fas fa-dollar-sign me-1"></i>Manage Pricing
                  </a>
                  <a class="dropdown-item text-info" href="{{ route('admin.rooms.edit', $room->id) }}#availability">
                    <i class="fas fa-calendar-alt me-1"></i>Set Availability
                  </a>
                  <div class="dropdown-divider"></div>
                  <form method="POST" action="{{ route('admin.rooms.destroy', $room->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this room?')">
                      <i class="fas fa-trash me-1"></i>Delete Room
                    </button>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-4">
              <div class="text-center">
                <img src="{{ asset('falcon/assets/img/icons/spot-illustrations/empty-state.svg') }}" alt="" width="100" class="mb-3" />
                <h5 class="text-900">No rooms found</h5>
                <p class="text-500">Get started by creating your first room.</p>
                <a class="btn btn-falcon-primary btn-sm" href="{{ route('admin.rooms.create') }}">
                  <i class="fas fa-plus me-1"></i>Add New Room
                </a>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if(isset($rooms) && $rooms->hasPages())
    <div class="card-footer d-flex align-items-center justify-content-center">
      {{ $rooms->links() }}
    </div>
    @endif
  </div>
</div>

<!-- Quick Stats Cards -->
<div class="row g-3 mb-3">
  <div class="col-sm-6 col-md-3">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-1.png') }});"></div>
      <div class="card-body position-relative">
        <h6>Total Rooms</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-primary">{{ $totalRooms ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.rooms.index') }}">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-2.png') }});"></div>
      <div class="card-body position-relative">
        <h6>Available</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-success">{{ $availableRooms ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.rooms.index') }}?status=available">View available<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-3.png') }});"></div>
      <div class="card-body position-relative">
        <h6>Occupied</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">{{ $occupiedRooms ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.rooms.index') }}?status=occupied">View occupied<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
      <div class="card-body position-relative">
        <h6>Maintenance</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-danger">{{ $maintenanceRooms ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.rooms.index') }}?status=maintenance">View maintenance<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Search functionality
  const searchInput = document.getElementById('searchInput');
  const roomsTableBody = document.getElementById('roomsTableBody');
  
  searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = roomsTableBody.querySelectorAll('tr');
    
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
  });
  
  // Filter functionality
  const hotelFilter = document.getElementById('hotelFilter');
  const statusFilter = document.getElementById('statusFilter');
  const clearFilters = document.getElementById('clearFilters');
  
  function applyFilters() {
    const hotelValue = hotelFilter.value;
    const statusValue = statusFilter.value;
    const rows = roomsTableBody.querySelectorAll('tr');
    
    rows.forEach(row => {
      let showRow = true;
      
      if (hotelValue) {
        const hotelCell = row.querySelector('td:nth-child(2)');
        if (hotelCell && !hotelCell.textContent.includes(hotelValue)) {
          showRow = false;
        }
      }
      
      if (statusValue && showRow) {
        const statusCell = row.querySelector('td:nth-child(6)');
        if (statusCell && !statusCell.textContent.toLowerCase().includes(statusValue)) {
          showRow = false;
        }
      }
      
      row.style.display = showRow ? '' : 'none';
    });
  }
  
  hotelFilter.addEventListener('change', applyFilters);
  statusFilter.addEventListener('change', applyFilters);
  
  clearFilters.addEventListener('click', function() {
    hotelFilter.value = '';
    statusFilter.value = '';
    searchInput.value = '';
    applyFilters();
    
    // Show all rows
    const rows = roomsTableBody.querySelectorAll('tr');
    rows.forEach(row => {
      row.style.display = '';
    });
  });
});
</script>
@endpush
