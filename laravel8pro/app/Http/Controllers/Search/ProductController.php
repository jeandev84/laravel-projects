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
