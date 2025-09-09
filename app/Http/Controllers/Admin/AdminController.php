<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Payment;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:Admin,Super Admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_hotels' => Hotel::count(),
            'total_rooms' => Room::count(),
            'total_bookings' => Booking::count(),
            'total_customers' => Customer::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'confirmed_bookings' => Booking::where('status', 'confirmed')->count(),
            'revenue_today' => Payment::whereDate('created_at', today())->sum('amount'),
            'revenue_month' => Payment::whereMonth('created_at', now()->month)->sum('amount'),
        ];
        
        $recent_bookings = Booking::with(['customer', 'hotel', 'room'])->latest()->take(5)->get();
        $recent_customers = Customer::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_bookings', 'recent_customers'));
    }
}
