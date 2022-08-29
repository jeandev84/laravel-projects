### Delete Multi Record


```php 


<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
     
      ...

      public function deleteCheckedStudents(Request $request)
      {
            $ids = $request->ids;

            Student::whereIn('id', $ids)->delete();

            return response()->json(['success' => "Students have been deleted!"]);
      }
}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajax CRUD</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>

  <section style="padding-top: 60px;">
      <div class="container">
           <div class="row">
               <div class="col-md-12">
                   <div class="card">
                       <div class="card-header">
                           <div class="row">
                               <div class="col-md-8">
                                   <h3>Students</h3>
                               </div>
                               <div class="col-md-2">
                                   <a href="#" class="btn btn-success" data-toggle="modal" data-target="#studentModal">Add New Student</a>
                               </div>
                               <div class="col-md-2">
                                   <a href="#" class="btn btn-danger" id="deleteAllSelectedRecord">Delete Selected</a>
                               </div>
                           </div>

                       </div>
                       <div class="card-body">
                           <table id="studentTable" class="table">
                               <thead>
                                   <tr>
                                       <th>
                                           <input type="checkbox" id="chkCheckAll">
                                       </th>
                                       <th>First Name</th>
                                       <th>Last Name</th>
                                       <th>Email</th>
                                       <th>Phone</th>
                                       <th>Actions</th>
                                   </tr>
                               </thead>
                               <tbody>
                                 @foreach($students as $student)
                                    <tr id="sid{{ $student->id }}"><!-- student ID -->
                                      <td>
                                          <input type="checkbox" name="ids" class="checkBoxClass" value="{{ $student->id }}" style="cursor: pointer;"/>
                                      </td>
                                      <td>{{ $student->firstname }}</td>
                                      <td>{{ $student->lastname }}</td>
                                      <td>{{ $student->email }}</td>
                                      <td>{{ $student->phone }}</td>
                                      <td>
                                          <a href="javascript:void(0)" onclick="editStudent({{ $student->id }})" class="btn btn-info">Edit</a>
                                          <a href="javascript:void(0)" onclick="deleteStudent({{ $student->id }})" class="btn btn-danger">Delete</a>
                                      </td>
                                    </tr>
                                  @endforeach
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
           </div>
      </div>
  </section>


<!-- Button trigger modal -->
{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentModal">--}}
{{--  Launch demo modal--}}
{{--</button>--}}

<!-- Add Student Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add New Student</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <form id="studentForm">

                  @csrf

                  <div class="form-group">
                      <label for="firstname">First Name</label>
                      <input type="text" id="firstname" name="firstname" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="lastname">Last Name</label>
                      <input type="text" id="lastname" name="lastname" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="phone">Phone</label>
                      <input type="text" id="phone" name="phone" class="form-control">
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>

              </form>
          </div>
          <!--
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Add</button>
          </div>
          -->
      </div>
  </div>
</div>


<!-- Edit Student Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

              <form id="studentEditForm">

                  @csrf

                  <input type="hidden" name="id" id="id">

                  <div class="form-group">
                      <label for="firstname2">First Name</label>
                      <input type="text" id="firstname2" name="firstname" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="lastname2">Last Name</label>
                      <input type="text" id="lastname2" name="lastname" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="email2">Email</label>
                      <input type="email" id="email2" name="email" class="form-control">
                  </div>

                  <div class="form-group">
                      <label for="phone2">Phone</label>
                      <input type="text" id="phone2" name="phone" class="form-control">
                  </div>

                  <button type="submit" class="btn btn-primary">Submit</button>

              </form>
          </div>
          <!--
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Add</button>
          </div>
          -->
      </div>
  </div>
</div>

  <!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


<script>

   $("#studentForm").submit(function (e) {

       e.preventDefault();

       let firstname  = $('#firstname').val();
       let lastname   = $('#lastname').val();
       let email      = $('#email').val();
       let phone      = $('#phone').val();
       let _token     = $("input[name=_token]").val();

       $.ajax({
           url: "{{ route('student.add') }}",
           type: "POST",
           data: {
               firstname: firstname,
               lastname: lastname,
               email: email,
               phone: phone,
               _token: _token
           },
           success: function (response) {

               if(response) {

                   let html  = '';
                       html  = '<tr>';
                       html += '<td>'+ response.firstname +'</td>';
                       html += '<td>'+ response.lastname +'</td>';
                       html += '<td>'+ response.email +'</td>';
                       html += '<td>'+ response.phone +'</td>';
                       html += '<tr>';

                   $("#studentTable tbody").prepend(html);
                   $("#studentForm")[0].reset();
                   $("#studentModal").modal('hide');
               }
           }
       });

   });
</script>


  <script>

      // Update Record
      function editStudent(id) {

          $.get('/student/' + id, function (student) {

               $("#id").val(student.id);
               $("#firstname2").val(student.firstname);
               $("#lastname2").val(student.lastname);
               $("#email2").val(student.email);
               $("#phone2").val(student.phone);

               $("#studentEditModal").modal('toggle');
          });
      }

      $("#studentEditForm").submit(function (e) {

           e.preventDefault();

           let id         = $('#id').val();
           let firstname  = $('#firstname2').val();
           let lastname   = $('#lastname2').val();
           let email      = $('#email2').val();
           let phone      = $('#phone2').val();
           let _token     = $("input[name=_token]").val();


           $.ajax({
              url: "{{ route('student.update') }}",
              type: "PUT",
              data: {
                  id: id,
                  firstname: firstname,
                  lastname: lastname,
                  email: email,
                  phone: phone,
                  _token: _token
              },
              success: function (response) {

                  $('#sid' + response.id + ' td:nth-child(1').text(response.firstname);
                  $('#sid' + response.id + ' td:nth-child(2').text(response.lastname);
                  $('#sid' + response.id + ' td:nth-child(3').text(response.email);
                  $('#sid' + response.id + ' td:nth-child(4').text(response.phone);

                  $("#studentEditModal").modal('toggle');
                  $("#studentEditForm")[0].reset();
              }
          });
      });


      // Delete Record

      function deleteStudent(id) {

          if(confirm("Do you really want to delete  this record ?"))
          {
               $.ajax({
                   url: '/student/' + id,
                   type: "DELETE",
                   data: {
                      _token: $("input[name=_token]").val()
                   },
                   success: function (response) {
                        $("#sid"+ id).remove();
                   }
               });
          }
      }
  </script>


  <script>

      // Check all checkbox

      $(function (e) {
          $("#chkCheckAll").click(function () {
              $(".checkBoxClass").prop('checked', $(this).prop('checked'));
          });

          $("#deleteAllSelectedRecord").click(function (e) {

               e.preventDefault();

               let allids = [];

               $("input:checkbox[name=ids]:checked").each(function () {
                    allids.push($(this).val());
               });

               $.ajax({
                   url: "{{ route('students.delete.selected') }}",
                   type: "DELETE",
                   data: {
                       _token: $("input[name=_token]").val(),
                       ids: allids
                   },
                   success: function (response) {
                       $.each(allids, function (key, val) {
                           $("#sid" + val).remove();
                       });
                   }
               });

          });
      });

  </script>
</body>
</html>


Route::delete('/delete-selected-students', [\App\Http\Controllers\Ajax\StudentController::class, 'deleteCheckedStudents'])
    ->name('students.delete.selected');


```
