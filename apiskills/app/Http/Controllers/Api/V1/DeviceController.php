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

        public function create(Request $request)
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



        public function delete($id)
        {
            $device = Device::find($id);

            if ($device instanceof Device && $device->delete()) {
                 return ["result" => "record has been delete ". $id];
            }

            return ["result" => "delete operation  is failed"];
        }



        /**
         * @param $name
         * @return mixed
        */
        public function search($name)
        {
            return Device::where("name", "like", '%'. $name . '%')->get();
        }

}
