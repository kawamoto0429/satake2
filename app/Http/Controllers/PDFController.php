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
            
        $purchases = Purchase::whereDate('created_at', $today)
                                ->where('maker_id', $id)
                                ->orderBy('cateroy_id', "asc")
                                ->orderBy('arrived_at', 'desc')
                                ->get(); 

        Log::debug($purchases);
        
        $counting = [];
        
        foreach ($categories as $category)
        {
            $counting[$category->name] = count(Purchase::where('category_name', $category->name)
                                                        ->whereDate('created_at', $today)
                                                        ->where('maker_id', $id)
                                                        ->get());
        }
        
    	$pdf = PDF::loadView('hello', compact('maker', 'purchases', 'categories', 'counting'));
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
