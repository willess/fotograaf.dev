<?php

namespace App\Http\Controllers;

use App\User;
use App\Header;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Image;


use App\Http\Requests;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = User::findorfail(Auth::User()->id);
        return view('profile/edit', compact('user'));
    }

    public function update(Request $request)
    {
        if($request->hasFile('avatar'))
        {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
        }
        $this->validate($request, [
            'first_name' => 'required|max:50',
            'last_name' => 'max:150',
            'city' => 'max:250',
            'avatar' => 'image|mimes:jpeg,png,jpg,svg,gif|max:8096'
        ]);


        $user = User::findorfail(Auth::User()->id);

        if($request->hasFile('avatar'))
        {
            Image::make($avatar)->fit(300, 300)->save(public_path('/uploads/avatars/' . $filename));
            $user->avatar = $filename;
        }
        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->city = $request['city'];
        $user->save();

        $request->session()->flash('alert-success', 'Profiel is succesvol gewijzigd!');
        return redirect('/profiel');
    }
}
