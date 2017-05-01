<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class HeaderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $user = User::findorfail(Auth::User()->id);
        return view('header/edit', compact('user'));
    }

    public function update (Request $request)
    {
        if($request->hasFile('header')) {
            $header = $request->file('header');
            $filename = time() . '.' . $header->getClientOriginalExtension();
            Image::make($header)->save(public_path('/uploads/headers/' . $filename));
        }
        $this->validate($request, [
            'title' => 'required|max:15',
            'text' => 'max: 100',
//            'header' => 'image|mimes:jpeg,png,jpg,svg,gif|max:4096'
                        'header' => 'image|mimes:jpeg,png,jpg,svg,gif|max:12000',

        ]);

        $user = Auth::user();
        $header = $user->header;

        if($request->hasFile('header'))
        {
            $user->header->header = $filename;
        }
        $header->title = $request['title'];
        $header->text = $request['text'];

        $header->save();

        $request->session()->flash('alert-success', 'Header is succesvol gewijzigd!');
        return redirect('/header');
    }
}
