<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    
public function index(){
$posts= Post::orderBy('created_at', 'desc')->limit(6)->get();
return view('inicio', compact('posts'));
}

}



