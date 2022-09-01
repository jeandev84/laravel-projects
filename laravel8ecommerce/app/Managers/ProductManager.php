<?php
namespace App\Managers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductManager
{

    /**
     * @param $sorting
     * @param $pageSize
     * @return LengthAwarePaginator
    */
    public static function sortingWithPagination($sorting, $pageSize): LengthAwarePaginator
    {
        switch ($sorting) {
            case 'date':
                return Product::orderBy('created_at', 'DESC')->paginate($pageSize);
                break;
            case 'price':
                return Product::orderBy('regular_price', 'ASC')->paginate($pageSize);
                break;
            case 'price-desc':
                return Product::orderBy('regular_price', 'DESC')->paginate($pageSize);
                break;
            default:
                return Product::paginate($pageSize);
        }
    }



    /**
     * @param Category $category
     * @param $sorting
     * @param $pageSize
     * @return LengthAwarePaginator
    */
    public static function getProductsByCategory(Category $category, $sorting, $pageSize): LengthAwarePaginator
    {
        switch ($sorting) {
            case 'date':
                return Product::where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate($pageSize);
                break;
            case 'price':
                return Product::where('category_id', $category->id)->orderBy('regular_price', 'ASC')->paginate($pageSize);
                break;
            case 'price-desc':
                return Product::where('category_id', $category->id)->orderBy('regular_price', 'DESC')->paginate($pageSize);
                break;
            default:
                return Product::where('category_id', $category->id)->paginate($pageSize);
        }
    }
}
