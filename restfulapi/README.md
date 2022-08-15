### REST API 

1. Create models

- https://trello.com/uk
```php 
$ php artisan make:model Desk -mf
$ php artisan make:model DeskList -mf
$ php artisan make:model Card -mf
$ php artisan make:model Task -mf

$php artisan migrate
``` 

2. Create Controller 
```php 
$ php artisan make:controller Api/DeskController --resource
```


3. Make Resource 
```php 
$ php artisan make:resource DeskResource
$ php artisan make:resource DeskListResource
```

4. Make Request (for Validation field)
```
$ php artisan make:request DeskStoreRequest

http://localhost:8000/api/v1/desks
http://localhost:8000/api/v2/desks

```
