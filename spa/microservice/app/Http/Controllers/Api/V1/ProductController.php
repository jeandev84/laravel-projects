<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
         return Product::all();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
         $request->validate([
             'name'  => 'required|string',
             'price' => 'required|numeric'
         ], [
             'name.required'   => 'Поле обязательное.',
             'name.string'     => 'Содержимое данного поля должно быть строковое значение.',
             'price.required'  => 'Поле обязательное.',
             'price.numeric'   => 'Содержимое данного поля должно быть целое число.',
         ]);

         $product = Product::create($request->only('name', 'price'));

         return $product;
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
         $product =  Product::find($id);

         return $product;
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
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

        $product = Product::find($id);
         $product->update($request->only('name', 'price'));
         return $product;
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $product;
    }
}
