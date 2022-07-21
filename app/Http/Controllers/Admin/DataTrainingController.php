<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

use App\Models\DataTraining;
use App\Http\Requests\DataTrainingStoreRequest;

class DataTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        if($request->ajax()) {
            $data = DataTraining::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('jk', function ($row) {
                    if($row->jk) {
                        return 'L';
                    } else {
                        return 'P';
                    }
                })
                ->addColumn('status', function ($row) {
                    if($row->status == 0){
                        return 'Gizi Buruk';
                    } else{
                        return 'Gizi Baik';
                    }
                })
                ->addColumn('action', function ($row) {
                    $edit = '<a href="'.route('admin.data-training.edit', $row->id).'" class="btn btn-default btn-sm">EDIT</a>'; 
                    $delete = '<a href="javascript:void(0)" onclick="delete_training('.$row->id.')" class="btn btn-default btn-sm mx-2">HAPUS</a>';
                    
                    return $edit.$delete;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.data-training.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.data-training.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DataTrainingStoreRequest $request)
    {

        DataTraining::create($request->validated());

        return redirect()->route('admin.data-training.index')->with('success', 'Data Training berhasil ditambahkan');
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
        $data = DataTraining::find($id);

        return view('admin.data-training.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DataTrainingStoreRequest $request, $id)
    {
        $data = DataTraining::find($id);
        $data->update($request->validated());

        return redirect()->route('admin.data-training.index')->with('success', 'Data Training berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DataTraining::find($id);
        $data->delete();

        return response()->json([
            'message' => 'success'
        ]);
    }
}
