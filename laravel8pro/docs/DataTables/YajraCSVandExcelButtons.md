### Yajra CSV and Excel Buttons


- https://cdn.datatables.net
- https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css
- https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js
- https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js
```php 

$ composer require yajra/laravel-datatables-buttons
$ composer update --ignore-platform-reqs


./confi/app.php

'providers' => [
   ...
   \Yajra\DataTables\ButtonsServiceProvider::class,
   
],

'aliases' => [
  
   ... 
   
]


$ php artisan vendor:publish --provider="Yajra\DataTables\ButtonsServiceProvider"



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
   
   ....
   
    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {

        return $this->builder()
            ->setTableId('employee-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('excel'),
                Button::make('csv')
            );
    }


    ....
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap4.min.css">

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap4.min.js"></script>
    <script src="/vendor/datatables/buttons.server-side.js"></script>
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
