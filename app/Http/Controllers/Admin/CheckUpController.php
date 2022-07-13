<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Http\Requests\Checkup\CheckupStoreRequest;
use App\Models\BalitaCheck;

class CheckUpController extends Controller
{
    public function __construct()
    {
        $this->middleware('tenaga-kesehatan');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        setlocale(LC_ALL, 'IND');
        if($request->ajax()) {
            $data = BalitaCheck::with(['balita', 'balita.posyandu'])->orderByDesc('check_date')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('check_date', function ($row) {
                    return $row->check_date->formatLocalized('%A, %d %B %Y %H:%I:%S');
                })
                ->addColumn('posyandu', function ($row) {
                    return '<span class="badge badge-primary">'.$row->balita->posyandu->name.'</span>';
                })
                ->addColumn('status', function ($row) {
                    if($row->status === 1){
                        return '<span class="badge badge-success">'.$row->status.'</span>';
                    } elseif($row->status === 0) {
                        return '<span class="badge badge-danger">'.$row->status.'</span>';
                    } else {
                        return '<span class="badge badge-dark">Belum diklasifikasi</span>';
                    }
                })
                
                ->addColumn('action', function ($row) {
                    $edit = '<a href="'.route('admin.data-check-up.edit', $row->id).'" class="btn btn-default btn-sm">EDIT</a>'; 
                    $delete = '<a href="javascript:void(0)" onclick="delete_checkup('.$row->id.')" class="btn btn-default btn-sm mx-2">HAPUS</a>';
                    return $edit.$delete;
                })
                ->rawColumns(['posyandu', 'status', 'action'])
                ->make(true);
        }
        return view('admin.balita-checkup.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BalitaCheck $data_check_up)
    {
        return view('admin.balita-checkup.edit', compact('data_check_up'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckupStoreRequest $request, BalitaCheck $data_check_up)
    {
        $data_check_up->update($request->validated());

        return redirect()->route('admin.data-check-up.index')->with('success', 'Data Check Up berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(BalitaCheck $data_check_up)
    {
        $data_check_up->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
