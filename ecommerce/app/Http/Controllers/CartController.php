<?php
namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;


/**
 * CartController
*/
class CartController extends Controller
{
      public function index()
      {
          return view('cart.index');
      }


      public function addToCart(Request $request)
      {

          // Find current product
          $product = Product::where('id', $request->id)->first();


          // Create cart id
          if (! isset($_COOKIE['cart_id'])) {
              setcookie('cart_id', uniqid());
          }

          $cartId = $_COOKIE['cart_id'];

          // Set cart session_id
          \Cart::session($cartId);


          // add product references
          \Cart::add([
              'id' => $product->id,
              'name' => $product->title,
              'price' => $product->new_price ?? $product->price,
              'quantity' => (int) $request->qty,
              'attributes' => [
                  'img' => $product->images[0]->img ?? 'no_image.png'
              ]
          ]);


          return response()->json(\Cart::getContent());

          /* return response()->json(['id' => $request->id]); */
      }
}
