<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;


class ShopComponent extends Component
{

    use WithPagination;
    public function render()
    {
        $products = Product::paginate(Product::PerPage);

        return view('livewire.shop-component', [
            'products' => $products
        ])->layout('layouts.base');
    }
}
