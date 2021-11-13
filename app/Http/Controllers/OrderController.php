<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maker;
use App\Models\Maintenance;

class OrderController extends Controller
{
    public function index() {
        $makers = Maker::all();
        
        
        return view('orders.index', compact('makers'));
    }
    
    public function home(Maker $maker) {
        
        $id = $maker->id;
        
        $maintenances = Maintenance::where('maker_id', $id)->paginate(10);
        
        return view('orders.home', compact('maker','maintenances'));
    }
}
