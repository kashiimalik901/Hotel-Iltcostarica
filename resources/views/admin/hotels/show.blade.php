@extends('admin.layouts.app')

@section('content')
<div class="card mb-3">
  <div class="card-header">
    <div class="row flex-between-end">
      <div class="col-auto align-self-center">
        <h5 class="mb-0 text-nowrap py-2 py-xl-0">Hotel Details: {{ $hotel->name }}</h5>
      </div>
      <div class="col-auto ms-auto">
        <div class="btn-group" role="group">
          <a class="btn btn-falcon-info btn-sm" href="{{ route('admin.hotels.edit', $hotel->id) }}">
            <i class="fas fa-edit me-1"></i>Edit Hotel
          </a>
          <a class="btn btn-falcon-default btn-sm" href="{{ route('admin.hotels.index') }}">
            <i class="fas fa-arrow-left me-1"></i>Back to Hotels
          </a>
          <button type="button" class="btn btn-falcon-danger btn-sm" onclick="deleteHotel({{ $hotel->id }})">
            <i class="fas fa-trash me-1"></i>Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Hotel Images Gallery -->
@if($hotel->images && count($hotel->images) > 0)
<div class="card mb-3">
  <div class="card-header">
    <h6 class="mb-0"><i class="fas fa-images me-2"></i>Hotel Images</h6>
  </div>
  <div class="card-body">
    <div class="row g-3">
      @foreach($hotel->images as $image)
      <div class="col-md-3 col-sm-6">
        <div class="card position-relative">
          <img src="{{ asset('storage/' . $image->image_url) }}" 
               class="card-img-top" 
               alt="{{ $image->alt_text ?? 'Hotel Image' }}" 
               style="height: 200px; object-fit: cover;"
               data-bs-toggle="modal" 
               data-bs-target="#imageModal" 
               onclick="openImageModal('{{ asset('storage/' . $image->image_url) }}', '{{ $image->alt_text ?? 'Hotel Image' }}')">
          <div class="card-body p-2">
            <small class="text-muted">{{ $image->image_type ?? 'General' }}</small>
            @if($image->is_primary)
              <span class="badge badge-soft-primary ms-1">Primary</span>
            @endif
          </div>

        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endif

