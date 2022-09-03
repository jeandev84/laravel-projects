<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\HomeCategory;
use Livewire\Component;

class AdminHomeCategoryComponent extends Component
{

    public $selected_categories = [];
    public $number_of_products;


    public function mount()
    {
         if($category = HomeCategory::find(1)) {
             $this->selected_categories = explode(',', $category->selected_categories);
             $this->number_of_products    = $category->number_of_products;
         }
    }



    public function updateHomeCategory()
    {
        if($category = HomeCategory::find(1)) {
            $category->selected_categories = implode(',', $this->selected_categories);
            $category->number_of_products  = $this->number_of_products;
            $category->save();
            session()->flash('message', 'HomeCategory has been updated successfully!');
        }
    }




    public function render()
    {
        $categories = Category::all();

        return view('livewire.admin.admin-home-category-component', [
            'categories' => $categories
        ])->layout('layouts.base');
    }
}
