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


          // Выбираем все продукты где категория равняется id данной категории
          $products = Product::where('category_id', $category->id)->get();


          // если запрос отправлен ajax запрос
          // мы возвращаем
          if ($request->ajax()) {
              return $request->orderBy;
          }


          return view('categories.index', [
              'category' => $category,
              'products' => $products
          ]);
      }
}
