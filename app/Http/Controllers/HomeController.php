<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index(){
        $blogs = Blog::where('status','1')->orderBy('created_at','desc')->get();
        return view('dashboard',compact('blogs'));
    }
}
