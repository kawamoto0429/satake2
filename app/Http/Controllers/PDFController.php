<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Maker;
use Carbon\Carbon;
use PDF;

class PDFController extends Controller
{
    public function index(Maker $maker)
    {
        $today = Carbon::today();
        
        $id = $maker->id;
        
        $purchases_kasi = Purchase::whereDate('created_at', $today)
                                    ->where('maker_id', $id)
                                    ->where('category_name', "菓子パン")
                                    ->orderBy('arrived_at', 'desc')
                                    ->get();
                                    
        $purchases_huku = Purchase::whereDate('created_at', $today)
                                    ->where('maker_id', $id)
                                    ->where('category_name', "袋パン")
                                    ->orderBy('arrived_at', 'desc')
                                    ->get();
                                    
        $purchases_syoku = Purchase::whereDate('created_at', $today)
                                    ->where('maker_id', $id)
                                    ->where('category_name', "食パン")
                                    ->orderBy('arrived_at', 'desc')
                                    ->get();
                                    
        $purchases_you = Purchase::whereDate('created_at', $today)
                                    ->where('maker_id', $id)
                                    ->where('category_name', "洋菓子")
                                    ->orderBy('arrived_at', 'desc')
                                    ->get();
        
    	$pdf = PDF::loadView('hello', compact('maker','purchases_kasi', 'purchases_huku', 'purchases_syoku', 'purchases_you'));

    	return $pdf->download('hello.pdf');
    }
}
