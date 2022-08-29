### Export PDF

1. Installation package for working with PDF 
```php
$ composer require barryvdh/laravel-dompdf

./config/app.php 

... 

'providers' => [
   ... 
   \Barryvdh\DomPDF\ServiceProvider::class,
   ...
],
'aliases' => [
   'PDF' => \Barryvdh\DomPDF\Facade\Pdf::class,
];


$ php artisan vendor:publish --provider="Barryvdh\DomPDF\ServiceProvider"
$ php artisan make:controller PDF/EmpController 


<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class EmpController extends Controller
{
      public function getAllEmployees()
      {
           $employees = Employee::all();

           return view('pdf.export.employees', compact('employees'));
      }


      public function downloadPDF(): \Illuminate\Http\Response
      {
          $employees = Employee::all();

          $pdf = PDF::loadView('pdf.export.employees', compact('employees'));

          return $pdf->download('employees.pdf');
      }
}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees PDF</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        #emp {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #emp td, #emp th {
            border: 1px solid #dddd;
            padding: 8px;
        }

        #emp tr:nth-child(even) {
            background-color: #0bfdfd;
        }

        #emp th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4caf50;
            color: #fff;
        }
    </style>
</head>
<body>

   <section style="padding-top: 60px;">
       <div class="container">
           <table id="emp" class="table table-striped">
               <thead>
               <tr>
                   <th>ID</th>
                   <th>Name</th>
                   <th>Email</th>
                   <th>Phone</th>
                   <th>Salary</th>
                   <th>Department</th>
               </tr>
               </thead>
               <tbody>
               @foreach($employees as $employee)
                   <tr>
                       <td>{{ $employee->id }}</td>
                       <td>{{ $employee->name }}</td>
                       <td>{{ $employee->email }}</td>
                       <td>{{ $employee->phone }}</td>
                       <td>{{ $employee->salary }}</td>
                       <td>{{ $employee->department }}</td>
                   </tr>
               @endforeach
               </tbody>
           </table>
       </div>
   </section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>


# Export PDF
Route::get('/get-all-employees', [\App\Http\Controllers\PDF\EmpController::class, 'getAllEmployees'])
    ->name('get.all.employees');


Route::get('/download-pdf-employees', [\App\Http\Controllers\PDF\EmpController::class, 'downloadPDF'])
    ->name('download.pdf.employees');

```
