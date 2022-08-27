### Yajra DataTables 

- https://cdn.datatables.net/
- 
```php 
$ composer require yajra/laravel-datatables:^2.1
$ composer update --ignore-platform-reqs


./confi/app.php

'providers' => [
   ...
   \Yajra\DataTables\DataTablesServiceProvider::class,
   
],

'aliases' => [
  
   ... 
   'DataTables' => \Yajra\DataTables\Facades\DataTables::class,
   
]


$ php artisan vendor:publish --provider="Yajra\DataTables\DataTablesServiceProvider"

$ php artisan make:controller DataTables/EmployeeController

$ php artisan make:model Employee -mf


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;


    protected $table = 'employees';


    protected $fillable = ['name', 'email', 'phone', 'salary', 'department'];

   
}


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
            $table->decimal('salary');
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


$ php artisan migrate || php artisan migrate:refresh

$ php artisan make:factory EmployeeFactory --model=Employee

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
    */
    public function definition()
    {
        return [
            'name'   => $this->faker->name,
            'email'  => $this->faker->email,
            'phone'  => $this->faker->phoneNumber,
            'salary' => $this->faker->numberBetween(30000, 50000),
            'department' => $this->faker->randomElement(['Accounting', 'Marketing', 'Sales', 'Quality']),
        ];
    }
}

$ php artisan tinker
Psy Shell v0.11.8 (PHP 8.1.7 — cli) by Justin Hileman
>>> App\Models\Employee::factory()->count(100)->create();


This command will be create file "EmployeeDataTable.php" inside ./app/DataTables
./app/DataTables/EmployeeDataTable.php

$ php artisan datatables:make Employee


<?php

namespace App\DataTables;

use App\Models\Employee;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EmployeeDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'employee.action');
    }



    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Employee $model
     * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query(Employee $model)
    {
        return $model->newQuery();
    }



    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        /*
        return $this->builder()
                    ->setTableId('employee-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
        */


        return $this->builder()
            ->setTableId('employee-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        /*
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
        */


        return ['id', 'name', 'email', 'phone', 'salary', 'department'];
    }



    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Employee_' . date('YmdHis');
    }
}



<?php
namespace App\Http\Controllers\DataTables;

use App\DataTables\EmployeeDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


/**
 *
*/
class EmployeeController extends Controller
{
      public function index(EmployeeDataTable $dataTable)
      {
           return $dataTable->render('datatables.employees.list');
      }
}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>


  <section style="padding-top: 60px;">
       <div class="container">
           <div class="row">
               <div class="col-md-12">
                    {!! $dataTable->table() !!}
               </div>
           </div>
       </div>
  </section>

  {!! $dataTable->scripts() !!}


</body>
</html>


```
