<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){
        $posts = DB::select("SELECT * FROM posts ORDER BY created_at DESC");
        return view('/home', ['posts' => $posts]);
    }

    public function createForm(){
        return view('create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        $imagePath = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagePath = 'uploads/' . time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imagePath);
        }

        DB::insert("INSERT into posts (title, body, image, category, tags, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())", [
            $request ->title,
            $request ->body,
            $imagePath,
            $request->category,
            implode(',', $request->tags),
        ]);

        return redirect('/home')->with('succes', 'Blog created successfully!');
    }

    public function updatePost(Request $request, $id){
        if(!session('user')){
            return redirect('/login')->withErrors(['access_denied' => 'Please login first']);
        }

        $request -> validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:10000',
        ]);

        $post = DB::select("SELECT * FROM posts WHERE id = ? AND author = ?", [$id, session('user')]);

        if(!$post){
            return redirect('/profile')->withErrors(['error' => 'Unauthorized access']);
        }

        $imagePath = $post[0]->image;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imagePath = 'uploads/' . time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads'), $imagePath);
        }

        DB::update("UPDATE posts SET title = ?, body = ?, image = ?, updated_at = NOW() WHERE id = ?", [
            $request->title,
            $request->body,
            $imagePath,
            $id,
        ]);

        return redirect('/profile')->with('success', 'Post updated successfully');
    }

    public function deletePost($id){
        if(!session('user')){
            return redirect('/login')->withErrors(['access_denied' => 'Please login first']);
        }

        $post = DB::select("SELECT * FROM posts WHERE id = ? AND author = ?", [$id, session('user')]);

        if(!$post){
            return redirect('/profile')->withErrors(['error' => 'Unauthorized access']);
        }

        DB::delete("DELETE FROM posts WHERE id = ?". [$id]);

        return redirect('/profile')->with('success', 'Post deleted successfully');
    }
}
