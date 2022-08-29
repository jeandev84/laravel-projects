### DropZoneJSFileUpload 

- https://cdnjs.com/libraries/dropzone
```php 

$ php artisan make:controller Image/DropZoneJSFileUploadController

# DropZoneJS File Upload
Route::get('/dropzone-image', [\App\Http\Controllers\Image\DropZoneJSFileUploadController::class, 'dropzoneForm'])
    ->name('dropzone.form');


Route::post('/dropzone-store', [\App\Http\Controllers\Image\DropZoneJSFileUploadController::class, 'dropzoneStore'])
    ->name('dropzone.store');
    
    
<?php

namespace App\Http\Controllers\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DropZoneJSFileUploadController extends Controller
{

       public function dropzoneForm()
       {
            return view('images.dropzone');
       }


       /**
        * @param Request $request
        * @return JsonResponse
       */
       public function dropzoneStore(Request $request): JsonResponse
       {
            $image = $request->file('file');

            $filename = time() . '.' . $image->extension();

            $image->move(public_path('images/dropzone'), $filename);

            return response()->json(['success' => $filename]);
       }
}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DropZoneJs File Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<section style="padding-top: 60px;">
    <div class="container">
        <div class="row">
             <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        DropZoneJs File Upload
                    </div>
                    <div class="card-body">
                        <form action="{{ route('dropzone.store') }}" method="POST" enctype="multipart/form-data" class="dropzone dz-clickable" id="image-upload">
                            @csrf
                            <div>
                                <h3 class="text-center">Upload Image By Click On Box</h3>
                            </div>
                            <div class="dz-default dz-message">
                                <span>Drop files here to upload</span>
                            </div>
                        </form>
                    </div>
                </div>
             </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

<!-- DropzoneJs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>
</html>

```
