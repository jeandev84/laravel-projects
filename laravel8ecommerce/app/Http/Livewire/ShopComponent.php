<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;


/**
 *
*/
class ShopComponent extends Component
{


    /**
     * Add To Cart
     * @param $product_id
     * @param $product_name
     * @param $product_price
     * @return \Illuminate\Http\RedirectResponse
    */
    public function addToCart($product_id, $product_name, $product_price)
    {
         Cart::add($product_id, $product_name, 1, $product_price)->associate(Product::class);

         session()->flash('success_message', 'Item added in Cart');

         return redirect()->route('product.cart');
    }


    /*
    Refactoring method addToCart()
    public function addToCart(Product $product)
    {
        Cart::add($product->id, $product->name, 1, $product->price)->associate(Product::class);

        session()->flash('success_message', 'Item added in Cart');

        return redirect()->route('product.cart');
    }
    */

    use WithPagination;
    public function render()
    {
        $products = Product::paginate(Product::PerPage);

        return view('livewire.shop-component', [
            'products' => $products
        ])->layout('layouts.base');
    }
}
