<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DropZoneJSFileUploadController extends Controller
{

       public function dropzoneForm()
       {
            return view('images.dropzone');
       }


       /**
        * @param Request $request
        * @return JsonResponse
       */
       public function dropzoneStore(Request $request): JsonResponse
       {
            $image = $request->file('file');

            $filename = time() . '.' . $image->extension();

            $image->move(public_path('images/dropzone'), $filename);

            return response()->json(['success' => $filename]);
       }
}
