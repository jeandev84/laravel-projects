<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{

    public function uploadForm()
    {
         return view('upload.form');
    }


    public function uploadFile(Request $request)
    {
          // file (it's the name of input from request)
          // uploaded file will be stored in ./storage/app/public/wgeheherhehre.jpg
          $request->file->store('public');

          return "File has been uploaded successfully!";
    }
}
