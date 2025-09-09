<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the post-login redirect destination.
     *
     * @return string
     */
    protected function redirectTo()
    {
        // Check if user has admin role and redirect accordingly
        if (auth()->check() && auth()->user()->role) {
            $role = auth()->user()->role->name;
            if (in_array($role, ['Super Admin', 'Admin', 'Manager'])) {
                return route('admin.dashboard');
            }
        }
        
        return route('dashboard');
    }
}
