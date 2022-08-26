### Basic Query Eloquent (ORM)

1. Create a model Eloquent and migration associated to this model.
```php 
$ php artisan make:model Student -m 

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';

}


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}



$ php artisan migrate

<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


/**
 *
*/
class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
    */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index)
        {
            DB::table('students')->insert([
                'name'  => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
            ]);
        }
    }
}


<?php

namespace Database\Seeders;

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

        /*

        foreach (range(1, 1000) as $index) {
             DB::table('users')->insert([
                 'name' => $faker->name,
                 'email' => $faker->email,
                 'password' => bcrypt('secret'),
                 'phone' => $faker->phoneNumber
             ]);
        }
        */


        // \App\Models\User::factory(35)->create();

        // $this->call([PostTableSeeder::class]);

        foreach (range(1, 100) as $index)
        {
             DB::table('students')->insert([
                  'name'  => $faker->name,
                  'email' => $faker->email,
                  'phone' => $faker->phoneNumber,
             ]);
        }
    }
}

$ php artisan db:seed

$ php artisan make:controller Eloquent/StudentController

<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function fetchStudents()
    {
         // $students = Student::all();
         // $students = Student::where('id', 3)->get();
         // $students = Student::whereBetween('id', [33, 44])->get();
        
            $students = Student::whereBetween('id', [33, 44])->orderBy('id', 'DESC')->get();

         return $students;
    }


    protected function fetchAllStudents()
    {
         return Student::all();
    }


    protected function fetchStudentByColumn($column, $value)
    {
         return Student::where($column, $value)->get();
    }


    protected function fetchStudentsBetween($column, array $intervals)
    {
         return Student::whereBetween($column, $intervals)->get();
    }
}

# Eloquent
Route::get('/students', [StudentController::class, 'fetchStudents']);
```
