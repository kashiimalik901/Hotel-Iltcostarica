<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Hotel;
use App\Models\RoomFeature;
use Illuminate\Support\Str;

class RoomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Super Admin,Manager');
    }

    public function index()
    {
        $rooms = Room::with(['hotel', 'features'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        $hotels = Hotel::where('status', 'active')->get();
        $features = RoomFeature::all();
        
        return view('admin.rooms.create', compact('hotels', 'features'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type' => 'required|string|max:100',
            'room_name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'full_description' => 'nullable|string',
            'room_size' => 'nullable|string|max:100',
            'capacity_adults' => 'required|integer|min:1',
            'capacity_children' => 'nullable|integer|min:0',
            'max_occupancy' => 'required|integer|min:1',
            'bed_configuration' => 'nullable|string|max:255',
            'bed_type' => 'nullable|string|max:100',
            'bed_count' => 'nullable|integer|min:1',
            'bed_details' => 'nullable|string|max:255',
            'tv_type' => 'nullable|string|max:100',
            'tv_size' => 'nullable|string|max:50',
            'has_wifi' => 'boolean',
            'wifi_details' => 'nullable|string|max:255',
            'has_safe' => 'boolean',
            'safe_type' => 'nullable|string|max:100',
            'has_coffeemaker' => 'boolean',
            'coffeemaker_type' => 'nullable|string|max:100',
            'has_minibar' => 'boolean',
            'has_balcony' => 'boolean',
            'balcony_details' => 'nullable|string|max:255',
            'bathroom_type' => 'nullable|string|max:100',
            'shower_type' => 'nullable|string|max:100',
            'bathroom_amenities' => 'nullable|string',
            'view_type' => 'nullable|string|max:100',
            'view_description' => 'nullable|string|max:255',
            'proximity_to_beach' => 'nullable|string|max:100',
            'floor_range' => 'nullable|string|max:100',
            'special_features' => 'nullable|string',
            'accessibility_features' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'tax_inclusive' => 'boolean',
            'status' => 'required|in:available,unavailable,maintenance',
            'sort_order' => 'nullable|integer|min:0',
            'features' => 'nullable|array',
            'features.*' => 'exists:room_features,id'
        ]);

        $room = Room::create($validated);

        if ($request->has('features')) {
            $room->features()->attach($request->features);
        }

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room created successfully.');
    }

    public function show(Room $room)
    {
        $room->load(['hotel', 'features', 'images']);
        
        return view('admin.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        $hotels = Hotel::where('status', 'active')->get();
        $features = RoomFeature::all();
        $room->load('features');
        
        return view('admin.rooms.edit', compact('room', 'hotels', 'features'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'room_type' => 'required|string|max:100',
            'room_name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'full_description' => 'nullable|string',
            'room_size' => 'nullable|string|max:100',
            'capacity_adults' => 'required|integer|min:1',
            'capacity_children' => 'nullable|integer|min:0',
            'max_occupancy' => 'required|integer|min:1',
            'bed_configuration' => 'nullable|string|max:255',
            'bed_type' => 'nullable|string|max:100',
            'bed_count' => 'nullable|integer|min:1',
            'bed_details' => 'nullable|string|max:255',
            'tv_type' => 'nullable|string|max:100',
            'tv_size' => 'nullable|string|max:50',
            'has_wifi' => 'boolean',
            'wifi_details' => 'nullable|string|max:255',
            'has_safe' => 'boolean',
            'safe_type' => 'nullable|string|max:100',
            'has_coffeemaker' => 'boolean',
            'coffeemaker_type' => 'nullable|string|max:100',
            'has_minibar' => 'boolean',
            'has_balcony' => 'boolean',
            'balcony_details' => 'nullable|string|max:255',
            'bathroom_type' => 'nullable|string|max:100',
            'shower_type' => 'nullable|string|max:100',
            'bathroom_amenities' => 'nullable|string',
            'view_type' => 'nullable|string|max:100',
            'view_description' => 'nullable|string|max:255',
            'proximity_to_beach' => 'nullable|string|max:100',
            'floor_range' => 'nullable|string|max:100',
            'special_features' => 'nullable|string',
            'accessibility_features' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'tax_inclusive' => 'boolean',
            'status' => 'required|in:available,unavailable,maintenance',
            'sort_order' => 'nullable|integer|min:0',
            'features' => 'nullable|array',
            'features.*' => 'exists:room_features,id'
        ]);

        $room->update($validated);

        if ($request->has('features')) {
            $room->features()->sync($request->features);
        } else {
            $room->features()->detach();
        }

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Room deleted successfully.');
    }
}
