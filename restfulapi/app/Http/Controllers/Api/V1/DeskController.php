<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeskStoreRequest;
use App\Http\Resources\DeskResource;
use App\Models\Desk;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
         /* return DeskResource::collection(Desk::with('lists')->get()); */
         return DeskResource::collection(Desk::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param DeskStoreRequest $request
     * @return Response
    */
    public function store(DeskStoreRequest $request)
    {
        $created_desk = Desk::create($request->validated());

        return new DeskResource($created_desk);
    }


    /**
     * Display the specified resource.
     *
     * @param Desk $desk
     * @return Response
     */
    public function show(Desk $desk)
    {
        /* return new DeskResource(Desk::with('lists')->findOrFail($id)); */
        /* return new DeskResource(Desk::findOrFail($id)); */

        return new DeskResource($desk);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param DeskStoreRequest $request
     * @param  int  $id
     * @return Response
     */
    public function update(DeskStoreRequest $request, Desk $desk)
    {
          $desk->update($request->validated());

          return new DeskResource($desk);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  Desk $desk
     * @return Response
     */
    public function destroy(Desk $desk)
    {
         $desk->delete();

         return response(null, Response::HTTP_NO_CONTENT);
    }
}
