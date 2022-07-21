<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lokasi;
use App\Models\Posyandu;

class DashboardMapController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $lokasi = Lokasi::first();
        $posyandu = Posyandu::with(['rukunWarga'])->withCount(['balita', 'totalGiziBaik', 'totalGiziBuruk'])->active()->get();

        return view('admin.dashboard-map', compact('lokasi', 'posyandu'));
    }
}
