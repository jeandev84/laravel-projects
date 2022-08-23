<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
     public function index(Request $request)
     {
         $user = User::where('email', $request->email)->first();

         if (! $user || ! Hash::check($request->password, $user->password)) {
             return response([
                 'message' => ['These credentials do not match our records']
             ], Response::HTTP_NOT_FOUND);
         }

         $token = $user->createToken('my-app-token')->plainTextToken;

         $response = [
             'user' => $user,
             'token' => $token
         ];

         return response($response, Response::HTTP_CREATED);
     }
}
