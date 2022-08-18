<?php
namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


/**
 *
*/
class PostController extends Controller
{

      /**
       * @return \string[][]
      */
      public function index()
      {
          return [
              [
                  'title' => 'Hello, world',
                  'text'  => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex'
              ],
              [
                  'title' => 'Duis aute irure dolor in reprehenderit',
                  'text'  => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
              ]
          ];
      }
}
