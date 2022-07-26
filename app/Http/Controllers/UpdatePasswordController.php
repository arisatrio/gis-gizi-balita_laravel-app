<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpdatePasswordController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validated = $this->validate($request, [
            'password'  => 'min:8|confirmed',
        ]);

        auth()->user()->update([
            'password'  => bcrypt($request->validated),
        ]);

        return redirect()->route('profile.index')->with('success', 'Password berhasil diperbaharui');
    }
}
