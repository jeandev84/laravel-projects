<?php
namespace App\Http\Controllers\TinyMCE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorController extends Controller
{
       public function editor()
       {
            return view('tinymce.editor');
       }
}
