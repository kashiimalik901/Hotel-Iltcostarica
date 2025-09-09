@extends('admin.layouts.app')

@section('content')
<div class="card mb-3">
  <div class="card-header">
    <div class="row flex-between-end">
      <div class="col-auto align-self-center">
        <h5 class="mb-0 text-nowrap py-2 py-xl-0">Customers Management</h5>
      </div>
      <div class="col-auto ms-auto">
        <a class="btn btn-falcon-primary btn-sm" href="{{ route('admin.customers.create') }}">
          <i class="fas fa-plus me-1"></i>Add New Customer
        </a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <!-- Search and Filter Bar -->
    <div class="row g-3 mb-3">
      <div class="col-sm-6 col-md-4">
        <div class="search-box">
          <input class="form-control search-input" type="search" placeholder="Search customers..." id="searchInput" />
          <i class="fas fa-search search-box-icon"></i>
        </div>
      </div>
      <div class="col-sm-6 col-md-3">
        <select class="form-select" id="countryFilter">
          <option value="">All Countries</option>
          @foreach($countries ?? [] as $country)
            <option value="{{ $country }}">{{ $country }}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-6 col-md-3">
        <select class="form-select" id="statusFilter">
          <option value="">All Status</option>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
          <option value="vip">VIP</option>
        </select>
      </div>
      <div class="col-sm-6 col-md-2">
        <button class="btn btn-falcon-default btn-sm w-100" type="button" id="clearFilters">
          <i class="fas fa-times me-1"></i>Clear
        </button>
      </div>
    </div>

    <!-- Customers Table -->
    <div class="table-responsive scrollbar">
      <table class="table table-bordered table-striped fs--1 mb-0" id="customersTable">
        <thead class="bg-200 text-900">
          <tr>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="customer">
              <i class="fas fa-sort me-1"></i>Customer
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="contact">
              <i class="fas fa-sort me-1"></i>Contact Info
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="location">
              <i class="fas fa-sort me-1"></i>Location
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="bookings">
              <i class="fas fa-sort me-1"></i>Total Bookings
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="spent">
              <i class="fas fa-sort me-1"></i>Total Spent
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="last_visit">
              <i class="fas fa-sort me-1"></i>Last Visit
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="status">
              <i class="fas fa-sort me-1"></i>Status
            </th>
            <th class="text-900 sort pe-1 align-middle white-space-nowrap" data-sort="actions">
              Actions
            </th>
          </tr>
        </thead>
        <tbody class="list" id="customersTableBody">
          @forelse($customers ?? [] as $customer)
          <tr>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-2xl me-3">
                  <div class="avatar-name rounded-soft bg-soft-primary">
                    <span class="fs-0 text-primary">{{ substr($customer->first_name, 0, 1) }}{{ substr($customer->last_name, 0, 1) }}</span>
                  </div>
                </div>
                <div class="flex-1">
                  <h6 class="mb-0 fw-semi-bold">
                    <a class="text-900" href="{{ route('admin.customers.show', $customer->id) }}">
                      {{ $customer->first_name }} {{ $customer->last_name }}
                    </a>
                  </h6>
                  <small class="text-500">ID: {{ $customer->id }}</small>
                </div>
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex flex-column">
                <div class="d-flex align-items-center mb-1">
                  <i class="fas fa-envelope me-2 text-info"></i>
                  <span class="fw-semi-bold">{{ $customer->email }}</span>
                </div>
                <div class="d-flex align-items-center">
                  <i class="fas fa-phone me-2 text-success"></i>
                  <span class="fw-semi-bold">{{ $customer->phone ?? 'N/A' }}</span>
                </div>
                @if($customer->whatsapp)
                <div class="d-flex align-items-center">
                  <i class="fab fa-whatsapp me-2 text-success"></i>
                  <span class="fw-semi-bold">{{ $customer->whatsapp }}</span>
                </div>
                @endif
              </div>
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <i class="fas fa-map-marker-alt me-2 text-danger"></i>
                <span>{{ $customer->country ?? 'N/A' }}</span>
              </div>
              @if($customer->date_of_birth)
              <small class="text-500 d-block mt-1">
                <i class="fas fa-birthday-cake me-1"></i>
                {{ $customer->date_of_birth->format('M d, Y') }}
              </small>
              @endif
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <i class="fas fa-calendar-check me-2 text-primary"></i>
                <span class="fw-semi-bold">{{ $customer->bookings_count ?? 0 }}</span>
              </div>
              @if($customer->bookings_count > 0)
              <small class="text-500 d-block mt-1">
                <a href="{{ route('admin.bookings.index') }}?customer_id={{ $customer->id }}" class="text-decoration-none">
                  View Bookings
                </a>
              </small>
              @endif
            </td>
            <td class="align-middle white-space-nowrap">
              <div class="d-flex align-items-center">
                <span class="fw-semi-bold text-900">${{ number_format($customer->total_spent ?? 0, 2) }}</span>
                <small class="text-500 ms-1">USD</small>
              </div>
              @if($customer->total_spent > 1000)
              <small class="badge badge-soft-success mt-1">VIP Customer</small>
              @endif
            </td>
            <td class="align-middle white-space-nowrap">
              @if($customer->last_visit_date)
                <div class="d-flex align-items-center">
                  <i class="fas fa-clock me-2 text-warning"></i>
                  <span class="fw-semi-bold">{{ $customer->last_visit_date->format('M d, Y') }}</span>
                </div>
                <small class="text-500 d-block mt-1">
                  {{ $customer->last_visit_date->diffForHumans() }}
                </small>
              @else
                <span class="text-muted">No visits yet</span>
              @endif
            </td>
            <td class="align-middle white-space-nowrap">
              @if(($customer->total_spent ?? 0) > 1000)
                <span class="badge badge-soft-warning">
                  <i class="fas fa-crown me-1"></i>VIP
                </span>
              @elseif($customer->bookings_count > 0)
                <span class="badge badge-soft-success">
                  <i class="fas fa-check-circle me-1"></i>Active
                </span>
              @else
                <span class="badge badge-soft-secondary">
                  <i class="fas fa-user me-1"></i>New
                </span>
              @endif
            </td>
            <td class="align-middle white-space-nowrap text-end">
              <div class="dropdown font-sans-serif position-static">
                <button class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal" type="button" id="customerActions{{ $customer->id }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fas fa-ellipsis-h fs--1"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="customerActions{{ $customer->id }}">
                  <a class="dropdown-item" href="{{ route('admin.customers.show', $customer->id) }}">
                    <i class="fas fa-eye me-1"></i>View Details
                  </a>
                  <a class="dropdown-item" href="{{ route('admin.customers.edit', $customer->id) }}">
                    <i class="fas fa-edit me-1"></i>Edit Customer
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-primary" href="{{ route('admin.bookings.create') }}?customer_id={{ $customer->id }}">
                    <i class="fas fa-calendar-plus me-1"></i>Create Booking
                  </a>
                  <a class="dropdown-item text-info" href="#" onclick="sendMessage({{ $customer->id }})">
                    <i class="fas fa-envelope me-1"></i>Send Message
                  </a>
                  <div class="dropdown-divider"></div>
                  @if(($customer->total_spent ?? 0) > 1000)
                    <a class="dropdown-item text-warning" href="#" onclick="removeVIP({{ $customer->id }})">
                      <i class="fas fa-crown me-1"></i>Remove VIP Status
                    </a>
                  @else
                    <a class="dropdown-item text-warning" href="#" onclick="makeVIP({{ $customer->id }})">
                      <i class="fas fa-crown me-1"></i>Make VIP
                    </a>
                  @endif
                  <div class="dropdown-divider"></div>
                  <form method="POST" action="{{ route('admin.customers.destroy', $customer->id) }}" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this customer?')">
                      <i class="fas fa-trash me-1"></i>Delete Customer
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
                <h5 class="text-900">No customers found</h5>
                <p class="text-500">Get started by adding your first customer.</p>
                <a class="btn btn-falcon-primary btn-sm" href="{{ route('admin.customers.create') }}">
                  <i class="fas fa-plus me-1"></i>Add New Customer
                </a>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if(isset($customers) && $customers->hasPages())
    <div class="card-footer d-flex align-items-center justify-content-center">
      {{ $customers->links() }}
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
        <h6>Total Customers</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-primary">{{ $totalCustomers ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.customers.index') }}">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-2.png') }});"></div>
      <div class="card-body position-relative">
        <h6>Active Customers</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-success">{{ $activeCustomers ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.customers.index') }}?status=active">View active<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-3.png') }});"></div>
      <div class="card-body position-relative">
        <h6>VIP Customers</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning">{{ $vipCustomers ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.customers.index') }}?status=vip">View VIP<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-md-3">
    <div class="card overflow-hidden" style="min-width: 12rem">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-4.png') }});"></div>
      <div class="card-body position-relative">
        <h6>New This Month</h6>
        <div class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-info">{{ $newCustomersThisMonth ?? 0 }}</div>
        <a class="fw-semi-bold fs--1 text-nowrap" href="{{ route('admin.customers.index') }}">View all<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
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
  const customersTableBody = document.getElementById('customersTableBody');
  
  searchInput.addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = customersTableBody.querySelectorAll('tr');
    
    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
  });
  
  // Filter functionality
  const countryFilter = document.getElementById('countryFilter');
  const statusFilter = document.getElementById('statusFilter');
  const clearFilters = document.getElementById('clearFilters');
  
  function applyFilters() {
    const countryValue = countryFilter.value;
    const statusValue = statusFilter.value;
    const rows = customersTableBody.querySelectorAll('tr');
    
    rows.forEach(row => {
      let showRow = true;
      
      if (countryValue) {
        const countryCell = row.querySelector('td:nth-child(3)');
        if (countryCell && !countryCell.textContent.includes(countryValue)) {
          showRow = false;
        }
      }
      
      if (statusValue && showRow) {
        const statusCell = row.querySelector('td:nth-child(7)');
        if (statusCell) {
          if (statusValue === 'vip' && !statusCell.textContent.includes('VIP')) {
            showRow = false;
          } else if (statusValue === 'active' && !statusCell.textContent.includes('Active')) {
            showRow = false;
          } else if (statusValue === 'inactive' && !statusCell.textContent.includes('New')) {
            showRow = false;
          }
        }
      }
      
      row.style.display = showRow ? '' : 'none';
    });
  }
  
  countryFilter.addEventListener('change', applyFilters);
  statusFilter.addEventListener('change', applyFilters);
  
  clearFilters.addEventListener('click', function() {
    countryFilter.value = '';
    statusFilter.value = '';
    searchInput.value = '';
    applyFilters();
    
    // Show all rows
    const rows = customersTableBody.querySelectorAll('tr');
    rows.forEach(row => {
      row.style.display = '';
    });
  });
});

// Action functions
function sendMessage(customerId) {
  const message = prompt('Enter your message to the customer:');
  if (message) {
    // Implement message sending logic
    console.log('Sending message to customer:', customerId, message);
  }
}

function makeVIP(customerId) {
  if (confirm('Make this customer a VIP?')) {
    // Implement VIP status logic
    console.log('Making customer VIP:', customerId);
  }
}

function removeVIP(customerId) {
  if (confirm('Remove VIP status from this customer?')) {
    // Implement VIP removal logic
    console.log('Removing VIP status from customer:', customerId);
  }
}
</script>
@endpush
