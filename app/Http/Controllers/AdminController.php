<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create(){
        return view('admin.admin.create');
    }
    public function index(){
        return view('admin.admin.index');
    }
}
