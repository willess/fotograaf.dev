<?php

namespace App\Http\Controllers;

use App\Feedbackmessage;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('contact/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|min:5|max:1000|alpha_dash',
        ]);

        $user = Auth::user();

        $newMessage = new Feedbackmessage();
        $newMessage->first_name = $user->first_name;
        $newMessage->username = $user->username;
        $newMessage->email = $user->email;
        $newMessage->text = $request['text'];
        $newMessage->save();

        $request->session()->flash('alert-success', 'Bericht is succesvol gestuurd! Wij gaan hier zo snel mogelijk mee aan de slag!');
        return redirect('contact');

    }
}
