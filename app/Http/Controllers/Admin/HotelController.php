<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Super Admin,Manager');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotels = \App\Models\Hotel::with(['destination', 'category'])
            ->latest()
            ->paginate(10);

        return view('admin.hotels.index', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $destinations = \App\Models\Destination::all();
        $categories = \App\Models\HotelCategory::all();

        return view('admin.hotels.create', compact('destinations', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'category_id' => 'nullable|exists:hotel_categories,id',
            'setting_type' => 'nullable|string|max:255',
            'style' => 'nullable|string|max:255',
            'total_rooms' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'highlight_features' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state_province' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i',
            'minimum_check_in_age' => 'nullable|integer|min:0',
            'pet_policy' => 'nullable|string',
            'cancellation_policy' => 'nullable|string',
            'amenities' => 'nullable|string',
            'awards' => 'nullable|string',
            'sustainability_features' => 'nullable|string',
            'parking_available' => 'boolean',
            'parking_type' => 'nullable|string',
            'parking_details' => 'nullable|string',
            'distance_to_airport' => 'nullable|numeric',
            'nearby_attractions' => 'nullable|string',
            'status' => 'nullable|string|in:active,inactive,maintenance,closed',
            'featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'hotel_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['status'] = $validated['status'] ?? 'active';
        $validated['featured'] = $request->has('featured');
        $validated['parking_available'] = $request->has('parking_available');

        $hotel = \App\Models\Hotel::create($validated);

            // Handle image uploads
    if ($request->hasFile('hotel_images')) {
        \Log::info('Hotel images found:', ['count' => count($request->file('hotel_images'))]);
        $this->uploadHotelImages($hotel, $request->file('hotel_images'));
    } else {
        \Log::info('No hotel images found in request');
        \Log::info('Request files:', $request->allFiles());
    }

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hotel = \App\Models\Hotel::with(['destination', 'category', 'rooms', 'images'])->findOrFail($id);
        
        return view('admin.hotels.show', compact('hotel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hotel = \App\Models\Hotel::with(['images'])->findOrFail($id);
        $destinations = \App\Models\Destination::all();
        $categories = \App\Models\HotelCategory::all();

        return view('admin.hotels.edit', compact('hotel', 'destinations', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hotel = \App\Models\Hotel::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'destination_id' => 'required|exists:destinations,id',
            'category_id' => 'nullable|exists:hotel_categories,id',
            'setting_type' => 'nullable|string|max:255',
            'style' => 'nullable|string|max:255',
            'total_rooms' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'highlight_features' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'state_province' => 'nullable|string',
            'country' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i',
            'minimum_check_in_age' => 'nullable|integer|min:0',
            'pet_policy' => 'nullable|string',
            'cancellation_policy' => 'nullable|string',
            'amenities' => 'nullable|string',
            'awards' => 'nullable|string',
            'sustainability_features' => 'nullable|string',
            'parking_available' => 'boolean',
            'parking_type' => 'nullable|string',
            'parking_details' => 'nullable|string',
            'distance_to_airport' => 'nullable|numeric',
            'nearby_attractions' => 'nullable|string',
            'status' => 'nullable|string|in:active,inactive,maintenance,closed',
            'featured' => 'boolean',
            'sort_order' => 'nullable|integer',
            'hotel_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['featured'] = $request->has('featured');
        $validated['parking_available'] = $request->has('parking_available');

        $hotel->update($validated);

        // Handle image uploads
        if ($request->hasFile('hotel_images')) {
            \Log::info('Hotel images found in update:', ['count' => count($request->file('hotel_images'))]);
            $this->uploadHotelImages($hotel, $request->file('hotel_images'));
        } else {
            \Log::info('No hotel images found in update request');
            \Log::info('Update request files:', $request->allFiles());
        }

        return redirect()->route('admin.hotels.show', $hotel->id)
            ->with('success', 'Hotel updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hotel = \App\Models\Hotel::with('images')->findOrFail($id);
        
        // Delete associated images from storage
        foreach ($hotel->images as $image) {
            if (Storage::disk('public')->exists($image->image_url)) {
                Storage::disk('public')->delete($image->image_url);
            }
            $image->delete();
        }
        
        $hotel->delete();

        return redirect()->route('admin.hotels.index')
            ->with('success', 'Hotel deleted successfully.');
    }

    /**
     * Upload hotel images
     */
    private function uploadHotelImages($hotel, $images)
    {
        \Log::info('Starting image upload for hotel:', ['hotel_id' => $hotel->id, 'image_count' => count($images)]);
        
        foreach ($images as $index => $image) {
            \Log::info('Processing image:', ['index' => $index, 'original_name' => $image->getClientOriginalName(), 'size' => $image->getSize()]);
            
            if ($image->isValid()) {
                $filename = 'hotels/' . $hotel->id . '/' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                
                \Log::info('Storing image:', ['filename' => $filename]);
                
                // Store the image directly to public disk
                $path = Storage::disk('public')->putFileAs('', $image, $filename);
                
                \Log::info('Image stored at:', ['path' => $path]);
                
                // Create hotel image record
                $imageRecord = $hotel->images()->create([
                    'image_url' => $filename,
                    'alt_text' => $hotel->name . ' - Image ' . ($index + 1),
                    'image_type' => 'General',
                    'is_primary' => $index === 0, // First image is primary
                    'sort_order' => $index + 1,
                ]);
                
                \Log::info('Image record created:', ['image_id' => $imageRecord->id]);
            } else {
                \Log::error('Invalid image:', ['index' => $index, 'errors' => $image->getError()]);
            }
        }
    }

    /**
     * Delete a specific hotel image
     */
    public function deleteImage(Request $request, $hotelId, $imageId)
    {
        $hotel = \App\Models\Hotel::findOrFail($hotelId);
        $image = $hotel->images()->findOrFail($imageId);
        
        // Delete from storage
        if (Storage::disk('public')->exists($image->image_url)) {
            Storage::disk('public')->delete($image->image_url);
        }
        
        $image->delete();
        
        return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
    }
}
