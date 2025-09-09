<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Booking;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Super Admin,Manager');
    }

    public function index()
    {
        $customers = Customer::withCount('bookings')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date|before:today',
            'passport_number' => 'nullable|string|max:100',
            'preferences' => 'nullable|string'
        ]);

        Customer::create($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer created successfully.');
    }

    public function show(Customer $customer)
    {
        $customer->load(['bookings.hotel', 'bookings.room']);
        $recentBookings = $customer->bookings()->with(['hotel', 'room'])->latest()->take(5)->get();
        
        return view('admin.customers.show', compact('customer', 'recentBookings'));
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'date_of_birth' => 'nullable|date|before:today',
            'passport_number' => 'nullable|string|max:100',
            'preferences' => 'nullable|string'
        ]);

        $customer->update($validated);

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        // Check if customer has bookings
        if ($customer->bookings()->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete customer with existing bookings.');
        }

        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', 'Customer deleted successfully.');
    }

    public function bookings(Customer $customer)
    {
        $bookings = $customer->bookings()
            ->with(['hotel', 'room'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.customers.bookings', compact('customer', 'bookings'));
    }
}
