<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    public function upload(Request $request)
{
    if ($request->hasFile('upload')) {

        $request->validate([
            'upload' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $file = $request->file('upload');

        $filename = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('Files'), $filename);

        return response()->json([
            "uploaded" => 1,
            "fileName" => $filename,
            "url" => asset('Files/'.$filename)
        ]);
    }

    return response()->json([
        "uploaded" => 0,
        "error" => [
            "message" => "Upload failed"
        ]
    ]);
}
}