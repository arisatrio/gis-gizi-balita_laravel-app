<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DataTraining;
use Phpml\Preprocessing\Normalizer;

class GenerateNormalisasiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Ambil data training
        $training = DataTraining::with('normalisasi')->get();
        if($training->count() == 0) {
            return redirect()->route('admin.data-normalisasi.index')->with('error', 'Data Training kosong, silahkan isi data terlebih dahulu!');
        }
        $training = $training->makeHidden(['id', 'created_at', 'updated_at']);
        
        // Data yang di normalisasi : umur, bb, tb, lk, ld
        $umur_norm  = $training->pluck('umur')->toArray();
        $bb_norm    = $training->pluck('bb')->toArray();

        // Data yang akan di normalisasi dijadikan dalam satu array
        $toNormalisasi = [
            $umur_norm,
            $bb_norm,
        ];

        // Proses normalisasi
        $normalizer = new Normalizer(Normalizer::NORM_L1);
        $normalized = $normalizer->transform($toNormalisasi);

        // Simpan ke database
        foreach($training as $key => $data) {
            $data->normalisasi()->updateOrCreate(['tb_data_training_id' => $data->id],[
                'umur_norm'     => $normalized[0][$key],
                'jk_norm'       => $data->jk,
                'bb_norm'       => $normalized[1][$key],
                'status_norm'   => $data->status,
            ]);
        }
        
        return redirect()->route('admin.data-normalisasi.index')->with('success', 'Data Normalisasi berhasil di buat');
    }
}
