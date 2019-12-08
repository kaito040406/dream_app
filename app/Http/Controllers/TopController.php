<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('toppages.index', ['user' => $user]);
    }
}
