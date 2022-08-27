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
                             Students <a href="#" class="btn btn-success" data-toggle="modal" data-target="#studentModal">Add New Student</a>
                       </div>
                       <div class="card-body">
                           <table id="studentTable" class="table">
                               <thead>
                                   <tr>
                                       <th>First Name</th>
                                       <th>Last Name</th>
                                       <th>Email</th>
                                       <th>Phone</th>
                                       <th>Actions</th>
                                   </tr>
                               </thead>
                               <tbody>
                                 @foreach($students as $student)
                                    <tr>
                                      <td>{{ $student->firstname }}</td>
                                      <td>{{ $student->lastname }}</td>
                                      <td>{{ $student->email }}</td>
                                      <td>{{ $student->phone }}</td>
                                      <td></td>
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

<!-- Modal -->
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

</body>
</html>
