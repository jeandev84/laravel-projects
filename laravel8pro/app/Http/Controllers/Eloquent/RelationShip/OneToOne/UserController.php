<?php
namespace App\Http\Controllers\Eloquent\RelationShip\OneToOne;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
       public function insertRecord(Request $request)
       {
            $phone = new Phone();
            $phone->phone = '+1234567890';

            $user = new User();
            $user->name = 'Jennifer';
            $user->email = 'jennifer@gmail.com';
            $user->password = encrypt('secret'); // Hash::make('secret');

            $user->save();
            $user->phone()->save($phone);

            return "Record has been created";
       }



       public function fetchPhoneByUserId($id)
       {
            $phone = User::find($id)->phone;

            return $phone;
       }
}
