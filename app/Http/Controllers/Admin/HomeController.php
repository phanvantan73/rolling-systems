<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $diaries = $user->staff->diaries;

        return view('admin.home', compact('diaries'));
    }
}
