### Resize Image 

```php
$ composer require intervention/image:*

./composer.json 

require: {
   "intervention/image": "^2.0"
}

$ composer install --ignore-platform-reqs


./config/app.php 

return [

   ... 
   
   'providers' => [
      \Intervention\Image\ImageServiceProvider::class,
   ],
   
   'aliases' => [
      'Image' => \Intervention\Image\Facades\Image::class,
   ]
];


$ php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"

```
