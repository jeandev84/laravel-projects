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
       public function addEmployee()
       {
           $employees = EmployeeStorage::getStack();

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
