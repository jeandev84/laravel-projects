<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;


class DetailsComponent extends Component
{

    public $slug;


    public function mount($slug)
    {
        $this->slug = $slug;
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

        return view('livewire.details-component', [
            'product'          => $product,
            'popular_products' => $popular_products,
            'related_products' => $related_products
        ])->layout('layouts.base');
    }
}
