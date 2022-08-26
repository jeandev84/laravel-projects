<?php

namespace App\Http\Controllers\Eloquent\RelationShip\ManyToMany;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;


/**
 *
*/
class RoleController extends Controller
{

      public function addRoles()
      {
           $roles = [
               ["name" => "Administrator"],
               ["name" => "Editor"],
               ["name" => "Author"],
               ["name" => "Contributor"],
               ["name" => "Subscribers"],
           ];

           Role::insert($roles);

           return "Role are created successfully!";
      }



      public function addUser()
      {
          /*
          $user = new User();
          $user->name = "John";
          $user->email = "john@gmail.com";
          $user->password = encrypt('secret');
          $user->save();

          // 1: ID Administrator
          // 2: ID Editor
          $roleIds = [1, 2];
          */

          $user = new User();
          $user->name = "Brown";
          $user->email = "brown@gmail.com";
          $user->password = encrypt('secret');
          $user->save();

          // 2: ID Editor
          // 3: ID Author
          // 4: ID Contributor
          $roleIds = [2, 3, 4];

          $user->roles()->attach($roleIds);

          return "Record has been created successfully!";
      }
}
