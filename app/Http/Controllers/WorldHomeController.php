<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorldHomeController extends Controller
{
    public function home() {
        return view('public.public_home');
    }
}
