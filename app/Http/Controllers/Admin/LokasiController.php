<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lokasi;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_lokasi = Lokasi::first();

        return view('admin.lokasi.index', compact('data_lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, Lokasi $data_lokasi)
    {
        $file = file_get_contents($request->polygon);
        $cek = str_replace(array("\r", "\n", "\t"), '', $file);
        $data = json_decode($cek, true);

        if(array_key_exists("province", $data) && array_key_exists("district", $data) && array_key_exists('sub_district', $data) && array_key_exists('village', $data) && array_key_exists("border", $data)) {    
            $data_lokasi->update([
                'province'      => $data['province'],
                'district'      => $data['district'],
                'sub_district'  => $data['sub_district'],
                'village'       => $data['village'],
                'border'        => serialize($data['border'])
            ]);

            return redirect()->route('admin.data-lokasi.index')->with('success', 'Data Lokasi berhasil diperbaharui');
        } else {
            return redirect()->route('admin.data-lokasi.index')->with('error', 'Format file tidak sesuai!');
        }
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
