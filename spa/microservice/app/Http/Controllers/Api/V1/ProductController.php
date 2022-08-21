<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
         // return Product::orderBy('id', 'desc')->get();

         return Product::orderBy('id', 'desc')->paginate(5);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
    */
    public function store(ProductStoreRequest $request)
    {
         /*
            $request->validate([
             'name'  => 'required|string',
             'price' => 'required|numeric'
            ], [
               'name.required'   => 'Поле обязательное.',
               'name.string'     => 'Содержимое данного поля должно быть строковое значение.',
               'price.required'  => 'Поле обязательное.',
               'price.numeric'   => 'Содержимое данного поля должно быть целое число.',
           ]);
          */

         return Product::create($request->only('name', 'price'));
    }



    /**
     * Display the specified resource.
     *
     * @param  Post $product
     * @return \Illuminate\Http\Response
    */
    public function show(Post $product)
    {
         return $product;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        /*
        $request->validate([
            'name'  => 'nullable|string',
            'price' => 'nullable|numeric'
        ],
        [
            'name.required'   => 'Поле обязательное.',
            'name.string'     => 'Содержимое данного поля должно быть строковое значение.',
            'price.required'  => 'Поле обязательное.',
            'price.numeric'   => 'Содержимое данного поля должно быть целое число.',
        ]);
        */

        $product->update($request->only('name', 'price'));

        return $product;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $product;
    }
}
