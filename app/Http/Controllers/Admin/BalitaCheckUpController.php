<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Checkup\CheckupStoreRequest;
use App\Models\Balita;
use App\Models\BalitaCheck;

class BalitaCheckUpController extends Controller
{
    public function __construct()
    {
        $this->middleware('tenaga-kesehatan');
    }

    public function create($id)
    {
        $balita = Balita::find($id);

        return view('admin.balita-checkup.create', compact('balita'));
    }

    public function store(CheckupStoreRequest $request)
    {
        $check = BalitaCheck::create($request->validated());

        return redirect()->route('admin.data-balita.index')->with('success', 'Data Check Up berhasil ditambahkan');;
    }

    public function show($id)
    {
        setlocale(LC_ALL, 'IND');
        $balita = Balita::with(['posyandu', 'checkup', 'statusGizi', 'parent'])->find($id);

        $view = view('components.modal-riwayat', ['balita' => $balita]);
        $html = $view->render();

        return ['success' => true, 'html' => $html];
    }
}
