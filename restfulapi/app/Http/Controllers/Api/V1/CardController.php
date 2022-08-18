<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardStoreRequest;
use App\Http\Resources\CardResource;
use App\Models\Card;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CardStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CardStoreRequest $request)
    {
         $new_desk = Card::create($request->validated());

         return new CardResource($new_desk);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
