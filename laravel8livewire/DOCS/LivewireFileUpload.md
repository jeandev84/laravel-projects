### Livewire File Upload 


```php 

$ php artisan make:model Upload -m


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('filename');
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
        Schema::dropIfExists('uploads');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $table = "uploads";

    protected $fillable = ['title', 'filename'];
}


$ php artisan migrate


$ php artisan make:livewire Uploads

COMPONENT CREATED  🤙

CLASS: app/Http/Livewire/Uploads.php
VIEW:  resources/views/livewire/uploads.blade.php

========================================================


<?php
namespace App\Http\Livewire;

use App\Models\Upload;
use Livewire\Component;
use Livewire\WithFileUploads;


/**
 *
*/
class Uploads extends Component
{

    public $title;
    public $filename;


    use WithFileUploads;
    public function fileUpload()
    {
        $validatedData = $this->validate([
            'title'    => 'required',
            'filename' => 'required',
        ]);

        // will be stored temporary file in ./storage/app/livewire-tmp/someHashFile.png
        // will be stored file in ./storage/app/public/files/someHashFile.png
        $filename = $this->filename->store('files', 'public');
        $validatedData['filename'] = $filename;

        Upload::create($validatedData);
        session()->flash('message', 'File successfully uploaded!');
        $this->emit('fileUploaded');
    }



    public function render()
    {
        return view('livewire.uploads');
    }
}



# Layout ./resources/views/livewire/layouts/app.blade.php 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire Project</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        nav svg {
            max-height: 20px;
        }
    </style>
    @livewireStyles
</head>
<body>

    <section>
        <div class="container">
            {{$slot}}
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    @livewireScripts

    <script>

        /*
          function callEvent(target, callback) {
            window.livewire.on(callback, () => {
              $('#' + target).modal('hide')
            })
         }
     */

        // Event for adding student
        window.livewire.on('studentAdded', () => {
            $('#addStudentModal').modal('hide')
        })

        // Event for updating student
        window.livewire.on('studentUpdated', () => {
            $('#updateStudentModal').modal('hide')
        })

        // Event for uploading file
        window.livewire.on('fileUploaded', () => {
            $('#form-upload')[0].reset();
        })

    </script>
</body>
</html>


View File : ./resources/views/livewire/uploads.blade.php 

<div>

   <section style="padding-top: 60px;">
       <div class="container">
           <div class="row">
               <div class="col-md-6 offset-md-3">

                   <!-- Display flash message -->
                   @if(session()->has('message'))
                       <div class="alert alert-success">{{ session()->get('message') }}</div>
                   @endif
                   <!-- End Display -->

                   <div class="card">
                       <div class="card-header">
                           <h3>File Upload</h3>
                       </div>
                       <div class="card-body">

                           <form wire:submit.prevent="fileUpload()" id="form-upload" enctype="multipart/form-data">

                               <div class="form-group">
                                   <label for="title">Title</label>
                                   <input type="text"
                                          name="title"
                                          class="form-control"
                                          id="title"
                                          wire:model="title"
                                   >
                                   @error('title')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>

                               <div class="form-group">
                                   <label for="filename">File</label>
                                   <input type="file"
                                          name="filename"
                                          class="form-control"
                                          id="filename"
                                          wire:model="filename"
                                   >
                                   @error('filename')
                                   <span class="text-danger">{{ $message }}</span>
                                   @enderror
                               </div>

                               <button type="submit" class="btn btn-success float-right">
                                   Upload
                               </button>

                           </form>

                       </div>
                   </div>
               </div>
           </div>
       </div>
   </section>

</div>


#Livewire File Upload
Route::get('/uploads', \App\Http\Livewire\Uploads::class);



```
