<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Http\Requests\Pengguna\PenggunaStoreRequest;
use App\Http\Requests\Pengguna\PenggunaUpdateRequest;
use App\Models\User;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()) {
            $data = User::active()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('role', function ($row) {
                    return '<span class="badge badge-dark">'.$row->role.'</span>';
                })
                ->addColumn('status', function ($row) {
                    if($row->status === 'active') {
                        return '<span class="badge badge-success">'.$row->status.'</span>';
                    } else {
                        return '<span class="badge badge-danger">'.$row->status.'</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    $edit = '<a href="'.route('admin.data-pengguna.edit', $row->id).'" class="btn btn-default btn-sm">EDIT</a>'; 
                    $delete = '<a href="javascript:void(0)" onclick="delete_pengguna('.$row->id.')" class="btn btn-default btn-sm mx-2">HAPUS</a>';
                    if($row->id == auth()->user()->id){
                        $delete = '';
                    }
                    return $edit.$delete;
                })
                ->rawColumns(['role', 'status', 'action'])
                ->make(true);
        }
        return view('admin.pengguna.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PenggunaStoreRequest $request)
    {
        User::create(array_merge($request->validated(), ['password' => bcrypt('123456')]));

        return redirect()->route('admin.data-pengguna.index')->with('success', 'Data Pengguna berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $data_pengguna)
    {
        return view('admin.pengguna.edit', compact('data_pengguna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PenggunaUpdateRequest $request, User $data_pengguna)
    {
        $data_pengguna->update($request->validated());

        return redirect()->route('admin.data-pengguna.index')->with('success', 'Data Pengguna berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $data_pengguna)
    {
        $data_pengguna->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
