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
