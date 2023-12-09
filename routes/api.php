<?php

use Gtrig\NestableTree\Http\Controllers\NestableTreeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

// Route::get('/', function (Request $request) {
//     echo 'test';
// });

Route::get('/load/{resource}', [NestableTreeController::class, 'load']);
Route::post('/update/{resource}', [NestableTreeController::class, 'update']);