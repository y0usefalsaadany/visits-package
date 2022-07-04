# install package

```
composer require yousefpackage/visits
```

# then goto config folder 

in app.php

write this in $routeMiddleware

```
'providers' => [

Yousefpackage\Visits\VisitServiceProvider::class,

],
```

# then goto kernel.php

write this in $routeMiddleware

```
'visit' => \Yousefpackage\Visits\Http\Middleware\VistsMiddleware::class,
```

# then run this command 

```
php artisan migrate
```

# test package 

now for test this package goto your browser and write this visits-package

```
http://127.0.0.1:8000/visits-package
```

# using
Now Put this middleware on the route you want to calculate the number of views for.

```
->middleware('throttle:visit', 'visit');
```

like this 

```
Route::get('/', function () {
    return view('welcome');
})->middleware('throttle:visit', 'visit');
```

If you want to calculate the number of views you have, make a controller and then put this code

```
<?php

use Yousefpackage\Visits\Models\Visit;
use Illuminate\Support\Facades\DB;

class ViewsController extends Controller
{
    function index(){

        return DB::table('visits')->select('ip')->count(); // To count the number of views 

        return Visit::all(); // To display the data in the visits table
    }
}

>
```

And we find in the table that we have the visitor’s IP, his city, the page he visited and the type of his operating system
