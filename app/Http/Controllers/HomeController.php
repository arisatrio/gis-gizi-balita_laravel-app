<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lokasi;
use App\Models\Posyandu;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $lokasi = Lokasi::first();
        $posyandu = Posyandu::with(['rukunWarga'])->withCount(['balita', 'totalGiziBaik', 'totalGiziBuruk'])->active()->get();
        
        return view('welcome', compact('lokasi', 'posyandu'));
    }
}