<!-- Hotel Information -->
<div class="row g-3">
  <!-- Basic Information -->
  <div class="col-lg-8">
    <div class="card mb-3">
      <div class="card-header">
        <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Basic Information</h6>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">Hotel Name</label>
            <p class="mb-0">{{ $hotel->name }}</p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">URL Slug</label>
            <p class="mb-0">{{ $hotel->slug ?? 'Not set' }}</p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Destination</label>
            <p class="mb-0">
              @if($hotel->destination)
                {{ $hotel->destination->name }}, {{ $hotel->destination->country }}
              @else
                Not assigned
              @endif
            </p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Hotel Category</label>
            <p class="mb-0">
              @if($hotel->category)
                {{ $hotel->category->name }}
              @else
                Not assigned
              @endif
            </p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Setting Type</label>
            <p class="mb-0">{{ $hotel->setting_type ?? 'Not specified' }}</p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Hotel Style</label>
            <p class="mb-0">{{ $hotel->style ?? 'Not specified' }}</p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Total Rooms</label>
            <p class="mb-0">{{ $hotel->total_rooms ?? 'Not specified' }}</p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Status</label>
            <span class="badge badge-soft-{{ $hotel->status === 'active' ? 'success' : ($hotel->status === 'inactive' ? 'warning' : 'danger') }}">
              {{ ucfirst($hotel->status) }}
            </span>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Check-in Time</label>
            <p class="mb-0">{{ $hotel->check_in_time ?? 'Not specified' }}</p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Check-out Time</label>
            <p class="mb-0">{{ $hotel->check_out_time ?? 'Not specified' }}</p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Minimum Check-in Age</label>
            <p class="mb-0">{{ $hotel->minimum_check_in_age ?? 'Not specified' }}</p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Featured Hotel</label>
            <span class="badge badge-soft-{{ $hotel->featured ? 'success' : 'secondary' }}">
              {{ $hotel->featured ? 'Yes' : 'No' }}
            </span>
          </div>
          
          <div class="col-12">
            <label class="form-label fw-bold">Short Description</label>
            <p class="mb-0">{{ $hotel->short_description ?? 'No short description available' }}</p>
          </div>
          
          <div class="col-12">
            <label class="form-label fw-bold">Full Description</label>
            <p class="mb-0">{{ $hotel->description ?? 'No description available' }}</p>
          </div>
          
          <div class="col-12">
            <label class="form-label fw-bold">Highlight Features</label>
            <p class="mb-0">{{ $hotel->highlight_features ?? 'No highlight features specified' }}</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Amenities & Features -->
    <div class="card mb-3">
      <div class="card-header">
        <h6 class="mb-0"><i class="fas fa-list-check me-2"></i>Amenities & Features</h6>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">Parking Available</label>
            <span class="badge badge-soft-{{ $hotel->parking_available ? 'success' : 'secondary' }}">
              {{ $hotel->parking_available ? 'Yes' : 'No' }}
            </span>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Parking Type</label>
            <p class="mb-0">{{ $hotel->parking_type ?? 'Not specified' }}</p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Distance to Airport</label>
            <p class="mb-0">
              @if($hotel->distance_to_airport)
                {{ $hotel->distance_to_airport }} km
              @else
                Not specified
              @endif
            </p>
          </div>
          
          <div class="col-12">
            <label class="form-label fw-bold">Parking Details</label>
            <p class="mb-0">{{ $hotel->parking_details ?? 'No parking details available' }}</p>
          </div>
          
          <div class="col-12">
            <label class="form-label fw-bold">Nearby Attractions</label>
            <p class="mb-0">{{ $hotel->nearby_attractions ?? 'No nearby attractions listed' }}</p>
          </div>
          
          <div class="col-12">
            <label class="form-label fw-bold">Awards & Recognition</label>
            <p class="mb-0">{{ $hotel->awards ?? 'No awards or recognition listed' }}</p>
          </div>
          
          <div class="col-12">
            <label class="form-label fw-bold">Sustainability Features</label>
            <p class="mb-0">{{ $hotel->sustainability_features ?? 'No sustainability features listed' }}</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Policies & Information -->
    <div class="card mb-3">
      <div class="card-header">
        <h6 class="mb-0"><i class="fas fa-dollar-sign me-2"></i>Policies & Information</h6>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-bold">Pet Policy</label>
            <p class="mb-0">{{ $hotel->pet_policy ?? 'Not specified' }}</p>
          </div>
          
          <div class="col-md-6">
            <label class="form-label fw-bold">Sort Order</label>
            <p class="mb-0">{{ $hotel->sort_order ?? 'Not set' }}</p>
          </div>
          
          <div class="col-12">
            <label class="form-label fw-bold">Cancellation Policy</label>
            <p class="mb-0">{{ $hotel->cancellation_policy ?? 'No cancellation policy specified' }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Sidebar Information -->
  <div class="col-lg-4">
    <!-- Quick Stats -->
    <div class="card mb-3">
      <div class="card-header">
        <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Quick Stats</h6>
      </div>
      <div class="card-body">
        <div class="row g-2">
          <div class="col-6">
            <div class="text-center">
              <h4 class="text-primary mb-1">{{ $hotel->rooms_count ?? 0 }}</h4>
              <small class="text-muted">Total Rooms</small>
            </div>
          </div>
          <div class="col-6">
            <div class="text-center">
              <h4 class="text-success mb-1">{{ $hotel->available_rooms_count ?? 0 }}</h4>
              <small class="text-muted">Available</small>
            </div>
          </div>
          <div class="col-6">
            <div class="text-center">
              <h4 class="text-warning mb-1">{{ $hotel->booked_rooms_count ?? 0 }}</h4>
              <small class="text-muted">Booked</small>
            </div>
          </div>
          <div class="col-6">
            <div class="text-center">
              <h4 class="text-info mb-1">{{ $hotel->total_bookings_count ?? 0 }}</h4>
              <small class="text-muted">Bookings</small>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Hotel Actions -->
    <div class="card mb-3">
      <div class="card-header">
        <h6 class="mb-0"><i class="fas fa-cogs me-2"></i>Quick Actions</h6>
      </div>
      <div class="card-body">
        <div class="d-grid gap-2">
          <a href="{{ route('admin.rooms.create', ['hotel_id' => $hotel->id]) }}" class="btn btn-falcon-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Room
          </a>
          <a href="{{ route('admin.rooms.index', ['hotel_id' => $hotel->id]) }}" class="btn btn-falcon-info btn-sm">
            <i class="fas fa-bed me-1"></i>Manage Rooms
          </a>
          <a href="{{ route('admin.bookings.index', ['hotel_id' => $hotel->id]) }}" class="btn btn-falcon-warning btn-sm">
            <i class="fas fa-calendar-check me-1"></i>View Bookings
          </a>
          <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-falcon-secondary btn-sm">
            <i class="fas fa-edit me-1"></i>Edit Hotel
          </a>
        </div>
      </div>
    </div>
    
    <!-- Hotel Details -->
    <div class="card mb-3">
      <div class="card-header">
        <h6 class="mb-0"><i class="fas fa-info me-2"></i>Additional Details</h6>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="form-label fw-bold">Created</label>
          <p class="mb-0">{{ $hotel->created_at ? $hotel->created_at->format('M d, Y H:i') : 'Unknown' }}</p>
        </div>
        
        <div class="mb-3">
          <label class="form-label fw-bold">Last Updated</label>
          <p class="mb-0">{{ $hotel->updated_at ? $hotel->updated_at->format('M d, Y H:i') : 'Unknown' }}</p>
        </div>
        
        @if($hotel->deleted_at)
        <div class="mb-3">
          <label class="form-label fw-bold text-danger">Deleted At</label>
          <p class="mb-0 text-danger">{{ $hotel->deleted_at->format('M d, Y H:i') }}</p>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModalLabel">Hotel Image</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img id="modalImage" src="" alt="" class="img-fluid" style="max-height: 500px;">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-falcon-default" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this hotel? This action cannot be undone.</p>
        <p class="text-danger"><strong>Warning:</strong> This will also delete all associated rooms and bookings.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-falcon-default" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST" style="display: inline;">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-falcon-danger">Delete Hotel</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
function openImageModal(imageSrc, imageAlt) {
  document.getElementById('modalImage').src = imageSrc;
  document.getElementById('modalImage').alt = imageAlt;
  document.getElementById('imageModalLabel').textContent = imageAlt;
}

function deleteHotel(hotelId) {
  const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
  const form = document.getElementById('deleteForm');
  form.action = `/admin/hotels/${hotelId}`;
  modal.show();
}



// Auto-slide hotel images every 5 seconds
@if($hotel->images && count($hotel->images) > 1)
let currentImageIndex = 0;
const hotelImages = document.querySelectorAll('[data-bs-toggle="modal"]');

function autoSlideImages() {
  if (hotelImages.length > 1) {
    currentImageIndex = (currentImageIndex + 1) % hotelImages.length;
    const nextImage = hotelImages[currentImageIndex];
    const imageSrc = nextImage.querySelector('img').src;
    const imageAlt = nextImage.querySelector('img').alt;
    
    // Update the main image display (you can customize this)
    console.log('Auto-sliding to:', imageAlt);
  }
}

// Start auto-slide if there are multiple images
if (hotelImages.length > 1) {
  setInterval(autoSlideImages, 5000);
}
@endif
</script>
@endpush
