<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maker;

class AppController extends Controller
{
    public function index()
    {
        $makers = Maker::all();
        return view("layouts.app" compact('maker'));
    }
}
