<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function welcome() {
        return view('welcome', [
            'categories' => Category::all(),
        ]);
    }

    public function dashboard() {
        return view('dashboard');
    }
}
