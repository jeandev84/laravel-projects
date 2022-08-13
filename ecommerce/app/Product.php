<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 *
*/
class Product extends Model
{
      /* protected $table = 'products'; */


     // Связь один к многим (OneToMany)
     // получаем коллекцию картинок
     public function images()
     {
          return $this->hasMany('App\\ProductImage');
     }
}
