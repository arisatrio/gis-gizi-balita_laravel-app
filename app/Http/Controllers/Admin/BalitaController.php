<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

use App\http\Requests\Balita\BalitaStoreRequest;
use App\Models\Posyandu;
use App\models\Balita;

class BalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Balita::with('posyandu')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('age', function ($row) {
                    return $row->age;
                })
                ->addColumn('posyandu', function ($row) {
                    return '<span class="badge badge-primary">'.$row->posyandu->name.'</span>';
                })
                ->addColumn('last_check', function ($row) {
                    return '-';
                })
                ->addColumn('action', function ($row) {
                    $checkIn = '<a href="'.route('admin.balita-checkup.create', $row->id).'" class="btn btn-outline-success btn-block"><i class="fas fa-plus"></i> Check Up</a>';
                    $riwayat = '<button type="button" id="edit" data-id="'.$row->id.'" class="btn btn-outline-primary btn-block mb-2"><i class="fas fa-calendar-check"></i> Riwayat</button>';
                    $edit = '<a href="'.route('admin.data-balita.edit', $row->id).'" class="btn btn-default btn-sm">EDIT</a>'; 
                    $delete = '<a href="javascript:void(0)" onclick="delete_balita('.$row->id.')" class="btn btn-default btn-sm mx-2">HAPUS</a>';
                    return $checkIn.$riwayat.$edit.$delete;
                })
                ->rawColumns(['posyandu', 'action'])
                ->make(true);
        }
        return view('admin.balita.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posyandu = Posyandu::with('rukunWarga')->active()->get();

        return view('admin.balita.create', compact('posyandu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BalitaStoreRequest $request)
    {
        Balita::create($request->validated());

        return redirect()->route('admin.data-balita.index')->with('success', 'Data Balita berhasil ditambahkan');
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
    public function edit(Balita $data_balitum)
    {
        $posyandu = Posyandu::with('rukunWarga')->active()->get();
        $data_balita = $data_balitum;

        return view('admin.balita.edit', compact('data_balita', 'posyandu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BalitaStoreRequest $request, Balita $data_balitum)
    {
        $data_balitum->update($request->validated());

        return redirect()->route('admin.data-balita.index')->with('success', 'Data Balita berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balita $data_balitum)
    {
        $data_balitum->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
