<?php

namespace App\Http\Livewire;

use App\Managers\ProductManager;
use App\Models\Category;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;



class SearchComponent extends Component
{

    public $sorting;
    public $pagesize;


    public $search;
    public $product_cat;
    public $product_cat_id;



    public function mount()
    {
        $this->sorting  = "default";
        $this->pagesize = 12;
        $this->fill(request()->only('search', 'product_cat', 'product_cat_id'));
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



    use WithPagination;
    public function render()
    {
        $products = ProductManager::searchProducts($this->getSearchCredentials());

        $categories = Category::all();

        return view('livewire.search-component', [
            'products'   => $products,
            'categories' => $categories
        ])->layout('layouts.base');
    }



    /**
     * @return array
    */
    protected function getSearchCredentials(): array
    {
         return [
             'sorting'     => $this->sorting,
             'pageSize'    => $this->pagesize,
             'search'      => $this->search,
             'category_id' => $this->product_cat_id
         ];
    }

}
