<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .parsley-errors-list li {
            list-style: none;
            color: red;
        }
    </style>
</head>
<body>

<section style="padding-top: 60px;">
    <div class="container">
        <div class="row">
             <div class="col-md-6 offset-md-3">
                 <div class="card">
                     <div class="card-header">
                          Register
                     </div>
                     <div class="card-body">
                         <form id="registerForm" method="POST" action="{{ route('auth.register.submit') }}">

                             @csrf

                             <div class="form-group">
                                 <label for="name">Name</label>
                                 <input type="text" name="name" id="name" class="form-control" data-parsley-pattern="[a-zA-Z ]+$" data-parsely-trigger="keyup" required>
                             </div>

                             <div class="form-group">
                                 <label for="email">Email</label>
                                 <input type="email" name="email" id="email" class="form-control" data-parsley-type="email" data-parsely-trigger="keyup" required>
                             </div>

                             <div class="form-group">
                                 <label for="password">Password</label>
                                 <input type="password" name="password" id="password" class="form-control" data-parsley-length="[6,12]"  data-parsely-trigger="keyup" required>
                             </div>

                             <div class="form-group">
                                 <label for="confirm_password">Confirm Password</label>
                                 <input type="password" name="confirm_password" id="confirm_password" class="form-control" data-parsley-equalto="#password"  data-parsely-trigger="keyup" required>
                             </div>

                             <div class="form-group">
                                 <label for="phone">Phone</label>
                                 <input type="text" name="phone" id="phone" class="form-control" data-parsley-pattern="[0-9]+$" data-parsley-length="[10,13]" data-parsely-trigger="keyup" required>
                             </div>

                             <button type="submit" class="btn btn-primary">Submit</button>

                         </form>
                     </div>
                 </div>
             </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    $("#registerForm").parsley();
</script>
</body>
</html>
