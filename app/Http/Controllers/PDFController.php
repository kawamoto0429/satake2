<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Maker;
use App\Models\Category;
use Carbon\Carbon;
use Log;
use PDF;

class PDFController extends Controller
{
    public function index(Maker $maker)
    {
        $today = Carbon::today();
        
        $id = $maker->id;
        
        $categories = Category::where('maker_id', $id)->get();
        
        Log::debug($categories);
        
        $purchases_array = [];
        
        
        
        // $purchases_kasi = Purchase::whereDate('created_at', $today)
        //                             ->where('maker_id', $id)
        //                             ->where('category_name', "菓子パン")
        //                             ->orderBy('arrived_at', 'desc')
        //                             ->get();
                                    
        // $purchases_huku = Purchase::whereDate('created_at', $today)
        //                             ->where('maker_id', $id)
        //                             ->where('category_name', "袋パン")
        //                             ->orderBy('arrived_at', 'desc')
        //                             ->get();
                                    
        // $purchases_syoku = Purchase::whereDate('created_at', $today)
        //                             ->where('maker_id', $id)
        //                             ->where('category_name', "食パン")
        //                             ->orderBy('arrived_at', 'desc')
        //                             ->get();
                                    
        // $purchases_you = Purchase::whereDate('created_at', $today)
        //                             ->where('maker_id', $id)
        //                             ->where('category_name', "洋菓子")
        //                             ->orderBy('arrived_at', 'desc')
        //                             ->get();
                                    
        // $purchases_wa = Purchase::whereDate('created_at', $today)
        //                             ->where('maker_id', $id)
        //                             ->where('category_name', "和菓子")
        //                             ->orderBy('arrived_at', 'desc')
        //                             ->get(); 
        // $i = 0;
        
        // for($i = 0; $i < count($categories); $i++)
        // {
            
        // }
        
        
            
            $purchases = Purchase::whereDate('created_at', $today)
                                    ->where('maker_id', $id)
                                    // ->where("category_id", $category->id)
                                    ->orderBy('arrived_at', 'desc')
                                    ->get(); 
            
        
                                    
                                    
        
        
        Log::debug($purchases);
        
    // 	$pdf = PDF::loadView('hello', compact('maker','purchases_kasi', 'purchases_huku', 'purchases_syoku', 'purchases_you', 'purchases_wa'));
    	$pdf = PDF::loadView('hello', compact('maker', 'purchases', 'categories'));
    	return $pdf->download('hello.pdf');
    }
    
    public function note($id, $day)
    {
        $makers = Maker::all();
        
        $date = new Carbon();
        
        $date->month = $id;
        
        $date->day = $day;
        
        $purchases = Purchase::whereDate('arrived_at', $date)->orderBy('maker_id', 'asc')->get();
        
        log::debug($purchases);
        
        $pdf = PDF::loadView('note', compact('purchases', 'makers'));
    	return $pdf->download('note.pdf');
    }
}
