<?php

namespace App\Http\Controllers;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function create(Request $request){
        $perPage = $request->input('per_page', 10); // Default to 10 if not specified
        $photos = Photo::paginate($perPage); // Paginate with dynamic per page value
        return view('upload', compact('photos', 'perPage'));
    }

    public function storeSingle(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $image = $request->file('image');
        $name = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('images'), $name);

        Photo::create(['image' => $name]);

        return back()->with('success', 'Single image uploaded successfully!');
    }

    public function storeMultiple(Request $request){
        $request->validate([
            'images.*' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        foreach($request->file('images') as $image){
            $name = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('images'), $name);

            Photo::create(['image' => $name]);
        }

        return back()->with('success', 'Multiple images uploaded successfully!');
    }

    public function destroy($id){
        $photo = Photo::findOrFail($id);
        $imagePath = public_path('images/' . $photo->image);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        $photo->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}