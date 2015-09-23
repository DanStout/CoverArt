<?php

namespace Coverart\Http\Controllers;

use Coverart\Cover;
use Coverart\User;
use Illuminate\Http\Request;

use Coverart\Http\Requests;
use Coverart\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Fluent;
use Validator;

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

        $rules =
        [
            'display_name' => 'max:50',
            'email' => 'email|max:255',
            'password' => 'required_with:password_confirmation|confirmed|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        $validator->sometimes('email', 'unique:users', function(Fluent $input) use ($user){
            return $input->email !== $user->email;
        });

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $nonEmpty = array_filter($request->all(), 'strlen');
        if (in_array('password', $nonEmpty))
            $nonEmpty['password'] = bcrypt($nonEmpty['password']);
        $user->update($nonEmpty);

        return redirect()->route('profiles.show', [$user->id])->with('message', 'Profile updated');
    }

    private function checkAuth(User $user)
    {
        if (Auth::id() !== $user->id)
            abort(403);
    }
}

