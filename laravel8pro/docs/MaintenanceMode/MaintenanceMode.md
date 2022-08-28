### Maintenance Mode 


```php 

1. This command redirect site to page 503 (Service Unavailable)
$ php artisan down


2. Customize page 503, You must to create a  views file 503.blade.php
./resources/views/errors/503.blade.php



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Unavailable</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        h1 {
            font-size: 3em;
        }

        p {
            font-size: 18px;
        }
    </style>
</head>
<body>

  <section>
      <div class="container text-center" style="margin-top: 100px;">
          <img src="{{ asset('assets/icons/maintenance-icon.png') }}" alt="Maintenance Icon">
          <h1 class="text-center">Site Under Maintenance</h1>
          <p class="text-center">
              We are currently under maintenance.
              We will be back shortly.
              Thank you for your patience
          </p>
      </div>
  </section>

</body>
</html>


3. (Active Maintenance  mode)
$ php artisan down --secret="abcde12345" 

4. (Disabled Maintenance mode)

Browse this link http://mydomain/abcde12345
           OR 
$ php artisan up

```
