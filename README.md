# install package

```
composer require yousefpackage/visits
```

# then goto kernel.php

write this in $routeMiddleware

```
'visit' => \Yousefpackage\Visits\Http\Middleware\VistsMiddleware::class,
```

# then write this command 

```
php artisan migrate
```

# test package 

now for test this package goto your browser and write this visits-package

```
http://127.0.0.1:8000/visits-package
```


Now Put this middleware on the route you want to calculate the number of views for.

```
->middleware('visit');
```

# like this 

```
Route::get('/', function () {
    return view('welcome');
})->middleware('visit');
```