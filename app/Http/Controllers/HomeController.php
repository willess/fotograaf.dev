<?php

namespace App\Http\Controllers;

use App\Category;
use App\Header;
use App\Picture;
use App\User;
use App\Thumbnail;

//use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //set searching to false
        $searching = false;

        //check if it's a new user!
        if(!Auth::guest()){
            if(!Auth::user()->header)
            {
                $header = new Header();
                $user = User::findorfail(Auth::user()->id);
                $user->header()->save($header);
            }
        }

        //check if search input is not empty
        if($request->input('search') != null)
        {
            $searching = true;
            $query = $request->input('search');

            $pictures = Picture::
                orderBy('created_at', 'desc')
                ->orwhere('title', 'LIKE', '%' . $query . '%')
                ->orwhere('location', 'LIKE', '%' . $query . '%')
                ->orwhere('subscription', 'LIKE', '%' . $query . '%')
                ->paginate(12);
            $pictures->appends(['search' => $query]);


            return view('home', compact('pictures', 'searching', 'query'));
        }
        else
        {
            $searching = false;
            $pictures = Picture::
            orderBy('created_at', 'desc')
                ->paginate(24);
            return view('home', compact('pictures', 'searching'));
        }
    }

    public function profile($username)
    {
        $user = User::get()
            ->where('username', $username)
            ->first();
        if(!$user)
        {
            return redirect('/  ');
        }

        $categories = Category::with('pictures')
            ->where('user_id', $user->id)
            ->get();

        $images = $user
            ->picture()
            ->get();

        return view('profile', compact('user', 'categories'));
    }
}
