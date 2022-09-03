<?php

namespace App\Http\Livewire;

use App\Models\Sale;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use App\Models\Product;


class DetailsComponent extends Component
{

    public $slug;


    public function mount($slug)
    {
        $this->slug = $slug;
    }


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

    public function render()
    {
        $product          = Product::where('slug', $this->slug)->first();

        $popular_products = Product::inRandomOrder()
                                    ->limit(Product::POPULAR_LIMIT)
                                    ->get();

        $related_products = Product::where('category_id', $product->category_id)
                                   ->inRandomOrder()
                                   ->limit(Product::RELATED_LIMIT)
                                   ->get();

        $sale = Sale::find(1);

        return view('livewire.details-component', [
            'product'          => $product,
            'popular_products' => $popular_products,
            'related_products' => $related_products,
            'sale'             => $sale
        ])->layout('layouts.base');
    }
}
