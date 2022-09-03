<?php
namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\HomeCategory;
use App\Models\HomeSlider;
use Livewire\Component;
use App\Models\Product;


class HomeComponent extends Component
{
    public function render()
    {
        $sliders        = HomeSlider::where('status', 1)->get();
        $latestProducts = Product::orderBy('created_at', 'DESC')
                                   ->get()
                                   ->take(8);


        $categories = [];
        $number_of_products = 0;

        if($category = HomeCategory::find(1)) {
            $catIds        = explode(',', $category->selected_categories);
            $categories    = Category::whereIn('id', $catIds)->get();
            $number_of_products = $category->number_of_products;
        }

        $sale_products = Product::where('sale_price', '>', 0)
                                ->inRandomOrder()
                                ->get()
                                ->take(8);

        return view('livewire.home-component', [
            'sliders'            => $sliders,
            'latestProducts'     => $latestProducts,
            'categories'         => $categories,
            'number_of_products' => $number_of_products,
            'sale_products'       => $sale_products
        ])->layout('layouts.base');
    }
}
