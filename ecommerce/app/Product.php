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


     // Связь многим к одному (ManyToOne)
     // получаем категорию
     // необязательно указать category_id Laravel уже знает
     public function category()
     {
         // $this->belongsTo('App\\Category', 'category_id');

         return $this->belongsTo('App\\Category');
     }
}
