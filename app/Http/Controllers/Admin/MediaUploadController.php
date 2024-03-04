<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaUpload;
use Illuminate\Support\Facades\Auth;

class MediaUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');
    }
        
    public function index()
    {
        return view('admin.forms.mediaupload');
    }
    
    public function fileCreate()
    {
        return view('admin.forms.mediaupload');
    }
    
    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('media'),$imageName);
        
        $imageUpload = new MediaUpload();
        $imageUpload->user_id = Auth::user()->id;
        $imageUpload->filename = $imageName;
        $imageUpload->save();
        return response()->json(['id' => $imageUpload->id, 'filename'=>$imageName]);
    }
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        MediaUpload::where('filename',$filename)->delete();
        $path=public_path().'/media/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;  
    }
    
    public function files_list() {
        $media = MediaUpload::all();
        return $media;
    }
}

