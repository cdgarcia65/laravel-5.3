<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

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
        $this->validate($request, [
            'description' => 'min:10',
            'avatar' => 'image|dimensions:max_width=300,max_height=300'
        ]);

        $profile = auth()->user()->profile;

        $profile->fill($request->all());

        if ($request->hasFile('avatar')) {
            $profile->avatar = $request->file('avatar')
                ->storeAs('avatars/' . auth()->id(), 'avatar.png');
        }

        $profile->save();

        return back();
    }

    /**
     *
     */
    public function avatar()
    {
        $profile = auth()->user()->profile;

        $headers = [
            'Content-Length' => File::size($profile->avatarFile),
            'Content-Type' => File::mimeType($profile->avatarFile)
        ];

        return response()->download(
            $profile->avatarFile,
            null, $headers, ResponseHeaderBag::DISPOSITION_INLINE
        );
    }
}
