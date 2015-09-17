<?php

namespace Coverart\Http\Controllers;

use Coverart\Cover;
use Coverart\User;
use Illuminate\Http\Request;

use Coverart\Http\Requests;
use Coverart\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function show(User $user)
    {
        $count = Cover::where('user_id', $user->id)->count();
        return view('profiles.show', ['user' => $user, 'coverCount' =>$count]);
    }

    public function edit(User $user)
    {
        $this->checkAuth($user);
        return view('profiles.edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $this->checkAuth($user);
        dd($request->all());
        $this->validate($request, [
            'display_name' => 'max:50',
            'email' => 'email|max:255|unique:users',
            'password' => 'required_with:password_confirmation|confirmed|min:6',
        ]);

        $user->update($request->all());

        return redirect()->route('profiles.show', [$user->id])->with('message', 'Profile updated');
    }

    private function checkAuth(User $user)
    {
        if (Auth::id() !== $user->id)
            abort(403);
    }
}

