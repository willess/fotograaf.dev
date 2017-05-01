<?php

namespace App\Http\Controllers;

use App\Category;
use App\Parentcomment;
use App\Thumbnail;
use Illuminate\Http\Request;
use App\User;
use App\Picture;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use PhpParser\Node\Expr\Array_;
use Validator;
//use Image;

class ImageController extends Controller
{
//check if user is logged in
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

//get all images from the user
    public function index()
    {
        //get user
        $user = Auth::user();

        $array = array();

        $categories = $user
            ->categories()
            ->get();

        $categories = Category::with('pictures')
            ->where('user_id', $user->id)
            ->get();

//        dd($categories);

        //get images from user
        $images = $user
            ->picture()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('image/index', compact('categories'));
    }

    //create page to add a new image
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();
        $categories = $user
            ->categories()
            ->get();

        return view('image/create', compact('categories'));
    }

    //store the image
    /**
     * @param Request $request
     */
    public function store(Request $request)
    {
//        dd($request['tags']);
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            $thumbnailname = time(). 'thumbnail.' . $file->getClientOriginalExtension();
//            $data = Image::make($file)->exif('Model');
//            $model = Image::make($file)->exif('COMPUTED')['Height'];

            $thumbnail = Image::make($file->getRealPath())->orientate()->fit(600, 400);

            //store image in project
//            $data = Image::make($file)->orientate()->save(public_path('/uploads/images/' . $filename));
        //get specific data from image

        }


        //validate the input
        $this->validate($request, [
//            'image' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:4096',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:12000',
            'title' => 'required|max:50',
            'location' => 'max: 100',
            'subscription' => 'max:1500',
            'category' => 'required|min:3|max:25'
        ]);

        if($request->hasFile('image'))
        {
            $thumbnail->save(public_path('/uploads/thumbnails/' . $thumbnailname));
            $data = Image::make($file)->orientate()->save(public_path('/uploads/images/' . $filename));

        }


        //create a new image and store it in database
        $image = new Picture();
        $image->image = $filename;
        $image->title = $request['title'];
        $image->location = $request['location'];
        $image->subscription = $request['subscription'];
        $image->save();

        //save the tumbnail location in db
        $thumbnail = new Thumbnail();
        $thumbnail->image = $thumbnailname;
        $image->thumbnail()->save($thumbnail);

//        dd($image);
        //add image to user
        $user = Auth::user();
        $user->picture()->attach($image->id);


        $categories = $user
            ->categories()
            ->where('name', $request['category'])
            ->first();

//        dd($categories);

        //new category and save it
        if(!isset($categories)){
//            dd('test');
            $category = new Category();
            $category->name = $request['category'];
            $category->save();

            //add category to user
            $user->categories()->save($category);

            $id = $category->id;
        }
        else
        {
            $id = $categories->id;
        }


        //add category to image
        $picture = Picture::findorfail($image->id);
        $picture->category()->attach($id);

        $request->session()->flash('alert-success', 'Foto is succesvol toegevoegd!');
        return redirect('/image');
    }

    public function show ($id)
    {
        $image = Picture::findorfail($id);

        $user = $image
            ->users()
            ->first();

        $photos = $user
            ->picture()
            ->inRandomOrder()
            ->take(4)
            ->get();

//        $photos = Picture::inRandomOrder()
//            ->take(4)
//            ->get();

//        $reactions = Parentcomment::with('pictures')
//            ->where('picture_id', $image->id)
//            ->get();
//
        $reactions = $image
            ->parentComments()
            ->orderBy('created_at', 'desc')
            ->get();


//        dd($reactions);

        return view('image/show', compact('image', 'user', 'photos', 'reactions'));
    }

    public function edit (Request $request, $id)
    {
        $image = Picture::findorfail($id);

        $user = $image
            ->users()
            ->first();

        if(Auth::user()->username !== $user->username){
            $request->session()->flash('alert-danger', 'Je had geen toegang tot de aangevrraagde pagina, daarom hebben we je teruggestuurd naar de homepagina!');
            return redirect('/');
        }

        $category = $image
            ->category()
            ->first();

        $categories = $user
            ->categories()
            ->get();

        return view('image/edit', compact('image', 'categories', 'category'));
    }

    public function update (Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'location' => 'max: 100',
            'subscription' => 'max:1500',
            'category' => 'required|min:3|max:25'
        ]);

        $user = Auth::user();

        $categories = $user
            ->categories()
            ->where('name', $request['category'])
            ->first();

//        dd($categories->name);

//        if($categories->name != $request['category'])
//        {
//            dd($request['category']);
//
//        }

        if(!isset($categories)){
//            dd('test');
            $category = new Category();
            $category->name = $request['category'];
            $category->save();

            //add category to user
            $user->categories()->save($category);

            $id = $category->id;
        }
        else
        {
            $id = $categories->id;
        }

        $picture = Picture::findorfail($request['id']);
        $picture->category()->detach();
        $picture->category()->attach($id);



//        dd($categories);

        $image = Picture::findorfail($request->id);

        $image->title = $request['title'];
        $image->location = $request['location'];
        $image->subscription = $request['subscription'];

        $image->save();
//        dd($image);


        $request->session()->flash('alert-success', 'Foto is succesvol Aangepast!');
        return redirect('/image/'.$request->id.'/edit');
    }

    public function destroy (Request $request, $id)
    {
        $image = Picture::findorfail($id);

        $image->thumbnail()->delete();

        $image->delete();

        $request->session()->flash('alert-success', 'Foto is succesvol Verwijderd!');
        return redirect('/image');
    }
}
