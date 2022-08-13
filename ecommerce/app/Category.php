<?php
namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 *
*/
class Category extends Model
{

    // получаем все продуктов конкретного категории (OneToMany)
    public function products()
    {
        return $this->hasMany('App\\Product');
    }
}
