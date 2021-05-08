<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
   
    public function index()
    {
       
        $user = User::find(Auth::id());
        $posts = $user->posts()->where('Title','!=','')->get();
        return view('posts.index',compact('posts'));

       
    }

    
    public function create()
    {
        if(Gate::denies('logged-in')){
            return redirect('/login');
        }

        return view('posts.create');
    }

    
    public function store(Request $request){
        if(Gate::denies('logged-in')){
            return redirect('/login');
        }
    $request->validate([
        'title' => 'required|max:100',
        'description' => 'required'
    ]);

    if($request->hasFile('img')){

        $filenameWithExt = $request->file('img')->getClientOriginalName();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        
        $extension = $request->file('img')->getClientOriginalExtension();

        $filenameToStore = $filename.'_'.time().'.'.$extension;

        $path = $request->file('img')->storeAs('public/img', $filenameToStore);
    } else{
           
        $filenameToStore = '';
    }

    $post = new Post();
    $post->fill($request->all());
    $post->img = $filenameToStore;
    $post->user_id = auth()->user()->id;


    if ($post->save()){
        return redirect('/posts')->with('status','Sucessfully save');
    }

    return redirect('/posts');

}

    
    public function show(Post $post)
    {
        $post = Post::find($post->id);
        $comments = $post->comments;

        return view('posts.show', compact('post','comments'));
    }

    
    public function edit($id)
    {
        if(Gate::denies('logged-in')){
            return redirect('/login');
        }

        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    
    public function update(Request $request, $id)
    {
        if(Gate::denies('logged-in')){
            return redirect('/login');
        }

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = Post::find($id);
        $post->title = $request->Title;
        $post->description = $request->Description;
        $post->save();

        return redirect('/posts');
    }

   
    public function destroy($id)
    {
        if(Gate::denies('logged-in')){
            return redirect('/login');
        }

        $post = Post::find($id);
        $post->delete();

        return redirect('/posts');
    }
}
