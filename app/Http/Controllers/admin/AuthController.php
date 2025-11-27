<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Event;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsSubCategory;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AuthController extends Controller
{
    public function loginView()
    {


        return view('admin.auth.login');
    }
    public function dashboard()
    {
        $user = User::count();

        return view('admin.dashboard', compact('user'));
    }
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials, $request->has('remember'))) {
            return redirect(route('admin.dashboard'))->with('success', 'Login success.');
        } else {
            return back()->with('error', 'Invalid email or password. Please try again.');
        }
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return back()->with('success', 'Logout Success.');
    }
    public function userIndex()
    {
        $user = User::all();
        return view('admin.users.user', compact('user'));
    }


    public function downloadCSV()
    {
        $users = User::all(); // or your custom query

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=users.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Name', 'Email', 'Phone', 'User Type', 'Company Name', 'Designation', 'Address', 'State', 'Country', 'Pincode'];

        $callback = function () use ($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->fname . ' ' . $user->lname,
                    $user->email,
                    $user->phone,
                    $user->user_type,
                    $user->company_name,
                    $user->designation,
                    $user->address1,
                    $user->state,
                    $user->country,
                    $user->pincode
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
