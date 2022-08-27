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
