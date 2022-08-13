<?php
namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * HomeController
*/
class HomeController extends Controller
{

       /**
        * Route '/'
       */
       public function index()
       {
           // Получить все продукты
           $products = Product::all();

           return view('home.index');
       }



       protected function indexDemo()
       {
           // Получить все продукты
           $products = Product::all(); // dd($products) Eloquent collection

           foreach ($products as $product) {
               echo 'Title: '. $product->title;
               echo '<br>';
               echo 'Price: '. $product->price;
               echo '<br>';
               echo '-------------------------';
               echo '<br> ';
           }


           // Получить первый продукт где id = 5
           $product5 = Product::where('id', 5)->first();
           dd($product5);


           // return view('home.index');
       }
}
