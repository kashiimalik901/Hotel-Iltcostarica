<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Super Admin,Manager');
    }

    public function index()
    {
        $bookings = Booking::with(['customer', 'hotel', 'room'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $customers = Customer::all();
        $hotels = Hotel::where('status', 'active')->get();
        $rooms = Room::where('status', 'available')->get();
        $services = Service::where('is_available', true)->get();
        
        return view('admin.bookings.create', compact('customers', 'hotels', 'rooms', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'hotel_id' => 'required|exists:hotels,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date|after:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests_adults' => 'required|integer|min:1',
            'guests_children' => 'nullable|integer|min:0',
            'room_rate' => 'required|numeric|min:0',
            'extras_total' => 'nullable|numeric|min:0',
            'special_requests' => 'nullable|string',
            'room_preferences' => 'nullable|string',
            'interested_in_transportation' => 'boolean',
            'transportation_notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'payment_status' => 'required|in:pending,paid,partial,refunded',
            'currency' => 'required|string|max:3',
            'services' => 'nullable|array',
            'services.*.service_id' => 'exists:services,id',
            'services.*.quantity' => 'integer|min:1',
            'services.*.unit_price' => 'numeric|min:0'
        ]);

        // Calculate nights
        $checkIn = \Carbon\Carbon::parse($validated['check_in_date']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out_date']);
        $nights = $checkIn->diffInDays($checkOut);

        // Calculate totals
        $roomTotal = $validated['room_rate'] * $nights;
        $extrasTotal = $validated['extras_total'] ?? 0;
        $subtotal = $roomTotal + $extrasTotal;
        $taxAmount = $subtotal * 0.13; // 13% tax rate
        $totalPrice = $subtotal + $taxAmount;

        // Generate booking reference
        $bookingReference = 'BK-' . strtoupper(Str::random(8));

        $booking = Booking::create([
            'booking_reference' => $bookingReference,
            'customer_id' => $validated['customer_id'],
            'hotel_id' => $validated['hotel_id'],
            'room_id' => $validated['room_id'],
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'nights' => $nights,
            'guests_adults' => $validated['guests_adults'],
            'guests_children' => $validated['guests_children'],
            'room_rate' => $validated['room_rate'],
            'room_total' => $roomTotal,
            'extras_total' => $extrasTotal,
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total_price' => $totalPrice,
            'currency' => $validated['currency'],
            'status' => $validated['status'],
            'payment_status' => $validated['payment_status'],
            'special_requests' => $validated['special_requests'],
            'room_preferences' => $validated['room_preferences'],
            'interested_in_transportation' => $validated['interested_in_transportation'] ?? false,
            'transportation_notes' => $validated['transportation_notes']
        ]);

        // Add services if any
        if ($request->has('services')) {
            foreach ($request->services as $serviceData) {
                $booking->services()->create([
                    'service_id' => $serviceData['service_id'],
                    'service_type' => 'service',
                    'name' => Service::find($serviceData['service_id'])->name,
                    'description' => Service::find($serviceData['service_id'])->description,
                    'quantity' => $serviceData['quantity'],
                    'unit_price' => $serviceData['unit_price'],
                    'total_price' => $serviceData['quantity'] * $serviceData['unit_price'],
                    'currency' => $validated['currency'],
                    'status' => 'confirmed',
                    'payment_status' => 'pending'
                ]);
            }
        }

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    public function show(Booking $booking)
    {
        $booking->load(['customer', 'hotel', 'room', 'services.service', 'payments']);
        
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking)
    {
        $customers = Customer::all();
        $hotels = Hotel::where('status', 'active')->get();
        $rooms = Room::where('status', 'available')->get();
        $services = Service::where('is_available', true)->get();
        $booking->load('services');
        
        return view('admin.bookings.edit', compact('booking', 'customers', 'hotels', 'rooms', 'services'));
    }

    public function update(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'hotel_id' => 'required|exists:hotels,id',
            'room_id' => 'required|exists:rooms,id',
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
            'guests_adults' => 'required|integer|min:1',
            'guests_children' => 'nullable|integer|min:0',
            'room_rate' => 'required|numeric|min:0',
            'extras_total' => 'nullable|numeric|min:0',
            'special_requests' => 'nullable|string',
            'room_preferences' => 'nullable|string',
            'interested_in_transportation' => 'boolean',
            'transportation_notes' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'payment_status' => 'required|in:pending,paid,partial,refunded',
            'currency' => 'required|string|max:3'
        ]);

        // Calculate nights
        $checkIn = \Carbon\Carbon::parse($validated['check_in_date']);
        $checkOut = \Carbon\Carbon::parse($validated['check_out_date']);
        $nights = $checkIn->diffInDays($checkOut);

        // Calculate totals
        $roomTotal = $validated['room_rate'] * $nights;
        $extrasTotal = $validated['extras_total'] ?? 0;
        $subtotal = $roomTotal + $extrasTotal;
        $taxAmount = $subtotal * 0.13; // 13% tax rate
        $totalPrice = $subtotal + $taxAmount;

        $booking->update([
            'customer_id' => $validated['customer_id'],
            'hotel_id' => $validated['hotel_id'],
            'room_id' => $validated['room_id'],
            'check_in_date' => $validated['check_in_date'],
            'check_out_date' => $validated['check_out_date'],
            'nights' => $nights,
            'guests_adults' => $validated['guests_adults'],
            'guests_children' => $validated['guests_children'],
            'room_rate' => $validated['room_rate'],
            'room_total' => $roomTotal,
            'extras_total' => $extrasTotal,
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total_price' => $totalPrice,
            'currency' => $validated['currency'],
            'status' => $validated['status'],
            'payment_status' => $validated['payment_status'],
            'special_requests' => $validated['special_requests'],
            'room_preferences' => $validated['room_preferences'],
            'interested_in_transportation' => $validated['interested_in_transportation'] ?? false,
            'transportation_notes' => $validated['transportation_notes']
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    public function confirm(Booking $booking)
    {
        $booking->update([
            'status' => 'confirmed',
            'confirmed_at' => now()
        ]);

        return redirect()->back()->with('success', 'Booking confirmed successfully.');
    }

    public function cancel(Booking $booking)
    {
        $booking->update([
            'status' => 'cancelled',
            'cancelled_at' => now()
        ]);

        return redirect()->back()->with('success', 'Booking cancelled successfully.');
    }
}
