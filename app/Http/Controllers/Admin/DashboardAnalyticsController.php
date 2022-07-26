<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Posyandu;
use App\Models\Balita;
use App\Models\BalitaStatus;

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
        $totalGiziBaik  = Balita::where('status', 1)->count();
        $totalGiziBuruk = Balita::where('status', 0)->count();
        $totalNullGizi  = Balita::whereNull('status')->count();

        // BAR STACKED CHART
        $posyandu = Posyandu::with('balita')->active();
        $labels = $posyandu->pluck('name')->toArray();
        $giziBaik           = $posyandu->withCount('giziBaik')->pluck('gizi_baik_count')->toArray();
        $giziBuruk          = $posyandu->withCount('giziBuruk')->pluck('gizi_buruk_count')->toArray();
        $belumKlasifikasi   = $posyandu->withCount('belumKlasifikasi')->pluck('belum_klasifikasi_count')->toArray();

        $dataset        = [$giziBaik, $giziBuruk, $belumKlasifikasi];
        $klasifikasi    = ['Gizi Baik', 'Gizi Buruk', 'Belum diklasifikasi'];
        $bgColor        = ['#28a745', '#dc3545', 'grey'];

        for($i=0; $i<count($klasifikasi); $i++) {
            $data[$i] = [
                "label"             => $klasifikasi[$i],
                "data"              => $dataset[$i],
                "backgroundColor"   => $bgColor[$i]
            ];
        }

        // PIE CHART
        $dataPie = [$totalGiziBaik, $totalGiziBuruk, $totalNullGizi];
        
    
        return view('admin.dashboard', compact('totalPosyandu', 'totalBalita', 'totalGiziBaik', 'totalGiziBuruk', 'labels', 'data', 'dataPie'));
    }
}
