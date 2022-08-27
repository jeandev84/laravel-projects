<?php

namespace App\Http\Controllers\ZipFile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use ZipArchive;


class ZipController extends Controller
{

       /**
        * @return BinaryFileResponse
       */
       public function downloadZipFile(): BinaryFileResponse
       {
            $zip      = new ZipArchive();
            $fileName = 'demo.zip';

            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {

                  $files = File::files(public_path('medias'));

                  foreach ($files as $key => $value) {

                      $relativeNameInZipFile = basename($value);

                      $zip->addFile($value, $relativeNameInZipFile);
                  }

                  $zip->close();
            }

            return response()->download(public_path($fileName));
       }
}
