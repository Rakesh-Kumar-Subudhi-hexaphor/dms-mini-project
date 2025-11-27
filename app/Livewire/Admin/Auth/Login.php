<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public function adminLogin()
    {
     
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            dd('asan');
            return redirect()->to('/admin/dashboard');
        } else {
            session()->flash('error', 'Invalid credentials. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
