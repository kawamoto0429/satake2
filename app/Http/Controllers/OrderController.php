<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maker;
use App\Models\Maintenance;
use Log;
use App\Models\Purchase;


class OrderController extends Controller
{
    public function index() {
        $makers = Maker::all();
        
        
        return view('orders.index', compact('makers'));
    }
    
    public function home(Maker $maker) {
        
        $id = $maker->id;
        
        // $maintenances = Maintenance::where('maker_id', $id)->paginate(10);
        
        $maintenances = Maintenance::where('maker_id', $id)->get();
        
        return view('orders.home', compact('maker','maintenances'));
    }
    
    public function show(Maintenance $maintenance)
    {
        
        
        return view('orders.show', compact('maintenance'));
    }
    
    public function store(Request $request)
    {
        $purchase = new Purchase();
        $purchase->purchase_qty = $request->input('purchase_qty');
        $purchase->maintenance_id = $request->input('maintenance_id');
        $purchase->save();
        
        return redirect()->route('orders_purchase');
        
    }
    
    public function purchase() {
        $purchases = Purchase::all();
        
        return view('orders.purchases.index', compact('purchases'));
    }
}
