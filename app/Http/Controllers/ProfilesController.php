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

    public function update(User $user)
    {
        $this->checkAuth($user);

    }

    private function checkAuth(User $user)
    {
        if (Auth::id() !== $user->id)
            abort(403);
    }
}

