### Blade 

```php 
# Blade
Route::get('/blade', function () {
     return view('blade.index');
})->name('blade.index');


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blade Template</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

   <section>
      <div class="container">
          @include('blade.header')
      </div>
   </section>
   <section class="pt-5">
       <div class="container">

           <div class="body">

               <h1>Blade Template</h1>

               @php
                   $name   = 'Jennifer';
                   $fruits = ['Mango', 'Apple', 'Banana', 'Pineapple'];
                   $age    =  18;
               @endphp

               <h2>Hi! {{ $name }}</h2>

               <h2>Fruits</h2>

               <ul>
                   @foreach($fruits as $fruit)
                       <li>{{ $fruit }}</li>
                   @endforeach
               </ul>

               <div class="form-group">
                   <select name="year" class="form-control">
                       <option value="0">Выбрать</option>
                       @for($i = 1970; $i <= 2050; $i++)
                           <option value="{{ $i }}">{{ $i }}</option>
                       @endfor
                   </select>
               </div>

               <div>
                   @if(count($fruits) === 1)
                       Single Fruit
                   @elseif(count($fruits) > 1)
                       More than one Fruit
                   @else
                       No Fruit
                   @endif
               </div>

               <div>
                   {{ $age >= 18 ? 'You are adult' : 'You are not adult' }}
               </div>

           </div>
       </div>
   </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>

```
