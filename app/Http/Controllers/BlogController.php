<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class BlogController extends Controller
{

public function blog($slug){
$post = Post::where('slug', '=', $slug)->firstOrFail();
return view('post', compact('post'));
}

public function category($id)
{
    $posts = Post::where('category_id',$id)->where('status','PUBLISHED')->orderBy('created_at','DESC')->paginate('9');
    return view('blog',compact('posts'))->with('home','Artículos por Categoría');
}

public function author($id)
{
    $posts = Post::where('author_id',$id)->where('status','PUBLISHED')->orderBy('created_at','DESC')->paginate('9');
    return view('blog',compact('posts'))->with('home','Artículos por Author');
}

public function search(request $request)
{
    $authors = User::select('id')->where('name', 'LIKE', '%' . $request->search . '%');
    $categories = Category::select('id')->where('name', 'LIKE', '%' . $request->search . '%');

    $search = Post::select('id')->where('title', 'LIKE', '%' . $request->search . '%')
    ->orwhere('slug', 'LIKE', '%' . $request->search . '%')
    ->orwhere('body', 'LIKE', '%' . $request->search . '%')
    ->orwhere('excerpt', 'LIKE', '%' . $request->search . '%')
    ->orwhere('meta_description', 'LIKE', '%' . $request->search . '%')
    ->orwhere('meta_keywords', 'LIKE', '%' . $request->search . '%')
    ->orwhereIn('author_id',$authors)
    ->orwhereIn('category_id',$categories);
    
    $posts =  Post::whereIn('id',$search)->where('status','PUBLISHED')->orderBy('created_at','DESC')->paginate(10); 

    return view('blog',compact('posts'))->with('home','Resultados de la búsqueda . . .');
}


}



