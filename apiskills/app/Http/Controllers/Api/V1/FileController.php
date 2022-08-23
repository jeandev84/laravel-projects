<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileController extends Controller
{

     // /storage/app/apiDocs/wVWUSWs84M5ttmJKzhMEOCd0wkA6K81DWb8OS5Le.jpg
     public function upload(Request $request)
     {
         $fileName = $request->file('upload')->store('apiDocs');

         return compact('fileName');
     }
}
