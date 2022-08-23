### Views 


Create Views
```php 

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
     public function index()
     {
         $name = "John";

         $users = ["name" => "John", "email" => "john@gmail.com", "phone" => "1234567890"];

         return view('user', compact('name', 'users'));
     }
}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
</head>
<body>
     <h1>User View</h1>
     <h2>User Name {{ $name }}</h2>
     <p>Name : {{ $users['name'] }}</p>
     <p>Email: {{ $users['email'] }}</p>
     <p>Phone: {{ $users['phone'] }}</p>
</body>
</html>


```
