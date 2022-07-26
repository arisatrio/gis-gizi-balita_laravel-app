<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Phpml\Classification\SVC;

use App\Models\DataNormalisasi;
use App\Models\DataTesting;
use App\Models\SVMParameter;
use App\Models\SVMLog;

class DataTestingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalDataTraining = DataNormalisasi::count();

        if($request->ajax()) {
            $data = DataTesting::with('trainingNorm');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('umur_norm', function ($row) {
                    return $row->trainingNorm->umur_norm;
                })
                ->addColumn('jk_norm', function ($row) {
                    return $row->trainingNorm->jk_norm;
                })
                ->addColumn('bb_norm', function ($row) {
                    return $row->trainingNorm->bb_norm;
                })
                ->addColumn('tb_norm', function ($row) {
                    return $row->trainingNorm->tb_norm;
                })
                ->addColumn('lk_norm', function ($row) {
                    return $row->trainingNorm->lk_norm;
                })
                ->addColumn('ld_norm', function ($row) {
                    return $row->trainingNorm->ld_norm;
                })
                ->addColumn('status_norm', function ($row) {
                    return $row->trainingNorm->status_norm;
                })
                ->addColumn('status_prediksi', function ($row) {
                    return $row->status_testing;
                })
                ->make(true);
        }

        return view('admin.data-testing.index', compact('totalDataTraining'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // CEK apakah data training yang sudah di normalisasi tidak kosong, jika kosong proses tidak dilanjutkan
        $trainNorm = DataNormalisasi::with('testing')->get();
        if($trainNorm->count() == 0) {
            return redirect()->route('admin.data-normalisasi.index')->with('error', 'Data Training Normalisasi kosong, silahkan generate data training normalisasi terlebih dahulu!');
        } 
        // Ambil data training dan label dari tabel data normalisasi
        $train      = [];
        $labels     = [];
        $idToTrain  = [];
        foreach($trainNorm as $key => $d) {
            $train[$key]        = [$d->umur_norm, $d->jk_norm, $d->bb_norm, $d->status_norm, $d->id];
        }
        // splice data train jadi test data
        $test       = array_values(array_intersect_key($train, array_flip(array_rand($train, $request->total_data_to_train))));
        foreach($test as $key => $t) {
            $labels[$key]       = $t[3];
            $idToTrain[$key]    = $t[4];
            unset($test[$key][3]);
            unset($test[$key][4]);
        }
        foreach($train as $key => $tr) {
            unset($train[$key][3]);
            unset($train[$key][4]);
        }
        //Instansiasi SVC Objek
        $classifier = new SVC(
            $request->kernel,
            $request->c_param,
            $request->degree,
            $request->gamma,
            $request->coef0,
            $request->tolerance,
            $request->cache,
            true,
            true
        );
        // Training
        $classifier->train($train, $labels);
        // Testing
        $testing = $classifier->predict($test);

        DB::beginTransaction();
        try {
            // Simpan data parameter ke tabel svm_parameter
            $param = SVMParameter::create([
                'kernel'    => $request->kernel,
                'c_param'   => $request->c_param,
                'degree'    => $request->degree,
                'gamma'     => $request->gamma,
                'coef0'     => $request->coef0,
                'tolerance' => $request->tolerance,
                'cache'     => $request->cache,
            ]);
            // Simpan data ke tabel svm_log
            $param->svmLog()->create([
                'total_data_to_train'   => $request->total_data_to_train,
                'total_data_to_test'    => $trainNorm->count() - $request->total_data_to_train,
            ]);
            // Simpan data hasil testing ke tabel data_testing
            for($i=0; $i<count($idToTrain); $i++) {
                DataTesting::updateOrCreate(['tb_data_normalisasi_id' => $idToTrain[$i]], [
                    'tb_data_normalisasi_id'    => $idToTrain[$i],
                    'status_testing'            => $testing[$i]
                ]);
            }

            DB::commit();

            return redirect()->route('admin.data-testing.index')->with('success', 'Proses Klasifikasi SVM Selesai');
        } catch (\Exception $e) {
            DB::rollback();
            
            return redirect()->route('admin.data-testing.index')->with('error', 'Proses Klasifikasi SVM gagal');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
