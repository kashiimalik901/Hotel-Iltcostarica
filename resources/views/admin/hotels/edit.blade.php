@extends('admin.layouts.app')

@section('content')
<div class="card mb-3">
  <div class="card-header">
    <div class="row flex-between-end">
      <div class="col-auto align-self-center">
        <h5 class="mb-0 text-nowrap py-2 py-xl-0">Edit Hotel: {{ $hotel->name }}</h5>
      </div>
      <div class="col-auto ms-auto">
        <a class="btn btn-falcon-default btn-sm" href="{{ route('admin.hotels.index') }}">
          <i class="fas fa-arrow-left me-1"></i>Back to Hotels
        </a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data" id="hotelForm">
      @csrf
      @method('PUT')
      
      <!-- Navigation Tabs -->
      <ul class="nav nav-tabs" id="hotelTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="basic-tab" data-bs-toggle="tab" data-bs-target="#basic" type="button" role="tab" aria-controls="basic" aria-selected="true">
            <i class="fas fa-info-circle me-1"></i>Basic Information
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="amenities-tab" data-bs-toggle="tab" data-bs-target="#amenities" type="button" role="tab" aria-controls="amenities" aria-selected="false">
            <i class="fas fa-list-check me-1"></i>Amenities & Features
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pricing-tab" data-bs-toggle="tab" data-bs-target="#pricing" type="button" role="tab" aria-controls="pricing" aria-selected="false">
            <i class="fas fa-dollar-sign me-1"></i>Pricing & Policies
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="false">
            <i class="fas fa-images me-1"></i>Images
          </button>
        </li>
      </ul>

      <!-- Tab Content -->
      <div class="tab-content mt-3" id="hotelTabsContent">
        
        <!-- Basic Information Tab -->
        <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="name">Hotel Name <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $hotel->name) }}" required>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="slug">URL Slug</label>
              <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $hotel->slug) }}" placeholder="auto-generated">
              @error('slug')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="destination_id">Destination <span class="text-danger">*</span></label>
              <select class="form-select @error('destination_id') is-invalid @enderror" id="destination_id" name="destination_id" required>
                <option value="">Select Destination</option>
                @foreach($destinations ?? [] as $destination)
                  <option value="{{ $destination->id }}" {{ old('destination_id', $hotel->destination_id) == $destination->id ? 'selected' : '' }}>
                    {{ $destination->name }} - {{ $destination->country }}
                  </option>
                @endforeach
              </select>
              @error('destination_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="category_id">Hotel Category</label>
              <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                <option value="">Select Category</option>
                @foreach($categories ?? [] as $category)
                  <option value="{{ $category->id }}" {{ old('category_id', $hotel->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
              @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="setting_type">Setting Type</label>
              <select class="form-select @error('setting_type') is-invalid @enderror" id="setting_type" name="setting_type">
                <option value="">Select Setting</option>
                <option value="Beachfront" {{ old('setting_type', $hotel->setting_type) == 'Beachfront' ? 'selected' : '' }}>Beachfront</option>
                <option value="Mountain" {{ old('setting_type', $hotel->setting_type) == 'Mountain' ? 'selected' : '' }}>Mountain</option>
                <option value="City Center" {{ old('setting_type', $hotel->setting_type) == 'City Center' ? 'selected' : '' }}>City Center</option>
                <option value="Rural" {{ old('setting_type', $hotel->setting_type) == 'Rural' ? 'selected' : '' }}>Rural</option>
                <option value="Airport" {{ old('setting_type', $hotel->setting_type) == 'Airport' ? 'selected' : '' }}>Airport</option>
              </select>
              @error('setting_type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="style">Hotel Style</label>
              <select class="form-select @error('style') is-invalid @enderror" id="style" name="style">
                <option value="">Select Style</option>
                <option value="Modern" {{ old('style', $hotel->style) == 'Modern' ? 'selected' : '' }}>Modern</option>
                <option value="Traditional" {{ old('style', $hotel->style) == 'Traditional' ? 'selected' : '' }}>Traditional</option>
                <option value="Luxury" {{ old('style', $hotel->style) == 'Luxury' ? 'selected' : '' }}>Luxury</option>
                <option value="Boutique" {{ old('style', $hotel->style) == 'Boutique' ? 'selected' : '' }}>Boutique</option>
                <option value="Resort" {{ old('style', $hotel->style) == 'Resort' ? 'selected' : '' }}>Resort</option>
                <option value="Eco-friendly" {{ old('style', $hotel->style) == 'Eco-friendly' ? 'selected' : '' }}>Eco-friendly</option>
              </select>
              @error('style')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="total_rooms">Total Rooms</label>
              <input type="number" class="form-control @error('total_rooms') is-invalid @enderror" id="total_rooms" name="total_rooms" value="{{ old('total_rooms', $hotel->total_rooms) }}" min="1">
              @error('total_rooms')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="check_in_time">Check-in Time</label>
              <input type="time" class="form-control @error('check_in_time') is-invalid @enderror" id="check_in_time" name="check_in_time" value="{{ old('check_in_time', $hotel->check_in_time) }}">
              @error('check_in_time')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="check_out_time">Check-out Time</label>
              <input type="time" class="form-control @error('check_out_time') is-invalid @enderror" id="check_out_time" name="check_out_time" value="{{ old('check_out_time', $hotel->check_out_time) }}">
              @error('check_out_time')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="minimum_check_in_age">Minimum Check-in Age</label>
              <input type="number" class="form-control @error('minimum_check_in_age') is-invalid @enderror" id="minimum_check_in_age" name="minimum_check_in_age" value="{{ old('minimum_check_in_age', $hotel->minimum_check_in_age) }}" min="0">
              @error('minimum_check_in_age')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="short_description">Short Description</label>
              <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" placeholder="Brief description of the hotel">{{ old('short_description', $hotel->short_description) }}</textarea>
              @error('short_description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="description">Full Description</label>
              <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Detailed description of the hotel, amenities, and features">{{ old('description', $hotel->description) }}</textarea>
              @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="highlight_features">Highlight Features</label>
              <textarea class="form-control @error('highlight_features') is-invalid @enderror" id="highlight_features" name="highlight_features" rows="3" placeholder="Key features that make this hotel special">{{ old('highlight_features', $hotel->highlight_features) }}</textarea>
              @error('highlight_features')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        
        <!-- Amenities & Features Tab -->
        <div class="tab-pane fade" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
          <div class="row g-3">
            <div class="col-12">
              <h6 class="mb-3">Hotel Amenities</h6>
            </div>
            
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="parking_available" name="parking_available" value="1" {{ old('parking_available', $hotel->parking_available) ? 'checked' : '' }}>
                <label class="form-check-label" for="parking_available">Parking Available</label>
              </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="parking_type">Parking Type</label>
              <select class="form-select @error('parking_type') is-invalid @enderror" id="parking_type" name="parking_type">
                <option value="">Select Parking Type</option>
                <option value="Free" {{ old('parking_type', $hotel->parking_type) == 'Free' ? 'selected' : '' }}>Free</option>
                <option value="Paid" {{ old('parking_type', $hotel->parking_type) == 'Paid' ? 'selected' : '' }}>Paid</option>
                <option value="Valet" {{ old('parking_type', $hotel->parking_type) == 'Valet' ? 'selected' : '' }}>Valet</option>
                <option value="Self-park" {{ old('parking_type', $hotel->parking_type) == 'Self-park' ? 'selected' : '' }}>Self-park</option>
              </select>
              @error('parking_type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="parking_details">Parking Details</label>
              <textarea class="form-control @error('parking_details') is-invalid @enderror" id="parking_details" name="parking_details" rows="3" placeholder="Additional parking information">{{ old('parking_details', $hotel->parking_details) }}</textarea>
              @error('parking_details')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="distance_to_airport">Distance to Airport</label>
              <div class="input-group">
                <input type="number" class="form-control @error('distance_to_airport') is-invalid @enderror" id="distance_to_airport" name="distance_to_airport" value="{{ old('distance_to_airport', $hotel->distance_to_airport) }}" min="0" step="0.1">
                <span class="input-group-text">km</span>
              </div>
              @error('distance_to_airport')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="nearby_attractions">Nearby Attractions</label>
              <textarea class="form-control @error('nearby_attractions') is-invalid @enderror" id="nearby_attractions" name="nearby_attractions" rows="3" placeholder="Popular attractions near the hotel">{{ old('nearby_attractions', $hotel->nearby_attractions) }}</textarea>
              @error('nearby_attractions')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="awards">Awards & Recognition</label>
              <textarea class="form-control @error('awards') is-invalid @enderror" id="awards" name="awards" rows="3" placeholder="Awards, certifications, or recognition received">{{ old('awards', $hotel->awards) }}</textarea>
              @error('awards')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="sustainability_features">Sustainability Features</label>
              <textarea class="form-control @error('sustainability_features') is-invalid @enderror" id="sustainability_features" name="sustainability_features" rows="3" placeholder="Eco-friendly and sustainability initiatives">{{ old('sustainability_features', $hotel->sustainability_features) }}</textarea>
              @error('sustainability_features')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        
        <!-- Pricing & Policies Tab -->
        <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
          <div class="row g-3">
            <div class="col-12">
              <h6 class="mb-3">Policies & Information</h6>
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="pet_policy">Pet Policy</label>
              <select class="form-select @error('pet_policy') is-invalid @enderror" id="pet_policy" name="pet_policy">
                <option value="">Select Pet Policy</option>
                <option value="Pets Allowed" {{ old('pet_policy', $hotel->pet_policy) == 'Pets Allowed' ? 'selected' : '' }}>Pets Allowed</option>
                <option value="Pets Not Allowed" {{ old('pet_policy', $hotel->pet_policy) == 'Pets Not Allowed' ? 'selected' : '' }}>Pets Not Allowed</option>
                <option value="Service Animals Only" {{ old('pet_policy', $hotel->pet_policy) == 'Service Animals Only' ? 'selected' : '' }}>Service Animals Only</option>
                <option value="Restricted" {{ old('pet_policy', $hotel->pet_policy) == 'Restricted' ? 'selected' : '' }}>Restricted</option>
              </select>
              @error('pet_policy')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="status">Hotel Status</label>
              <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                <option value="active" {{ old('status', $hotel->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $hotel->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="maintenance" {{ old('status', $hotel->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="closed" {{ old('status', $hotel->status) == 'closed' ? 'selected' : '' }}>Closed</option>
              </select>
              @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" {{ old('featured', $hotel->featured) ? 'checked' : '' }}>
                <label class="form-check-label" for="featured">Featured Hotel</label>
              </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="sort_order">Sort Order</label>
              <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $hotel->sort_order) }}" min="0">
              @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="cancellation_policy">Cancellation Policy</label>
              <textarea class="form-control @error('cancellation_policy') is-invalid @enderror" id="cancellation_policy" name="cancellation_policy" rows="3" placeholder="Hotel's cancellation policy">{{ old('cancellation_policy', $hotel->cancellation_policy) }}</textarea>
              @error('cancellation_policy')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        
        <!-- Images Tab -->
        <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label" for="hotel_images">Add New Images</label>
              <input type="file" class="form-control @error('hotel_images.*') is-invalid @enderror" id="hotel_images" name="hotel_images[]" multiple accept="image/*">
              <div class="form-text">You can select multiple images. First image will be the primary image.</div>
              @error('hotel_images.*')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <!-- Current Images -->
            @if($hotel->images && count($hotel->images) > 0)
            <div class="col-12">
              <h6 class="mb-3">Current Images</h6>
              <div class="row g-2">
                @foreach($hotel->images as $image)
                <div class="col-md-3 col-sm-6">
                  <div class="card position-relative">
                    <img src="{{ asset('storage/' . $image->image_url) }}" class="card-img-top" alt="{{ $image->alt_text ?? 'Hotel Image' }}" style="height: 150px; object-fit: cover;">
                    <div class="card-body p-2">
                      <small class="text-muted">{{ $image->image_type ?? 'General' }}</small>
                      @if($image->is_primary)
                        <span class="badge badge-soft-primary ms-1">Primary</span>
                      @endif
                    </div>
                    <div class="position-absolute top-0 end-0 p-2">
                      <button type="button" class="btn btn-sm btn-danger" onclick="deleteImage({{ $image->id }})">
                        <i class="fas fa-trash"></i>
                      </button>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            @endif
            
            <div class="col-12">
              <div id="imagePreview" class="row g-2">
                <!-- New image previews will be shown here -->
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Form Actions -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-falcon-default" id="prevBtn">
              <i class="fas fa-arrow-left me-1"></i>Previous
            </button>
            
            <div>
              <button type="button" class="btn btn-falcon-info me-2" id="nextBtn">
                Next<i class="fas fa-arrow-right ms-1"></i>
              </button>
              
              <button type="submit" class="btn btn-falcon-primary">
                <i class="fas fa-save me-1"></i>Update Hotel
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
// Make functions globally available
window.currentTabIndex = 0;
window.tabs = ['basic', 'amenities', 'pricing', 'images'];

window.showTab = function(index) {
  // Hide all tabs
  window.tabs.forEach((tab, i) => {
    const tabPane = document.getElementById(tab);
    const tabButton = document.getElementById(tab + '-tab');
    
    if (i === index) {
      tabPane.classList.add('show', 'active');
      tabButton.classList.add('active');
    } else {
      tabPane.classList.remove('show', 'active');
      tabButton.classList.remove('active');
    }
  });
  
  window.currentTabIndex = index;
  updateNavigationButtons();
};

window.nextTab = function() {
  if (window.currentTabIndex < window.tabs.length - 1) {
    window.showTab(window.currentTabIndex + 1);
  }
};

window.previousTab = function() {
  if (window.currentTabIndex > 0) {
    window.showTab(window.currentTabIndex - 1);
  }
};

function updateNavigationButtons() {
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  
  if (prevBtn) prevBtn.disabled = window.currentTabIndex === 0;
  if (nextBtn) nextBtn.disabled = window.currentTabIndex === window.tabs.length - 1;
}

// Image preview functionality
document.addEventListener('DOMContentLoaded', function() {
  const hotelImagesInput = document.getElementById('hotel_images');
  if (hotelImagesInput) {
    hotelImagesInput.addEventListener('change', function(e) {
      const preview = document.getElementById('imagePreview');
      if (preview) {
        preview.innerHTML = '';
        
        Array.from(e.target.files).forEach((file, index) => {
          const reader = new FileReader();
          reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-md-3 col-sm-6';
            
            col.innerHTML = `
              <div class="card">
                <img src="${e.target.result}" class="card-img-top" alt="Preview" style="height: 150px; object-fit: cover;">
                <div class="card-body p-2">
                  <small class="text-muted">${file.name}</small>
                  <span class="badge badge-soft-primary ms-1">New</span>
                </div>
              </div>
            `;
            
            preview.appendChild(col);
          };
          reader.readAsDataURL(file);
        });
      }
    });
  }

  // Tab click handlers
  document.querySelectorAll('[data-bs-toggle="tab"]').forEach((tab, index) => {
    tab.addEventListener('click', () => {
      window.showTab(index);
    });
  });

  // Navigation button event listeners
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  
  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      window.previousTab();
    });
  }
  
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      window.nextTab();
    });
  }

  // Initialize
  window.showTab(0);
});

// Delete image function
window.deleteImage = function(imageId) {
  if (confirm('Are you sure you want to delete this image?')) {
    // You can implement AJAX deletion here or redirect to a delete route
    console.log('Deleting image:', imageId);
  }
};
</script>
@endpush
