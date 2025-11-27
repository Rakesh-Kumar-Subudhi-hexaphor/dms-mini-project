<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\News;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id(); 
        $product = Product::count();
          $orders = Order::where('user_id', $userId)->count();
        return view('user.dashboard', compact('product','orders'));
    }
    public function register()
    {
        return view('frontend.register');
    }
    public function login()
    {
        return view('frontend.login');
    }
    public function userregister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'password' => FacadesHash::make($request->input('password')),
        ]);

        return redirect()->route('user.login')->with('success', 'User registered successfully!');

    }
    public function loginStore(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to find user by email and user_type
        $user = User::where('email', $request->email)
                    ->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            // Log the user in using the appropriate guard
            Auth::guard('user')->login($user);

            return redirect()->route('user.dashboard')->with('success', 'You are Logged in to the DMS!!');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login'); // Redirect to the login page after logout
    }
}
