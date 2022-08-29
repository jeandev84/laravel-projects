### Search Autocomplete

- https://cdnjs.com/libraries/bootstrap-3-typeahead
```php 

$ php artisan make:controller Search/ProductController


<?php
namespace App\Http\Controllers\Search;

class ProductStorage
{

     public static function getStack()
     {
          return [
             ["name" => "Phone"],
             ["name" => "Tablet"],
             ["name" => "Laptop"],
             ["name" => "Watch"],
             ["name" => "Television"],
             ["name" => "Freeze"],
          ];
     }
}


<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
       public function addProducts()
       {
           $products = ProductStorage::getStack();

           Product::insert($products);

           return "Product has been inserted successfully!";
       }



       public function search()
       {
            return view('search.products.list');
       }



       public function autocomplete(Request $request)
       {
             $products = Product::select("name")
                                 ->where("name", "LIKE", "%{$request->terms}%")
                                 ->get();

             return response()->json($products);
       }
}



# Search Autocomplete
Route::get('/add-products', [\App\Http\Controllers\Search\ProductController::class, 'addProducts'])
   ->name('add.products');

Route::get('/search', [\App\Http\Controllers\Search\ProductController::class, 'search'])
    ->name('search');


Route::get('/autocomplete', [\App\Http\Controllers\Search\ProductController::class, 'autocomplete'])
    ->name('autocomplete');
    

$ php artisan make:model Product -mf


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $table = "products";
    
}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

$ php artisan migrate



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Product</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>

<section style="padding-top: 60px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Search Products
                    </div>
                    <div class="card-body" style="padding-top: 30px; padding-bottom: 40px;padding-left: 20px;padding-right: 20px;">

                        <form action="">
                           <div class="form-group">
                               <input type="text" class="form-control typeahead" placeholder="Search..."/>
                           </div>
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

<!-- Search -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    var path = "{{ route('autocomplete') }}";

    $('input.typeahead').typeahead({
        source: function (terms, process) {
             return $.get(path, {terms: terms}, function (data) {
                  return process(data);
             })
        }
    });

</script>

</body>
</html>


```
