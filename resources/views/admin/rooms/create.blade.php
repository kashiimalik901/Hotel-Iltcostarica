@extends('admin.layouts.app')

@section('content')
<div class="card mb-3">
  <div class="card-header">
    <div class="row flex-between-end">
      <div class="col-auto align-self-center">
        <h5 class="mb-0 text-nowrap py-2 py-xl-0">Add New Room</h5>
      </div>
      <div class="col-auto ms-auto">
        <a class="btn btn-falcon-default btn-sm" href="{{ route('admin.rooms.index') }}">
          <i class="fas fa-arrow-left me-1"></i>Back to Rooms
        </a>
      </div>
    </div>
  </div>
  <div class="card-body">
    <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data" id="roomForm">
      @csrf
      
      <!-- Navigation Tabs -->
      <ul class="nav nav-tabs" id="roomTabs" role="tablist">
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
            <i class="fas fa-dollar-sign me-1"></i>Pricing & Availability
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" type="button" role="tab" aria-controls="images" aria-selected="false">
            <i class="fas fa-images me-1"></i>Images
          </button>
        </li>
      </ul>

      <!-- Tab Content -->
      <div class="tab-content mt-3" id="roomTabsContent">
        
        <!-- Basic Information Tab -->
        <div class="tab-pane fade show active" id="basic" role="tabpanel" aria-labelledby="basic-tab">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="hotel_id">Hotel <span class="text-danger">*</span></label>
              <select class="form-select @error('hotel_id') is-invalid @enderror" id="hotel_id" name="hotel_id" required>
                <option value="">Select Hotel</option>
                @foreach($hotels ?? [] as $hotel)
                  <option value="{{ $hotel->id }}" {{ old('hotel_id') == $hotel->id ? 'selected' : '' }}>
                    {{ $hotel->name }} - {{ $hotel->city }}
                  </option>
                @endforeach
              </select>
              @error('hotel_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="room_name">Room Name/Number <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('room_name') is-invalid @enderror" id="room_name" name="room_name" value="{{ old('room_name') }}" required>
              @error('room_name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="room_type">Room Type <span class="text-danger">*</span></label>
              <select class="form-select @error('room_type') is-invalid @enderror" id="room_type" name="room_type" required>
                <option value="">Select Room Type</option>
                <option value="Standard" {{ old('room_type') == 'Standard' ? 'selected' : '' }}>Standard</option>
                <option value="Deluxe" {{ old('room_type') == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
                <option value="Suite" {{ old('room_type') == 'Suite' ? 'selected' : '' }}>Suite</option>
                <option value="Executive" {{ old('room_type') == 'Executive' ? 'selected' : '' }}>Executive</option>
                <option value="Presidential" {{ old('room_type') == 'Presidential' ? 'selected' : '' }}>Presidential</option>
                <option value="Family" {{ old('room_type') == 'Family' ? 'selected' : '' }}>Family</option>
                <option value="Accessible" {{ old('room_type') == 'Accessible' ? 'selected' : '' }}>Accessible</option>
              </select>
              @error('room_type')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="room_size">Room Size</label>
              <div class="input-group">
                <input type="number" class="form-control @error('room_size') is-invalid @enderror" id="room_size" name="room_size" value="{{ old('room_size') }}" min="0" step="0.01">
                <span class="input-group-text">sq ft</span>
              </div>
              @error('room_size')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="capacity_adults">Adult Capacity <span class="text-danger">*</span></label>
              <input type="number" class="form-control @error('capacity_adults') is-invalid @enderror" id="capacity_adults" name="capacity_adults" value="{{ old('capacity_adults', 2) }}" min="1" max="10" required>
              @error('capacity_adults')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="capacity_children">Children Capacity</label>
              <input type="number" class="form-control @error('capacity_children') is-invalid @enderror" id="capacity_children" name="capacity_children" value="{{ old('capacity_children', 0) }}" min="0" max="6">
              @error('capacity_children')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="bed_configuration">Bed Configuration</label>
              <select class="form-select @error('bed_configuration') is-invalid @enderror" id="bed_configuration" name="bed_configuration">
                <option value="">Select Bed Configuration</option>
                <option value="1 King Bed" {{ old('bed_configuration') == '1 King Bed' ? 'selected' : '' }}>1 King Bed</option>
                <option value="1 Queen Bed" {{ old('bed_configuration') == '1 Queen Bed' ? 'selected' : '' }}>1 Queen Bed</option>
                <option value="2 Twin Beds" {{ old('bed_configuration') == '2 Twin Beds' ? 'selected' : '' }}>2 Twin Beds</option>
                <option value="2 Double Beds" {{ old('bed_configuration') == '2 Double Beds' ? 'selected' : '' }}>2 Double Beds</option>
                <option value="1 King + 1 Sofa Bed" {{ old('bed_configuration') == '1 King + 1 Sofa Bed' ? 'selected' : '' }}>1 King + 1 Sofa Bed</option>
                <option value="1 Queen + 1 Twin" {{ old('bed_configuration') == '1 Queen + 1 Twin' ? 'selected' : '' }}>1 Queen + 1 Twin</option>
              </select>
              @error('bed_configuration')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="floor_range">Floor Range</label>
              <input type="text" class="form-control @error('floor_range') is-invalid @enderror" id="floor_range" name="floor_range" value="{{ old('floor_range') }}" placeholder="e.g., 1-3, 5-8">
              @error('floor_range')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="short_description">Short Description</label>
              <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description" rows="3" placeholder="Brief description of the room">{{ old('short_description') }}</textarea>
              @error('short_description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="full_description">Full Description</label>
              <textarea class="form-control @error('full_description') is-invalid @enderror" id="full_description" name="full_description" rows="5" placeholder="Detailed description of the room, amenities, and features">{{ old('full_description') }}</textarea>
              @error('full_description')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        
        <!-- Amenities & Features Tab -->
        <div class="tab-pane fade" id="amenities" role="tabpanel" aria-labelledby="amenities-tab">
          <div class="row g-3">
            <div class="col-12">
              <h6 class="mb-3">Room Features</h6>
            </div>
            
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="has_wifi" name="has_wifi" value="1" {{ old('has_wifi') ? 'checked' : '' }}>
                <label class="form-check-label" for="has_wifi">WiFi Available</label>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="has_safe" name="has_safe" value="1" {{ old('has_safe') ? 'checked' : '' }}>
                <label class="form-check-label" for="has_safe">In-room Safe</label>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="has_coffeemaker" name="has_coffeemaker" value="1" {{ old('has_coffeemaker') ? 'checked' : '' }}>
                <label class="form-check-label" for="has_coffeemaker">Coffee Maker</label>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="has_minibar" name="has_minibar" value="1" {{ old('has_minibar') ? 'checked' : '' }}>
                <label class="form-check-label" for="has_minibar">Mini Bar</label>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="has_balcony" name="has_balcony" value="1" {{ old('has_balcony') ? 'checked' : '' }}>
                <label class="form-check-label" for="has_balcony">Balcony</label>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="has_ocean_view" name="has_ocean_view" value="1" {{ old('has_ocean_view') ? 'checked' : '' }}>
                <label class="form-check-label" for="has_ocean_view">Ocean View</label>
              </div>
            </div>
            
            <div class="col-12">
              <label class="form-label" for="special_features">Special Features</label>
              <textarea class="form-control @error('special_features') is-invalid @enderror" id="special_features" name="special_features" rows="3" placeholder="Any special features or unique characteristics of this room">{{ old('special_features') }}</textarea>
              @error('special_features')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="accessibility_features">Accessibility Features</label>
              <textarea class="form-control @error('accessibility_features') is-invalid @enderror" id="accessibility_features" name="accessibility_features" rows="3" placeholder="Accessibility features for guests with special needs">{{ old('accessibility_features') }}</textarea>
              @error('accessibility_features')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>
        
        <!-- Pricing & Availability Tab -->
        <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="base_price">Base Price <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control @error('base_price') is-invalid @enderror" id="base_price" name="base_price" value="{{ old('base_price') }}" min="0" step="0.01" required>
              </div>
              @error('base_price')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="currency">Currency</label>
              <select class="form-select @error('currency') is-invalid @enderror" id="currency" name="currency">
                <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP (£)</option>
                <option value="CRC" {{ old('currency') == 'CRC' ? 'selected' : '' }}>CRC (₡)</option>
              </select>
              @error('currency')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-md-6">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="tax_inclusive" name="tax_inclusive" value="1" {{ old('tax_inclusive') ? 'checked' : '' }}>
                <label class="form-check-label" for="tax_inclusive">Price is Tax Inclusive</label>
              </div>
            </div>
            
            <div class="col-md-6">
              <label class="form-label" for="status">Room Status</label>
              <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
              </select>
              @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <label class="form-label" for="cancellation_policy">Cancellation Policy</label>
              <textarea class="form-control @error('cancellation_policy') is-invalid @enderror" id="cancellation_policy" name="cancellation_policy" rows="3" placeholder="Cancellation policy for this room type">{{ old('cancellation_policy') }}</textarea>
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
              <label class="form-label" for="room_images">Room Images</label>
              <input type="file" class="form-control @error('room_images.*') is-invalid @enderror" id="room_images" name="room_images[]" multiple accept="image/*">
              <div class="form-text">You can select multiple images. First image will be the primary image.</div>
              @error('room_images.*')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            
            <div class="col-12">
              <div id="imagePreview" class="row g-2">
                <!-- Image previews will be shown here -->
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Form Actions -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-falcon-default" onclick="previousTab()">
              <i class="fas fa-arrow-left me-1"></i>Previous
            </button>
            
            <div>
              <button type="button" class="btn btn-falcon-info me-2" onclick="nextTab()">
                Next<i class="fas fa-arrow-right ms-1"></i>
              </button>
              
              <button type="submit" class="btn btn-falcon-primary">
                <i class="fas fa-save me-1"></i>Create Room
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
let currentTabIndex = 0;
const tabs = ['basic', 'amenities', 'pricing', 'images'];

function showTab(index) {
  // Hide all tabs
  tabs.forEach((tab, i) => {
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
  
  currentTabIndex = index;
  updateNavigationButtons();
}

function nextTab() {
  if (currentTabIndex < tabs.length - 1) {
    showTab(currentTabIndex + 1);
  }
}

function previousTab() {
  if (currentTabIndex > 0) {
    showTab(currentTabIndex - 1);
  }
}

function updateNavigationButtons() {
  const prevBtn = document.querySelector('button[onclick="previousTab()"]');
  const nextBtn = document.querySelector('button[onclick="nextTab()"]');
  
  prevBtn.disabled = currentTabIndex === 0;
  nextBtn.disabled = currentTabIndex === tabs.length - 1;
}

// Image preview functionality
document.getElementById('room_images').addEventListener('change', function(e) {
  const preview = document.getElementById('imagePreview');
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
            ${index === 0 ? '<span class="badge badge-soft-primary ms-1">Primary</span>' : ''}
          </div>
        </div>
      `;
      
      preview.appendChild(col);
    };
    reader.readAsDataURL(file);
  });
});

// Tab click handlers
document.querySelectorAll('[data-bs-toggle="tab"]').forEach((tab, index) => {
  tab.addEventListener('click', () => {
    showTab(index);
  });
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
  showTab(0);
});
</script>
@endpush
