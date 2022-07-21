<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Posyandu;
use App\Models\Balita;

class DashboardAnalyticsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $totalPosyandu  = Posyandu::count();
        $totalBalita    = Balita::count();
    
        return view('admin.dashboard', compact('totalPosyandu', 'totalBalita'));
    }
}
