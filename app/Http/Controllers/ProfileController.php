<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('_user.profile');
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
        $validated = $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|unique:users,email,'.auth()->user()->id,
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);
        auth()->user()->update($validated);

        return redirect()->route('profile.index')->with('success', 'Profile berhasil diperbaharui');
    }
}
