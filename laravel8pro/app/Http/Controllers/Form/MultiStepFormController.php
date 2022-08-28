<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MultiStepFormController extends Controller
{
       public function index()
       {
            return view('form.multi.step');
       }


       public function formSubmit(Request $request)
       {
             return $request->all();
       }
}
