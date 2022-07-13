<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Http\Requests\RW\RukunWargaStoreRequest;
use App\Http\Requests\RW\RukunWargaUpdateRequest;
use App\Models\RukunWarga;

class RukunWargaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = RukunWarga::orderByRw()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return '<span class="badge badge-primary">'.$row->name.'</span>';
                })
                ->addColumn('action', function ($row) {
                    $edit = '<a href="'.route('admin.data-rw.edit', $row->id).'" class="btn btn-default btn-sm">EDIT</a>'; 
                    $delete = '<a href="javascript:void(0)" onclick="delete_rw('.$row->id.')" class="btn btn-default btn-sm mx-2">HAPUS</a>';
                    return $edit.$delete;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        return view('admin.rw.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rw.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RukunWargaStoreRequest $request)
    {
        RukunWarga::create($request->validated());

        return redirect()->route('admin.data-rw.index')->with('success', 'Data RW berhasil ditambahkan');
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
    public function edit(RukunWarga $data_rw)
    {
        return view('admin.rw.edit', compact('data_rw'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RukunWargaUpdateRequest $request, RukunWarga $data_rw)
    {
        $data_rw->update($request->validated());

        return redirect()->route('admin.data-rw.index')->with('success', 'Data RW berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RukunWarga $data_rw)
    {
        $data_rw->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
