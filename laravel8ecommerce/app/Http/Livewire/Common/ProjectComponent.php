<?php
namespace App\Http\Livewire\Common;

use Livewire\Component;


/**
 *
*/
abstract class ProjectComponent extends Component implements ComponentContract
{
      public function render()
      {
           return view($this->getRenderName())->layout($this->getLayoutName());
      }


      public function getLayoutName()
      {
           return "layouts.base";
      }


      abstract public function getRenderName();
}
