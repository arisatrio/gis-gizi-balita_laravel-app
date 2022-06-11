<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\http\Requests\Posyandu\PosyanduRequest;

use App\Models\Posyandu;
use App\Models\RukunWarga;
use App\Models\Lokasi;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Posyandu::with(['rukunWarga', 'balita'])->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('balitaCount', function ($row) {
                    return '<span class="badge badge-primary">'.$row->balita->count().'</span>';
                })
                ->addColumn('status', function ($row) {
                    if($row->status === 'active') {
                        return '<span class="badge badge-success">'.$row->status.'</span>';
                    } else {
                        return '<span class="badge badge-danger">'.$row->status.'</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $edit = '<a href="'.route('admin.data-posyandu.edit', $row->id).'" class="btn btn-default btn-sm">EDIT</a>'; 
                    $delete = '<a href="javascript:void(0)" onclick="delete_posyandu('.$row->id.')" class="btn btn-default btn-sm mx-2">HAPUS</a>';
                    return $edit.$delete;
                })
                ->rawColumns(['balitaCount', 'status', 'action'])
                ->make(true);
        }
        return view('admin.posyandu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rukun_warga = RukunWarga::orderByRw()->whereDoesntHave('posyandu')->get();
        $lokasi = Lokasi::first();

        return view('admin.posyandu.create', compact('rukun_warga', 'lokasi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PosyanduRequest $request)
    {
        Posyandu::create($request->validated());

        return redirect()->route('admin.data-posyandu.index')->with('success', 'Data Posyandu berhasil ditambahkan');
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
    public function edit(Posyandu $data_posyandu)
    {
        $lokasi         = Lokasi::first();
        $rukun_warga    = RukunWarga::orderByRw()->get();

        return view('admin.posyandu.edit', compact('data_posyandu', 'lokasi', 'rukun_warga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PosyanduRequest $request, Posyandu $data_posyandu)
    {
        $data_posyandu->update($request->validated());

        return redirect()->route('admin.data-posyandu.index')->with('success', 'Data Posyandu berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posyandu $data_posyandu)
    {
        $data_posyandu->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
