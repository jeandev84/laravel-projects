### Accessor 


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


    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phone'
    ];


    // MUTATOR
    public function setEmailAttribute($value)
    {
         $this->attributes['email'] = strtolower($value);
    }


    // ACCESSOR NAME
    public function getNameAttribute($value)
    {
         return strtoupper($value);
    }


    // ACCESSOR EMAIl
    public function getEmailAttribute($value)
    {
        return strtoupper($value);
    }

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

$ php artisan make:controller Accessor/StudentController

<?php

namespace App\Http\Controllers\Accessor;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
       public function addStudent()
       {
             $student = new Student();
             $student->name  = "Peter";
             $student->email = "PETERjohn@gmail.com";
             $student->phone = "1234567891";

             $student->save();

             return "Record Inserted";
       }


       public function getStudents()
       {
            return Student::all();
       }
}

# Accessors and Mutators
Route::get('/add-student', [\App\Http\Controllers\Accessor\StudentController::class, 'addStudent'])
     ->name('add.student');


Route::get('/students', [\App\Http\Controllers\Accessor\StudentController::class, 'getStudents'])
    ->name('students.list');

```
