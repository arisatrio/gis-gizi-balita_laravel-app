<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\http\Requests\Balita\BalitaStoreRequest;
use App\Models\Balita;
use App\Models\Posyandu;
use App\Models\User;

class BalitaSayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = Balita::with(['posyandu', 'parent'])->where('parent_id', auth()->user()->id)->get();

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
                    $riwayat = '<button type="button" id="edit" data-id="'.$row->id.'" class="btn btn-outline-primary btn-block mb-2"><i class="fas fa-calendar-check"></i> Riwayat</button>';
                    $edit = '<a href="'.route('user.balita-saya.edit', $row->id).'" class="btn btn-default btn-sm">EDIT</a>'; 
                    $delete = '<a href="javascript:void(0)" onclick="delete_balita('.$row->id.')" class="btn btn-default btn-sm mx-2">HAPUS</a>';
                    return $riwayat.$edit.$delete;
                })
                ->rawColumns(['posyandu', 'action'])
                ->make(true);
        }

        return view('_user.balita-saya.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posyandu   = Posyandu::with('rukunWarga')->active()->get();

        return view('_user.balita-saya.create', compact('posyandu'));
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

        return redirect()->route('user.balita-saya.index')->with('success', 'Data Balita berhasil ditambahkan');
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
        $data_balita    = Balita::find($id);
        $posyandu       = Posyandu::with('rukunWarga')->active()->get();
        $users          = User::active()->masyarakat()->get(); 

        return view('_user.balita-saya.edit', compact('data_balita', 'posyandu', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BalitaStoreRequest $request, $id)
    {
        $data_balita    = Balita::find($id);
        $data_balita->update($request->validated());

        return redirect()->route('user.balita-saya.index')->with('success', 'Data Balita berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data_balita    = Balita::find($id);
        $data_balita->delete();
        
        return response()->json([
            'message' => 'success'
        ]);
    }
}
