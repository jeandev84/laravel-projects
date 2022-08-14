<?php
namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;


/**
 * ProductController
*/
class ProductController extends Controller
{

       /**
        * @param $category  // ИД Категория
        * @param $product_id        // ИД продукта
        * @return Application|Factory|View
      */
      public function show($category, $product_id)
      {
          // Получаем первую запись по заданному идентификатору
          $product = Product::where('id', $product_id)->first();

          return view('product.show', [
              'product' => $product
          ]);
      }



      public function showCategory(Request $request, $category_alias)
      {
          // Получаем категорию по alias
          $category = Category::where('alias', $category_alias)->first();


          // Выбираем все продукты, где категория равняется id данной категории
          // $products = Product::where('category_id', $category->id)->get();


          $paginate = 2;


          // Выбираем все продукты, где категория равняется id данной категории с пагинацией
          // Pagination
          $products = Product::where('category_id', $category->id)->paginate($paginate);


          // Если у нас есть сортировка
          if (isset($request->orderBy)) {

               // сортировка с низкого цены до высокого
               if ($request->orderBy === 'price-low-high') {
                   $products = Product::where('category_id', $category->id)
                               ->orderBy('price')
                               ->paginate($paginate);
               }


               // сортировка с высокой цены до низкого
               if ($request->orderBy === 'price-high-low') {
                  $products = Product::where('category_id', $category->id)
                              ->orderBy('price', 'desc')
                              ->paginate($paginate);
               }


               // сортировка по алфавита (a-z)
               if ($request->orderBy === 'name-a-z') {
                  $products = Product::where('category_id', $category->id)
                      ->orderBy('title')
                      ->paginate($paginate);
               }


              // сортировка по алфавита (z-a)
              if ($request->orderBy === 'name-z-a') {
                  $products = Product::where('category_id', $category->id)
                      ->orderBy('title', 'desc')
                      ->get();
              }
          }


          // Если запрос отправлен ajax запрос, мы возвращаем ajax/order-by.blade.php
          if ($request->ajax()) {

              /* return $request->orderBy; */
              return view('ajax.order-by', [
                  'products' => $products
              ])->render();

          }


          return view('categories.index', [
              'category' => $category,
              'products' => $products
          ]);
      }
}
