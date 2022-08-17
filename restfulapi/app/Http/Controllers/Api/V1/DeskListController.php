<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeskListStoreRequest;
use App\Http\Requests\DeskListUpdateRequest;
use App\Http\Resources\DeskListResource;
use App\Models\DeskList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class DeskListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'desk_id' => 'required|integer|exists:desks,id'
        ]);

        return DeskListResource::collection(
            DeskList::orderBy('created_at', 'desc')
                      ->where('desk_id', $request->desk_id)
                      ->get()
        );
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeskListStoreRequest $request)
    {
        $created_desk_list = DeskList::create($request->validated());

        return new DeskListResource($created_desk_list);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DeskList $deskList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param DeskListUpdateRequest $request
     * @param DeskList $deskList
     * @return \Illuminate\Http\Response
     */
    public function update(DeskListUpdateRequest $request, DeskList $deskList)
    {
        $deskList->update($request->validated());

        return new DeskListResource($deskList);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param DeskList $deskList
     * @return Response
     */
    public function destroy(DeskList $deskList)
    {
        $deskList->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
