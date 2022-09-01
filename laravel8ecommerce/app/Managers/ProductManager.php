<?php
namespace App\Managers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductManager
{

    /**
     * @param array $credentials
     * @return LengthAwarePaginator
     */
    public static function sortingWithPagination(array $credentials): LengthAwarePaginator
    {
        $sorting  = $credentials['sorting'];
        $pageSize = $credentials['pageSize'];

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
     * @param array $credentials
     * @return mixed
     */
    public static function searchProducts(array $credentials)
    {
        $sorting     = $credentials['sorting'];
        $pageSize    = $credentials['pageSize'];
        $search      = $credentials['search'];
        $category_id = $credentials['category_id'];

        switch ($sorting) {
            case 'date':
                return Product::where('name', 'like', '%'. $search . '%')
                               ->where('category_id', 'like', '%'. $category_id . '%')
                               ->orderBy('created_at', 'DESC')
                               ->paginate($pageSize);
                break;
            case 'price':
                return Product::where('name', 'like', '%'. $search . '%')
                               ->where('category_id', 'like', '%'. $category_id . '%')
                               ->orderBy('regular_price', 'ASC')
                               ->paginate($pageSize);
                break;
            case 'price-desc':
                return Product::where('name', 'like', '%'. $search . '%')
                               ->where('category_id', 'like', '%'. $category_id . '%')
                               ->orderBy('regular_price', 'DESC')
                               ->paginate($pageSize);
                break;
            default:
                return Product::where('name', 'like', '%'. $search . '%')
                               ->where('category_id', 'like', '%'. $category_id . '%')
                               ->paginate($pageSize);
        }
    }




    /**
     * @param array $credentials
     * @return LengthAwarePaginator
    */
    public static function getProductsByCategory(array $credentials): LengthAwarePaginator
    {
        /** @var Category $category */
        $category = $credentials['category'];

        $sorting  = $credentials['sorting'];
        $pageSize = $credentials['pageSize'];

        if ($category instanceof Category) {
            switch ($sorting) {
                case 'date':
                    return Product::where('category_id', $category->id)
                                   ->orderBy('created_at', 'DESC')
                                   ->paginate($pageSize);
                    break;
                case 'price':
                    return Product::where('category_id', $category->id)
                                    ->orderBy('regular_price', 'ASC')
                                    ->paginate($pageSize);
                    break;
                case 'price-desc':
                    return Product::where('category_id', $category->id)
                                   ->orderBy('regular_price', 'DESC')
                                   ->paginate($pageSize);
                    break;
                default:
                    return Product::where('category_id', $category->id)->paginate($pageSize);
            }
        }
    }

}
