### Admin Product Page

```php 
$ php artisan make:livewire admin/AdminProductComponent


add method category() for related relation
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const PerPage       = 12;
    const AdminPerPage  = 10;
    const POPULAR_LIMIT = 4;
    const RELATED_LIMIT = 5;


    protected $table = "products";


    public function category()
    {
         return $this->belongsTo(Category::class, 'category_id');
    }
}


```
