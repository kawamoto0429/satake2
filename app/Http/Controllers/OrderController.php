<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maker;
use App\Models\Maintenance;
use Log;
use App\Models\Purchase;
use App\Models\Category;
use Carbon\Carbon;


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
        
        $today = Carbon::today();
        
        Log::debug($today);
        
        $purchases = Purchase::whereDate('created_at', $today)->get();
        
        Log::debug($purchases);
        
        $categories = Category::all();
        
        return view('orders.purchases.index', compact('purchases', 'categories'));
    }
    
    public function note_today() 
    {
        $today = Carbon::today();
        
        $purchases = Purchase::whereDate('created_at', $today)->get();
        
        return view('notes.index', compact('today', "purchases"));
    }
    
    public function note_sub() 
    {
        $day_sub = Carbon::today()->subDay(1);
        
        
        
        $purchases = Purchase::whereDate('created_at', $day_sub)->get();
        
        return view('notes.sub', compact('day_sub', "purchases"));
    }
    
    public function category(Request $request) {
        // Log::debug($request);
        
        $category = $request['category_id'];
        
        // Log::debug($category);
        
         
         $maintenance_id = Maintenance::where('category_id', $category)->get('id');
         
         
         
         Log::debug($maintenance_id);
         
         $purchases = Purchase::where('maintenance_id', $maintenance_id)->get();
         
         
         
         return $purchases;
    }
}
