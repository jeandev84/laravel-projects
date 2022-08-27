### Import CSV


```php 
$ composer require maatwebsite/excel:^3.0

In Laravel 8

// 1. Install "maatwebsite/excel": "3.0" with php 7.2 
// 2. Install other dependencies of Laravel 

1. sudo update-alternatives --set php /usr/bin/php8.1
2. composer install --ignore-platform-reqs

./config/app.php 

... 

'providers' => [
   /*
    * Package Service Providers...
   */
   ... 
   \Maatwebsite\Excel\ExcelServiceProvider::class,
   ...
];


'aliases' => [
  ... 
  'Excel' => \Maatwebsite\Excel\Facades\Excel::class,
  ...
]


$ php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider" --tag=config

$ php artisan migrate


Import Records from table "employees" model Employee 

php artisan make:import EmployeeImport --model=Employee

<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class EmployeeImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Employee([
            'name'   => $row['name'],
            'email'  => $row['email'],
            'phone'  => $row['phone'],
            'salary' => $row['salary'],
            'department' => $row['department'],
        ]);
    }
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;


    protected $table = 'employees';


    // ADD FILLABLE FOR IMPORT DATA
    protected $fillable = ['name', 'email', 'phone', 'salary', 'department'];
    

    public static function getEmployee()
    {
        return DB::table('employees')
                ->select('id', 'name', 'email', 'phone', 'salary', 'department')
                ->get()
                ->toArray();
    }
}


==================================================================

<?php

namespace App\Http\Controllers\CSV;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;


class EmployeeController extends Controller
{

       .....
       
       
       public function importForm()
       {
           return view('csv.import-form');
       }



       public function importCSV(Request $request): string
       {
            Excel::import(new EmployeeImport(), $request->file);

            return "Record are imported successfully!";
       }
}

======================================================


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Import CSV || Excel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<section style="padding-top: 60px;">
    <div class="container">
         <div class="row">
             <div class="col-md-6 offset-md-3">
                 <div class="card">
                     <div class="card-header">
                         Import CSV or Excel File
                     </div>
                     <div class="card-body">
                         <form action="{{ route('import.csv') }}" method="POST" enctype="multipart/form-data">

                              @csrf

                              <div class="form-group">
                                  <label for="file">Choose CSV</label>
                                  <input type="file" name="file" class="form-control">
                              </div>

                              <button type="submit" class="btn btn-primary">Submit</button>

                         </form>
                     </div>
                 </div>
             </div>
         </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>


===============================================================

# Import CSV
Route::get('/import-form', [\App\Http\Controllers\CSV\EmployeeController::class, 'importForm'])
    ->name('import.form');


Route::post('/import-csv', [\App\Http\Controllers\CSV\EmployeeController::class, 'importCSV'])
    ->name('import.csv');

```
