<?php
namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
      public function index()
      {
           return view('login.index');
      }


      public function submit(Request $request)
      {
           $validated = $request->validate([
                'email'    => 'required|email',
                'password' => 'required|min:6|max:12'
           ]);


           $email    = $request->input('email');
           $password = $request->input('password');

           return sprintf('Email : %s || Password : %s', $email, $password);
      }



    public function submitDemo(Request $request)
    {
        $email    = $request->input('email');
        $password = $request->input('password');

        // return $request->all();

        return sprintf('Email : %s || Password : %s', $email, $password);
    }
}
