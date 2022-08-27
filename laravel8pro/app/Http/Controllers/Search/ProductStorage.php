<?php
namespace App\Http\Controllers\Search;

class ProductStorage
{

     public static function getStack()
     {
          return [
             ["name" => "Phone"],
             ["name" => "Tablet"],
             ["name" => "Laptop"],
             ["name" => "Watch"],
             ["name" => "Television"],
             ["name" => "Freeze"],
          ];
     }
}
