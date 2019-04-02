<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

        $posts = Post::orderBy('title', 'ASC')->where('user_id', auth()->id())->get();

        return view('users.profile', compact('profile', 'posts'));
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
        $profile = auth()->user()->profile;

        $this->validate($request, [
            'description' => 'required|min:10|max:100',
            'nickname' => Rule::unique('user_profiles')->ignore($profile->id),
            // 'nickname' => "unique:user_profiles,nickname,{$profile->id}",
            'avatar' => [
                'image',
                Rule::dimensions()->maxWidth(300)->maxHeight(300),
            ],
            'featured_post_id' => Rule::exists('posts', 'id')
                ->where('user_id', $profile->id)
                ->where('points', '>=', 50)
        ]);

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
