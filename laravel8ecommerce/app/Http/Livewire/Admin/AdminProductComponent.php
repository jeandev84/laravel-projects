<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductComponent extends Component
{
    use WithPagination;
    public function render()
    {
        /*
          ini_set('max_execution_time', 300);
          set_time_limit(0);
        */

        $products = Product::paginate(Product::AdminPerPage);

        return view('livewire.admin.admin-product-component', [
            'products' => $products
        ])->layout('layouts.base');
    }
}
