<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;


class AdminCategoryComponent extends Component
{
    public function render()
    {
        $categories = Category::paginate(Category::PerPage);
        return view('livewire.admin.admin-category-component', [
            'categories' => $categories
        ])->layout('layouts.base');
    }
}
