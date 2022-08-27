<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
      public function resizeImageForm()
      {
           return view('images.resize-image');
      }


      public function resizeImageSubmit(Request $request)
      {
           $image = $request->file;
           $filename = $image->getClientOriginalName();

           $resizeImage = Image::make($image->getRealPath());
           $resizeImage->resize(300, 300);
           $resizeImage->save(public_path('images/'. $filename));

           return "Image has been resized successfully!";
      }
}
