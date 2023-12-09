<?php

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Http\Requests\NovaRequest;

/*
|--------------------------------------------------------------------------
| Tool Routes
|--------------------------------------------------------------------------
|
| Here is where you may register Inertia routes for your tool. These are
| loaded by the ServiceProvider of the tool. The routes are protected
| by your tool's "Authorize" middleware by default. Now - go build!
|
*/

Route::get('/', function (NovaRequest $request) {
    return inertia('NestableTree');
});

Route::get('/reorder/{resource} ', function (NovaRequest $request, $resource) {
    //if model is not in config sortable_resources, return 404 with message "Resource not found"
    if (!array_key_exists($resource, config('nestable-tree')['sortable_resources'])) {
        abort(404, 'Resource not found');
    }

    return inertia('NestableTree', ['resource' => $resource]);
});