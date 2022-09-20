<?php
namespace App\Http\Livewire;

use App\Managers\ProductManager;
use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;


/**
 *
*/
class ShopComponent extends Component
{

    public $sorting;
    public $pagesize;


    public $min_price;
    public $max_price;


    public function mount()
    {
        $this->sorting  = "default";
        $this->pagesize = 12;

        $this->min_price = 1;
        $this->max_price = 1000;
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
         Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate(Product::class);

         session()->flash('success_message', 'Item added in Cart');

         return redirect()->route('product.cart');
    }


    public function addToWishList($product_id, $product_name, $product_price)
    {
         Cart::instance('wishlist')->add($product_id, $product_name, $product_price)->associate(Product::class);
    }




    /**
     * @param array $product
     * @return void
    */
    public function addToWishListTestFromArrayParameters(array $product)
    {
         Cart::instance('wishlist')->add($product['id'], $product['name'], $product['regular_price'])->associate(Product::class);
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
        /* $products = Product::paginate(Product::PerPage); */

        $products = ProductManager::sortingWithPagination($this->getSortingCredentials());

        $categories = Category::all();

        return view('livewire.shop-component', [
            'products'   => $products,
            'categories' => $categories
        ])->layout('layouts.base');
    }


    /**
     * @return array
    */
    protected function getSortingCredentials(): array
    {
        return [
            'sorting'   => $this->sorting,
            'pageSize'  => $this->pagesize,
            'min_price' => $this->min_price,
            'max_price' => $this->max_price
        ];
    }
}
