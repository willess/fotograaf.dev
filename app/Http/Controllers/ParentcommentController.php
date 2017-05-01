<?php

namespace App\Http\Controllers;

use App\Parentcomment;
use App\Picture;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ParentcommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'reaction' => 'required|min:2|max:500',
        ]);

        $user = Auth::user();
        $image = Picture::findorfail($request['id']);

        $parentComment = new Parentcomment();
        $parentComment->reaction = $request['reaction'];
        $parentComment->username = $user->username;

        $image->parentcomments()->save($parentComment);
        $user->parentcomments()->save($parentComment);

//        $parentComment->save();

//        dd($parentComment);

        $request->session()->flash('alert-success', 'Reactie is verstuurd!');
        return redirect('image/'.$image->id);

//        dd($request['reaction']);
    }
}
