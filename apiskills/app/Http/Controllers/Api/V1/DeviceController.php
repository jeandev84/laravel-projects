<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
       public function getListWithOptionalParams($id = null)
       {
           return $id ? Device::find($id) : Device::all();
       }

       /*
       public function list()
       {
           return Device::all();
       }


       public function show($id)
       {
           return Device::find($id);
       }
       */

        public function add(Request $request)
        {
             $device = new Device();
             $device->name = $request->name;
             $device->member_id = $request->memeber_id;

             if($device->save()) {
                 return ['result' => 'Data has been saved.'];
             }

             return ['result' => 'Operation failed.'];
        }


        public function update(Request $request)
        {
            $device = Device::find($request->id);
            $device->name = $request->name;
            $device->member_id = $request->memeber_id;

            if($device->save()) {
                return ['result' => 'Data has been updated.'];
            }

            return ['result' => 'Update operation failed.'];
        }

}
