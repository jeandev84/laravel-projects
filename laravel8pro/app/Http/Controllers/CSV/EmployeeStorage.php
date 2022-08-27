<?php
namespace App\Http\Controllers\CSV;

class EmployeeStorage
{
     public static function getStack(): array
     {
         return [
             [
                 "name" => "Alex",
                 "email" => "alice@gmail.com",
                 "phone" => "1234567890",
                 "salary" => "20000",
                 "department" => "Accounting"
             ],
             [
                 "name" => "Andrew",
                 "email" => "andrew@gmail.com",
                 "phone" => "1234567891",
                 "salary" => "21000",
                 "department" => "Marketing"
             ],
             [
                 "name" => "Mike",
                 "email" => "mike@gmail.com",
                 "phone" => "1234567892",
                 "salary" => "22000",
                 "department" => "Quality"
             ],
             [
                 "name" => "Sophie",
                 "email" => "sophie@gmail.com",
                 "phone" => "1234567893",
                 "salary" => "21000",
                 "department" => "Accounting"
             ],
             [
                 "name" => "Steve",
                 "email" => "steve@gmail.com",
                 "phone" => "1234567894",
                 "salary" => "22000",
                 "department" => "Marketing"
             ],
         ];
     }
}
