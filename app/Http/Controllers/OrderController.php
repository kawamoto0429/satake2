<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maker;

class OrderController extends Controller
{
    public function index() {
        $makers = Maker::all();
        
        return view('orders.index', compact('makers'));
    }
    
    public function home(Maker $maker) {
        
        return view('orders.home', compact('maker'));
    }
}
