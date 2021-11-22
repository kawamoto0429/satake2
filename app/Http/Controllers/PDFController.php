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
        
        $purchases = Purchase::whereDate('created_at', $today)->where('maker_id', $id)->get();

    	$pdf = PDF::loadView('hello', compact('purchases', 'maker'));

    	return $pdf->download('hello.pdf');
    }
}
