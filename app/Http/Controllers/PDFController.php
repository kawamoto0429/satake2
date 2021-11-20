<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use Carbon\Carbon;
use PDF;

class PDFController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        
        $purchases = Purchase::whereDate('created_at', $today)->get();

    	$pdf = PDF::loadView('hello', compact('purchases'));

    	return $pdf->download('hello.pdf');
    }
}
