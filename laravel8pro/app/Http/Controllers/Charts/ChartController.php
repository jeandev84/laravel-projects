<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{

      // HighCharts
      public function index()
      {

           /*
           MYSQL
           $users = User::select(DB::raw("COUNT(*) as count"))
                          ->whereYear('created_at', date('Y'))
                          ->groupBy(DB::raw("MONTH(created_at)"))
                          ->pluck('count');

           $months = User::select(DB::raw("MONTH(created_at) as month"))
                        ->whereYear('created_at', date('Y'))
                        ->groupBy(DB::raw("MONTH(created_at)"))
                        ->pluck('month');
           */

           // PGSQL
           $users = User::select(DB::raw("COUNT(*) as count"))
                         ->whereYear('created_at', date('Y'))
                         ->groupBy(DB::raw("extract(month from created_at)"))
                         ->pluck('count');

           $months = User::select(DB::raw("extract(month from created_at) as month"))
                           ->whereYear('created_at', date('Y'))
                           ->groupBy(DB::raw("extract(month from created_at)"))
                           ->pluck('month');

           // 12 items
           $items = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

           foreach ($months as $index => $month) {
                $items[$month] = $users[$index];
           }

           return view('charts.index', compact('items'));
      }



      protected function populateItems()
      {
              /*
              MYSQL
              $users = User::select(DB::raw("COUNT(*) as count"))
                             ->whereYear('created_at', date('Y'))
                             ->groupBy(DB::raw("MONTH(created_at)"))
                             ->pluck('count');

              $months = User::select(DB::raw("MONTH(created_at) as month"))
                           ->whereYear('created_at', date('Y'))
                           ->groupBy(DB::raw("MONTH(created_at)"))
                           ->pluck('month');

              // PGSQL
              $users = User::select(DB::raw("COUNT(*) as count"))
                  ->whereYear('created_at', date('Y'))
                  ->groupBy(DB::raw("extract(month from created_at)"))
                  ->pluck('count');

              $months = User::select(DB::raw("extract(month from created_at) as month"))
                  ->whereYear('created_at', date('Y'))
                  ->groupBy(DB::raw("extract(month from created_at)"))
                  ->pluck('month');

              // 12 items
              $items = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

              foreach ($months as $index => $month) {
                  $items[$month] = $users[$index];
              }

              return [$items, $users, $items]
             */
      }
}
