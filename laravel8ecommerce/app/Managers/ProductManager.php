<?php
namespace App\Managers;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductManager
{

    /**
     * @param $filterName
     * @param $pageSize
     * @return LengthAwarePaginator
    */
    public static function sortingWithPagination($filterName, $pageSize): LengthAwarePaginator
    {
        switch ($filterName) {
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
}
