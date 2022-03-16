<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function upload(Request $request, $folder){
//        dd($request->file('photo'));
        $fileName = date('YmdHi') . '_' . Str::random('12') . '.' . $request->file('file')->getClientOriginalExtension();
//        $fileName=$request->file;
        $path=$request->file('file')->storeAs("images/$folder", $fileName, 'public');
//        dd($request->file);
//        dd($path);
        return response()->json(['location'=>"/storage/$path"]);

        /*$imgpath = request()->file('file')->store('uploads', 'public');
        return response()->json(['location' => "/storage/$imgpath"]);*/

    }
}
