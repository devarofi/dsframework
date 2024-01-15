# dsframework
PHP Ds Framework Next Generation

## Model
```php
namespace App\Models;

use Ds\Foundations\Connection\Models\DsModel;

class People extends DsModel {
  public $table = 'people';
}
```

## Controller
```php
class IndexController extends Controller
{
    public function index()
    {
        view('home');
    }

    public function peopleList(){
        $data = People::all();
        // Response is json encode
        return [ 'people_list' => $data ];
    }

    public function savePeople(Request $request){
        // Save json data
        People::save($request->json());
        // OR specify request field
        People::save([
            'fullname' => $request->fullname,
            'phone' => $request->phone
        ]);
        // OR all Request Form Field Data
        People::save($request->all());
    }

    public function welcomePage()
    {
        // Response is Views/Html render
        view('welcome');
    }
}
```

## Routing
Example :
```php
// with callback controller method
Route::get('/', [IndexController::class, 'index']);
Route::get('/welcome', [IndexController::class, 'welcomePage']);
Route::get('/people', [IndexController::class, 'peopleList']);
Route::post('/people/save', [IndexController::class, 'savePeople']);

// simple route
Route::get('/sample/subsample', function () {
    echo 'Welcome to routing!';
});

// With uri as parameter
Route::get('/sample/{arg1}/subsample/{arg2}', function ($arg1, $arg2) {
    echo 'Uri param ' . $arg1 . ' - ' . $arg2;
});
// With middleware
Route::middleware(['auth'], function () {
    Route::get('/mypage/{arg1}/othersub/{mysub}', function ($arg1, $mysub) {
        echo 'page param ' . $arg1 . ' - ' . $mysub;
    });

    Route::get('/mypage/page/{arg1}/{arg2}', function ($arg1, $arg2) {
        echo 'page ' . $arg1 . ' param ' . $arg2;
    });
});
// or with middleware in spacific route
Route::get('/people-list', [ IndexController::class, 'index' ])->middleware('api-auth');
// or multiple middleware
Route::get('/people-list', [ IndexController::class, 'index' ])
            ->middleware([ 'api-auth', 'company-auth' ]);

// With grouping /admin/...
Route::group('admin', function () {
    Route::get('/get-string', function () {
        // will return Json Encode
        return ['username' => 'Deva Arofi'];
    });
});
```

## View
Example : ``welcome.pie.php``
```html
<html>
    <head>
        <title>{{ $appname }}</title>
    </head>
    <body>
        Welcome to Web App
    </body>
</html>
```

### Pie Cheat Sheet
|Syntax|Closing|Description|
|-|-|-|
|``{{ ... }}``|``-``|Same as ``echo(...)`` in php|
|``<< ... >>``|``-``|Same as ``<?php ... ?>`` in php|
|``@slot(..)``|``-``|Create a slot for templating|
|``@use(..)``|``-``|To use a template that includes ``@slot`` syntax|
|``@part(..)``|``@endpart``|To inject a content into ``@slot(..)``|
|``@foreach(..):``|``@endforeach``|Same as ``<?php foreach(..): `` in php|
|``@if(...):``|``@endif``|Same as ``<?php if(..): ?>`` in php|


based on @daevsoft - dsframework
