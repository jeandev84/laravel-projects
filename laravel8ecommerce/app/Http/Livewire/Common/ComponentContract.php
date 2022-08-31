<?php
namespace App\Http\Livewire\Common;

interface ComponentContract
{
     public function render();
     public function getRenderName();
     public function getLayoutName();
}
