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
