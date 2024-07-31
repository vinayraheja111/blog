<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Validator,Auth;

class BlogController extends Controller
{
    public function index(){
        return view('create-blog');
    }

    public function myBlogs(){
        $blogs =  Blog::where('user_id',Auth::user()->id)->get();
        return view('my-blogs',compact('blogs'));
    }

    
    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'description' => 'required',
            'image' => 'required', // Corrected 'mime' to 'mimes'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $blog = new Blog();
        $blog->user_id = Auth::user()->id;
        $blog->title = $request->post('title');
        $blog->description = $request->post('description');
        $file = $request->file('image');
        $fileName = time().'.'.$file->getClientOriginalExtension();
        $destination = public_path('assets/blog');
        $file->move($destination, $fileName);
        $blog->image = $fileName;
        $blog->post_date = now();
        $blog->status = '1';
        $blog->save();

        if($blog){
            return redirect('my-blogs')->with('success','Blog created successfully');
        }
    }

    public function edit(Request $request,$id){
        $blog = Blog::find($id);

        return view('edit-blog',compact('blog'));
    }

    public function update(Request $request, $id){
    $validator = Validator::make($request->all(), [
        'title' => 'required|max:100',
        'description' => 'required',
        'image' => 'nullable|mimes:png,jpg,jpeg', // Image is optional in update
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $blog = Blog::find($id);

    if (!$blog) {
        return redirect()->back()->with('error', 'Blog not found.');
    }

    $blog->title = $request->post('title');
    $blog->description = $request->post('description');

    if ($request->hasFile('image')) {
        // Remove the old image if needed
        if ($blog->image) {
            $oldImagePath = public_path('assets/blog/' . $blog->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Handle the new image upload
        $file = $request->file('image');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $destination = public_path('assets/blog');
        $file->move($destination, $fileName);
        $blog->image = $fileName;
    }

    $blog->post_date = now();
    $blog->status = $request->post('status', $blog->status); // Optional: update status if provided
    $blog->save();

    return redirect('my-blogs')->with('success', 'Blog updated successfully');
}

    public function destroy(Request $request,$id){
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('my-blogs')->with('success', 'Blog deleted successfully');
        
    }
}
