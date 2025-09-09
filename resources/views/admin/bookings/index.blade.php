@extends('admin.layouts.app')

@section('content')
<div class="card mb-3">
  <div class="card-header">
    <div class="row flex-between-end">
      <div class="col-auto align-self-center">
        <h5 class="mb-0 text-nowrap py-2 py-xl-0">Bookings Management</h5>
      </div>
      <div class="col-auto ms-auto">
        <a class="btn btn-falcon-primary btn-sm" href="{{ route('admin.bookings.create') }}">
          <i class="fas fa-plus me-1"></i>Create New Booking
        </a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <!-- Search and Filter Bar -->
    <div class="row g-3 mb-3">
      <div class="col-sm-6 col-md-3">
        <div class="search-box">
          <input class="form-control search-input" type="search" placeholder="Search bookings..." id="searchInput" />
          <i class="fas fa-search search-box-icon"></i>
        </div>
      </div>
      <div class="col-sm-6 col-md-2">
        <select class="form-select" id="statusFilter">
          <option value="">All Status</option>
          <option value="pending">Pending</option>
          <option value="confirmed">Confirmed</option>
          <option value="checked_in">Checked In</option>
          <option value="checked_out">Checked Out</option>
          <option value="cancelled">Cancelled</option>
        </select>
      </div>
      <div class="col-sm-6 col-md-2">
        <select class="form-select" id="hotelFilter">
          <option value="">All Hotels</option>
          @foreach($hotels ?? [] as $hotel)
            <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-6 col-md-2">
        <input type="date" class="form-control" id="dateFilter" placeholder="Filter by date">
      </div>
      <div class="col-sm-6 col-md-2">
        <button class="btn btn-falcon-default btn-sm w-100" type="button" id="clearFilters">
          <i class="fas fa-times me-1"></i>Clear
        </button>
      </div>
    </div>

    <!-- Bookings Table -->
    <div class="table-responsive scrollbar">
      <table class="table table-bordered table-striped fs--1 mb-0" id="bookingsTable">
        <thead class="bg-200 text-900">
          <tr>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="booking_ref">
              <i class="fas fa-sort me-1"></i>Booking Ref
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="customer">
              <i class="fas fa-sort me-1"></i>Customer
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="hotel_room">
              <i class="fas fa-sort me-1"></i>Hotel & Room
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="dates">
              <i class="fas fa-sort me-1"></i>Check In/Out
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="guests">
              <i class="fas fa-sort me-1"></i>Guests
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="total">
              <i class="fas fa-sort me-1"></i>Total Amount
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="status">
              <i class="fas fa-sort me-1"></i>Status
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="actions">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="list" id="bookingsTableBody">
          @forelse($bookings ?? [] as $booking)
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-2xl me-3">
                  <div class="avatar-name rounded-soft bg-soft-primary">
                    <span class="fs-0 text-primary">{{ substr($booking->booking_reference, 0, 2) }}</span>
                  </div>
                </div>
                <div class="flex-1">
                  <h6 class="mb-0 fw-semi-bold">
                    <a class="text-900" href="{{ route('admin.bookings.show', $booking->id) }}">
                      {{ $booking->booking_reference }}
                    </a>
                  </h6>
                  <small class="text-500">{{ $booking->created_at->format('M d, Y') }}</small>
                </div>
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-2xl me-3">
                  <div class="avatar-name rounded-soft bg-soft-info">
                    <span class="fs-0 text-info">{{ substr($booking->customer->first_name ?? 'N/A', 0, 1) }}{{ substr($booking->customer->last_name ?? 'N/A', 0, 1) }}</span>
                  </div>
                </div>
                <div class="flex-1">
                  <h6 class="mb-0 fw-semi-bold">
                    {{ $booking->customer->first_name ?? 'N/A' }} {{ $booking->customer->last_name ?? 'N/A' }}
                  </h6>
                  <small class="text-500">{{ $booking->customer->email ?? 'N/A' }}</small>
                </div>
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-2xl me-3">
                  @if($booking->hotel && $booking->hotel->images && count($booking->hotel->images) > 0)
                    <img class="rounded-soft" src="{{ asset('storage/' . $booking->hotel->images->first()->image_url) }}" alt="{{ $booking->hotel->name }}" />
                  @else
                    <div class="avatar-name rounded-soft bg-soft-warning">
                      <span class="fs-0 text-warning">{{ substr($booking->hotel->name ?? 'N/A', 0, 2) }}</span>
                    </div>
                  @endif
                </div>
                <div class="flex-1">
                  <h6 class="mb-0 fw-semi-bold">{{ $booking->hotel->name ?? 'N/A' }}</h6>
                  <small class="text-500">{{ $booking->room->room_name ?? 'N/A' }} - {{ $booking->room->room_type ?? 'N/A' }}</small>
                </div>
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex flex-column">
                <div class="d-flex align-items-center mb-1">
                  <i class="fas fa-sign-in-alt me-2 text-success"></i>
                  <span class="fw-semi-bold">{{ $booking->check_in_date ? $booking->check_in_date->format('M d, Y') : 'N/A' }}</span>
                </div>
                <div class="d-flex align-items-center">
                  <i class="fas fa-sign-out-alt me-2 text-danger"></i>
                  <span class="fw-semi-bold">{{ $booking->check_out_date ? $booking->check_out_date->format('M d, Y') : 'N/A' }}</span>
                </div>
                <small class="text-500 mt-1">{{ $booking->nights ?? 0 }} nights</small>
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <i class="fas fa-users me-2 text-500"></i>
                <span>{{ $booking->guests_adults ?? 0 }} Adults</span>
                @if(($booking->guests_children ?? 0) > 0)
                  <span class="ms-2 text-500">+ {{ $booking->guests_children }} Children</span>
                @endif
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <span class="fw-semi-bold text-900">${{ number_format($booking->total_price ?? 0, 2) }}</span>
                <small class="text-500 ms-1">{{ $booking->currency ?? 'USD' }}</small>
              </div>
              @if($booking->payment_status)
                <small class="badge badge-soft-{{ $booking->payment_status === 'paid' ? 'success' : ($booking->payment_status === 'pending' ? 'warning' : 'danger') }}">
                  {{ ucfirst($booking->payment_status) }}
                </small>
              @endif
            </td>
            <td class="align-middle white-space-nowrap">
              @if(($booking->status ?? 'pending') === 'pending')
                <span class="badge badge-soft-warning">
                  <i class="fas fa-clock me-1"></i>Pending
                </span>
              @elseif(($booking->status ?? 'pending') === 'confirmed')
                <span class="badge badge-soft-info">
                  <i class="fas fa-check-circle me-1"></i>Confirmed
                </span>
              @elseif(($booking->status ?? 'pending') === 'checked_in')
                <span class="badge badge-soft-success">
                  <i class="fas fa-sign-in-alt me-1"></i>Checked In
                </span>
              @elseif(($booking->status ?? 'pending') === 'checked_out')
                <span class="badge badge-soft-secondary">
                  <i class="fas fa-sign-out-alt me-1"></i>Checked Out
                </span>
              @elseif(($booking->status ?? 'pending') === 'cancelled')
                <span class="badge badge-soft-danger">
                  <i class="fas fa-times-circle me-1"></i>Cancelled
                </span>
              @else
                <span class="badge badge-soft-secondary">
                  <i class="fas fa-question-circle me-1"></i>{{ ucfirst($booking->status ?? 'unknown') }}
                </span>
              @endif
            </td>
            <td class="align-middle white-space-nowrap text-end">
              <div class="dropdown font-sans-serif position-static">
                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="bookingActions{{ $booking->id }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-h fs--1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="bookingActions{{ $booking->id }}">
                  <a class="dropdown-item" href="{{ route('admin.bookings.show', $booking->id) }}">
                    <i class="fas fa-eye me-1"></i>View Details
                  </a>
                  <a class="dropdown-item" href="{{ route('admin.bookings.edit', $booking->id) }}">
                    <i class="fas fa-edit me-1"></i>Edit Booking
                  </a>
                  <div class="dropdown-divider"></div>
                  @if(($booking->status ?? 'pending') === 'pending')
                    <a class="dropdown-item text-success" href="#" onclick="confirmBooking({{ $booking->id }})">
                      <i class="fas fa-check me-1"></i>Confirm Booking
                    </a>
                  @endif
                  @if(($booking->status ?? 'pending') === 'confirmed')
                    <a class="dropdown-item text-info" href="#" onclick="checkIn({{ $booking->id }})">
                      <i class="fas fa-sign-in-alt me-1"></i>Check In
                    </a>
                  @endif
                  @if(($booking->status ?? 'pending') === 'checked_in')
                    <a class="dropdown-item text-warning" href="#" onclick="checkOut({{ $booking->id }})">
                      <i class="fas fa-sign-out-alt me-1"></i>Check Out
                    </a>
                  @endif
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-primary" href="#" onclick="sendConfirmation({{ $booking->id }})">
                    <i class="fas fa-envelope me-1"></i>Send Confirmation
                  </a>
                  <a class="dropdown-item text-warning" href="#" onclick="managePayment({{ $booking->id }})">
                    <i class="fas fa-credit-card me-1"></i>Manage Payment
                  </a>
                  <div class="dropdown-divider"></div>
                  <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this booking?')">
                      <i class="fas fa-trash me-1"></i>Delete Booking
                    </button>
                  </form>
                </div>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="8" class="text-center py-4">
              <div class="text-center">
                <img src="{{ asset('falcon/assets/img/icons/spot-illustrations/empty-state.svg') }}" alt="" width="100" class="mb-3" />
                <h5 class="text-900">No bookings found</h5>
                <p class="text-500">Get started by creating your first booking.</p>
                <a class="btn btn-falcon-primary btn-sm" href="{{ route('admin.bookings.create') }}">
                  <i class="fas fa-plus me-1"></i>Create New Booking
                </a>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if(isset($bookings) && $bookings->hasPages())
    <div class="card-footer d-flex align-items-center justify-content-center">
      {{ $bookings->links() }}
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
        <h6>Total Bookings</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-primary">{{ $totalBookings ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.bookings.index') }}">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-2.png') }});"></div>
      <div class="card-body position-relative">
        <h6>Pending</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">{{ $pendingBookings ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.bookings.index') }}?status=pending">View pending<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-3.png') }});"></div>
      <div class="card-body position-relative">
        <h6>Confirmed</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-info">{{ $confirmedBookings ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.bookings.index') }}?status=confirmed">View confirmed<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
      <div class="card-body position-relative">
        <h6>Revenue</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-success">${{ number_format($totalRevenue ?? 0, 2) }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.bookings.index') }}">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
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
  const bookingsTableBody = document.getElementById('bookingsTableBody');
  
  searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = bookingsTableBody.querySelectorAll('tr');
    
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
  });
  
  // Filter functionality
  const statusFilter = document.getElementById('statusFilter');
  const hotelFilter = document.getElementById('hotelFilter');
  const dateFilter = document.getElementById('dateFilter');
  const clearFilters = document.getElementById('clearFilters');
  
  function applyFilters() {
    const statusValue = statusFilter.value;
    const hotelValue = hotelFilter.value;
    const dateValue = dateFilter.value;
    const rows = bookingsTableBody.querySelectorAll('tr');
    
    rows.forEach(row => {
      let showRow = true;
      
      if (statusValue) {
        const statusCell = row.querySelector('td:nth-child(7)');
        if (statusCell && !statusCell.textContent.toLowerCase().includes(statusValue)) {
          showRow = false;
        }
      }
      
      if (hotelValue && showRow) {
        const hotelCell = row.querySelector('td:nth-child(3)');
        if (hotelCell && !hotelCell.textContent.includes(hotelValue)) {
          showRow = false;
        }
      }
      
      if (dateValue && showRow) {
        const dateCell = row.querySelector('td:nth-child(4)');
        if (dateCell && !dateCell.textContent.includes(dateValue)) {
          showRow = false;
        }
      }
      
      row.style.display = showRow ? '' : 'none';
    });
  }
  
  statusFilter.addEventListener('change', applyFilters);
  hotelFilter.addEventListener('change', applyFilters);
  dateFilter.addEventListener('change', applyFilters);
  
  clearFilters.addEventListener('click', function() {
    statusFilter.value = '';
    hotelFilter.value = '';
    dateFilter.value = '';
    searchInput.value = '';
    applyFilters();
    
    // Show all rows
    const rows = bookingsTableBody.querySelectorAll('tr');
    rows.forEach(row => {
      row.style.display = '';
    });
  });
});

// Action functions
function confirmBooking(bookingId) {
  if (confirm('Are you sure you want to confirm this booking?')) {
    // Implement confirmation logic
    console.log('Confirming booking:', bookingId);
  }
}

function checkIn(bookingId) {
  if (confirm('Are you sure you want to check in this guest?')) {
    // Implement check-in logic
    console.log('Checking in booking:', bookingId);
  }
}

function checkOut(bookingId) {
  if (confirm('Are you sure you want to check out this guest?')) {
    // Implement check-out logic
    console.log('Checking out booking:', bookingId);
  }
}

function sendConfirmation(bookingId) {
  if (confirm('Send confirmation email to the guest?')) {
    // Implement email sending logic
    console.log('Sending confirmation for booking:', bookingId);
  }
}

function managePayment(bookingId) {
  // Implement payment management logic
  console.log('Managing payment for booking:', bookingId);
}
</script>
@endpush
