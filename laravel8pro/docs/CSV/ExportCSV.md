### Export CSV and Excel data 


1. Create Model and Controller
```php 
$ php artisan make:model Employee -m


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('salary');
            $table->string('department');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}

     
     
$ php artisan migrate

```


2. Install Package for working with CSV or Excel

- https://laravel-excel.com/
- https://docs.laravel-excel.com/3.1/getting-started/installation.html
- https://techvblogs.com/blog/laravel-import-export-excel-csv-file
- https://docs.laravel-excel.com/3.1/getting-started/installation.html
- https://heavykenny.medium.com/laravel-maatwebsite-excel-ec619adcc24c
- Upload File : https://techvblogs.com/blog/upload-files-images-laravel

```php
$ composer require maatwebsite/excel:^3.0
$ composer require maatwebsite/excel:*

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


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;


    protected $table = 'employees';


    public static function getEmployee()
    {
        return DB::table('employees')
                ->select('id', 'name', 'email', 'phone', 'salary', 'department')
                ->get()
                ->toArray();
    }
}


$ php artisan make:export EmployeeExport --model=App\Models\Employee


<?php
namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;



class EmployeeExport implements FromCollection, WithHeadings
{


       public function headings(): array
       {
             return [
                 'ID',
                 'Name',
                 'Email',
                 'Phone',
                 'Salary',
                 'Department'
             ];
       }


       /**
        * @return \Illuminate\Support\Collection
       */
       public function collection()
       {

            // return Employee::all();
            return collect(Employee::getEmployee());
       }
}



<?php

namespace App\Http\Controllers\CSV;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use Excel;



class EmployeeController extends Controller
{
       public function addEmployee()
       {
           $employees = [
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


           Employee::insert($employees);

           return "Records are inserted";
       }



       public function exportIntoExcel()
       {
            return Excel::download(new EmployeeExport(), 'employeelist.xlsx');
       }



       public function exportIntoCSV()
       {
           return Excel::download(new EmployeeExport(), 'employeelist.csv');
       }
}


# Export CSV Data
Route::get('/add-employees', [\App\Http\Controllers\CSV\EmployeeController::class, 'addEmployee'])
    ->name('add.employees');


Route::get('/export-excel', [\App\Http\Controllers\CSV\EmployeeController::class, 'exportIntoExcel'])
    ->name('export.excel');


Route::get('/export-csv', [\App\Http\Controllers\CSV\EmployeeController::class, 'exportIntoCSV'])
    ->name('export.csv');

```
