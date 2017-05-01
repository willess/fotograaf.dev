<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit(Request $request, $id)
    {
        $category = Category::findorfail($id);

//        dd($category);
        $user = User::findorfail($category->user_id);

//        dd($user);

        if(Auth::user()->username !== $user->username){
            $request->session()->flash('alert-danger', 'Je had geen toegang tot de aangevrraagde pagina, daarom hebben we je teruggestuurd naar de homepagina!');
            return redirect('/');
        }


//        dd($category);


        $categories = Category::with('pictures')
            ->where('id', $category->id)
            ->get();

        $categoryCount = $categories[0];

//        dd($categories[0]);



        return view('category/edit', compact('category', 'categories', 'categoryCount'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $categories = $user
            ->categories()
            ->get();
//            dd($categories);

        $category = Category::findorfail($request['id']);

        foreach($categories as $categorie)
        {
            if($request['category'] === $categorie->name && $category->name !== $request['category'])
//                $categoryError = 'Deze categorie bestaat al!';
            return redirect('category/'.$category->id.'/edit');
        }

        $this->validate($request, [
            'category' => 'required|min:3|max:25|alpha_dash'
        ]);

        $category->name = $request['category'];
        $category->save();

        $request->session()->flash('alert-success', 'Categorie is succesvol gewijzigd!');

        return redirect('category/'.$category->id.'/edit');
    }

    public function delete(Request $request, $id)
    {
        $category = Category::findorfail($id);

        $category->delete();

        $request->session()->flash('alert-success', 'Categorie is succesvol Verwijderd!');
        return redirect('image');
    }
}
