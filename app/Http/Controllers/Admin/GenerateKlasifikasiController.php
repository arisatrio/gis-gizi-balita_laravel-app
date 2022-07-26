<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Phpml\Preprocessing\Normalizer;
use Phpml\Classification\SVC;

use App\Models\BalitaCheck;
use App\Models\DataNormalisasi;
use App\Models\DataTraining;
use App\Models\SVMParameter;

class GenerateKlasifikasiController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id)
    {
        //FIND BALITA checkup
        $balita = BalitaCheck::with('balita')->find($id);
        //NORMALISASI DATA BALITA
        $testNormalized = $this->normalisasi($balita);
        // panggil tabel data training normalisasi
        $trainNorm = DataNormalisasi::with('testing')->get();
        // TRANSFORM DATA TRAINING DAN DATA BALITA
        $transform = $this->transform($trainNorm, $testNormalized);
        // instansiasi objek svc dari settingan parameter di table svc parameter
        $param  = SVMParameter::latest()->first();
        $classifier = new SVC(
            $param->kernel,
            $param->c_param,
            $param->degree,
            $param->gamma,
            $param->coef0,
            0.001,
            100,
            true,
            true
        );
        // training data dari table data normalisasi semua
        $classifier->train($transform[0], $transform[1]);
        // fit to predict
        $status = $classifier->predict($testNormalized);
        // update status gizi di table balita_checks
        $balita->update(['status' => $status]);
        $balita->balita->update(['status' => $status]);
        
        return redirect()->route('admin.data-check-up.index')->with('success', 'Klasifikasi Gizi BB/U berhasil');
    }

    public function normalisasi($test)
    {
        // Ambil data training
        $training = DataTraining::with('normalisasi')->get();
        if($training->count() == 0) {
            return redirect()->route('admin.data-normalisasi.index')->with('error', 'Data Training kosong, silahkan isi data terlebih dahulu!');
        }
        $training = $training->makeHidden(['id', 'created_at', 'updated_at']);
        
        // Data yang di normalisasi : umur, bb
        $umur_norm  = $training->pluck('umur')->toArray();
        $bb_norm    = $training->pluck('bb')->toArray();
        // Get data test
        $test_umur_norm = (int) filter_var($test->age, FILTER_SANITIZE_NUMBER_INT);
        $test_bb_norm   = $test->bb;
        // PUSH
        array_push($umur_norm, $test_umur_norm);
        array_push($bb_norm, $test_bb_norm);
        //JENKEL
        $jenkel = 1;
        if($test->gender === 'P') {
            $jenkel = 0;
        }
        // Data yang akan di normalisasi dijadikan dalam satu array
        $toNormalisasi = [
            $umur_norm,
            $bb_norm,
        ];

        // Proses normalisasi
        $normalizer = new Normalizer(Normalizer::NORM_L1);
        $normalized = $normalizer->transform($toNormalisasi);
        
        $umurNormalized = end($normalized[0]);
        $bbNormalized = end($normalized[1]);

        return [$umurNormalized, $jenkel, $bbNormalized];
    }
    
    public function transform($trainNorm, $testNormalized)
    {
        // dd($testNormalized);
        // CEK apakah data training yang sudah di normalisasi tidak kosong, jika kosong proses tidak dilanjutkan
        if($trainNorm->count() == 0) {
            return redirect()->route('admin.data-normalisasi.index')->with('error', 'Data Training Normalisasi kosong, silahkan generate data training normalisasi terlebih dahulu!');
        } 
        // Ambil data training dan label dari tabel data normalisasi
        $train      = [];
        $labels     = [];
        foreach($trainNorm as $key => $d) {
            $train[$key]        = [$d->umur_norm, $d->jk_norm, $d->bb_norm];
            $labels[$key]       = $d->status_norm;
        }

        return [$train, $labels];
    }

    public function instanceSVC($param)
    {
        $classifier = new SVC(
            $param->kernel,
            $param->c_param,
            $param->degree,
            $param->gamma,
            $param->coef0,
            $param->tolerance,
            100,
            true,
            true
        );

        return $classifier;
    }
}
