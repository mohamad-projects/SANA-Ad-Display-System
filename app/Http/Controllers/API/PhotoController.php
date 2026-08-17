<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller {

    // لجلب آخر صورتين فقط (للعرض في السينما)
    public function index() {
        return response()->json(Photo::latest()->take(10)->get());
    }

    // لجلب كل الصور (للأرشيف)
    public function archive() {
        return response()->json(Photo::latest()->get());
    }

    public function store(Request $request) {
        $user = $request->user();

        $request->validate(['image' => 'required|image|max:2048']);

        $path = $request->file('image')->store('public/photos');
        $photo = $user->photos()->create([
            'path' => asset(Storage::url($path))
        ]);

        return response()->json($photo, 201);
    }

    public function destroy($id) {
        $photo = Photo::findOrFail($id);
        $filename = basename($photo->path);
        Storage::delete('public/photos/' . $filename);
        $photo->delete();
        return response()->json(['message' => 'تم الحذف بنجاح']);
    }
}
