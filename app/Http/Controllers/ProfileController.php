<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $profile = auth()->user()->profile()->firstOrNew([]);

        return view('users.profile', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $profile = auth()->user()->profile()->firstOrNew([]);

        $profile->fill($request->all());

        if ($request->hasFile('avatar')) {
            $profile->avatar = $request->file('avatar')->store('avatars', 'public');
        }
        $profile->save();

        return back();
    }
}
