### High Charts

- https://cdnjs.com/libraries/highcharts
- https://code.highcharts.com/highcharts.js
- https://www.tutorialspoint.com/highcharts/highcharts_quick_guide.htm
```php 
In this case using table "users"

$ php artisan migrate


<?php

namespace Database\Seeders;

use App\Models\Employee;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
    */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index)
        {
            // -6 month ago, + 1month later
            DB::table('users')->insert([
                'name'        => $faker->name,
                'email'       => $faker->unique()->safeEmail,
                'password'    => encrypt('password'),
                'created_at'  => $faker->dateTimeBetween('-6 month', '+1 month')
            ]);
        }

    }
}

$ php artisan db:seed

$ php artisan make:controller Charts/ChartController


<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{

      // HighCharts
      public function highCharts()
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HighCharts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>

    <div id="chart-container"></div>


    <!-- HighCharts Script -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script src="https://code.highcharts.com/highcharts.js" integrity="sha512-pdArzIL77ceOr46AI4+6vDLs8BiUnLaEW+NN/RKLHgR0duCzyjFkYvBi/YzJZ8IJ7NY6n7abilVkJ0dGroSCKQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        let items = <?php echo \json_encode($items) ?>


        $(document).ready(function () {

            $('#chart-container').highcharts({
                title: {
                    text: 'New User Growth,2022'
                },
                subtitle: {
                    text: 'Source: Laventure Media'
                },
                xAxis: {
                    categories:[
                        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                    ]
                },
                yAxis: {
                    title: {
                        text: 'Number of New User'
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        allowPointSelect: true
                    }
                },
                series: [{
                    name: 'New User',
                    data: items
                }],
                responsive: {
                    rules: [
                        {
                            condition: {
                                maxWidth: 500
                            },
                            chartOptions: {
                                legend: {
                                    layout: 'horizontal',
                                    align: 'center',
                                    verticalAlign: 'bottom'
                                }
                            }
                        }
                    ]
                }
            })
        });


    </script>
</body>
</html>



# Charts
Route::get('/high-charts', [\App\Http\Controllers\Charts\ChartController::class, 'highCharts'])
   ->name('highcharts');

```
