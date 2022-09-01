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
class CategoryComponent extends Component
{

    public $sorting;
    public $pagesize;
    public $category_slug;


    public function mount($category_slug)
    {
        $this->sorting  = "default";
        $this->pagesize = 12;
        $this->category_slug = $category_slug;
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
        $category     = Category::where('slug', $this->category_slug)->first();
        $category_name = '';

        $products = [];

        if ($category) {
            $products = ProductManager::getProductsByCategory($this->getFilterProductsCredentials($category));
            $category_name = $category->name;
        }

        $categories = Category::all();

        return view('livewire.category-component', [
            'products'      => $products,
            'categories'    => $categories,
            'category_name' => $category_name
        ])->layout('layouts.base');
    }



    /**
     * @param Category $category
     * @return array
    */
    protected function getFilterProductsCredentials(Category $category): array
    {
        return [
            'category' => $category,
            'sorting'  => $this->sorting,
            'pageSize' => $this->pagesize
        ];
    }
}
