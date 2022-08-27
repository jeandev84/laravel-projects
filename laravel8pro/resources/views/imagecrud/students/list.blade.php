<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

    <section style="padding-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Students <a href="{{ route('student.add') }}" class="btn btn-success">Add New</a>
                        </div>
                        <div class="card-body">
                            @if(Session::has('student_deleted'))
                                <div class="alert alert-success" role="alert">
                                    {{ Session::get('student_deleted') }}
                                </div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                   <tr>
                                       <th>ID</th>
                                       <th>Name</th>
                                       <th>Profile Image</th>
                                       <th>Actions</th>
                                   </tr>
                                </thead>
                                <tbody>
                                   @foreach($students as $student)
                                       <tr>
                                           <td>{{ $student->id }}</td>
                                           <td>{{ $student->name }}</td>
                                           <td>
                                               <img src="{{ asset('images/students/'. $student->profile_image) }}" alt="Profile Image" style="max-width: 60px;">
                                           </td>
                                           <td>
                                               <a href="{{ route('student.edit', ['id' => $student->id]) }}" class="btn btn-info">Edit</a>
                                               <a href="{{ route('student.delete', ['id' => $student->id]) }}" class="btn btn-danger">Delete</a>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>


    <!-- Custom scripts -->
    <script>

         function previewFile(input) {

             var file = $("input[type=file]").get(0).files[0];

             if(file) {

                 var reader = new FileReader();

                 reader.onload = function () {
                    $('#previewImg').attr("src", reader.result);
                 };

                 reader.readAsDataURL(file);
             }
         }
    </script>
</body>
</html>
