### Livewire Multiple Image Upload

```php 

$ php artisan make:model Image -mf

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
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
        Schema::dropIfExists('images');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = "images";

    protected $fillable = ['filename'];
}

$ php artisan migrate

==============================================
    CREATE A LIVEWIRE COMPONENT "Images"
===============================================

$ php artisan make:livewire Images

COMPONENT CREATED  🤙

CLASS: app/Http/Livewire/Images.php
VIEW:  resources/views/livewire/images.blade.php

=====================================================
LOGIC :

<?php

namespace App\Http\Livewire;

use App\Models\Image;
use Livewire\Component;
use Livewire\WithFileUploads;


class Images extends Component
{

    public $images = [];


    use WithFileUploads;
    public function uploadImages()
    {
         //
         foreach ($this->images as $key => $image) {
              $this->images[$key] = $image->store('images', 'public');
         }

         $this->images = \json_encode($this->images);

         Image::create(['filename' => $this->images]);

         session()->flash('message', 'Images successfully uploaded');

         $this->emit('imagesUploaded');
    }



    public function render()
    {
        return view('livewire.images');
    }
}


./resources/views/livewire/layouts/app.blade.php

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

        // Event for uploading images
        window.livewire.on('imagesUploaded', () => {
            $('#upload-images')[0].reset();
        })

    </script>
</body>
</html>




./resources/views/livewire/layouts/images.blade.php
<div>

    <section style="padding-top: 60px;">
     {{--    .container>.row>.col-md-6.offset-md-3>.card>.card-header+.card-body --}}
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">

                    <!-- Display Message -->
                      @if(session()->has('message'))
                          <div class="alert alert-success">
                              {{ session('message') }}
                          </div>
                      @endif
                    <!-- End Display -->

                    <div class="card">
                        <div class="card-header">
                             <h4>Upload Images</h4>
                        </div>
                        <div class="card-body">

                            <form wire:submit.prevent="uploadImages()" id="upload-images" enctype="multipart/form-data">

                                 <div class="form-group">
                                     <label for="images">Choose Images</label>
                                     <input type="file"
                                            name="images"
                                            class="form-control"
                                            id="images"
                                            wire:model="images"
                                            multiple
                                     >
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



======================================================
ROUTE:

# Livewire Multiple Image Upload
Route::get('/upload-images', \App\Http\Livewire\Images::class);


```
