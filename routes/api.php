<?php

use App\Http\Controllers\Page\DeletePageController;
use App\Http\Controllers\Page\ShowPageController;
use App\Http\Controllers\Page\StorePageController;
use App\Http\Controllers\Page\UpdatePageController;
use App\Http\Controllers\Post\PostController;

Route::prefix('admin')
    ->group(function () {
        Route::resource('posts', PostController::class);
        Route::post('/pages', StorePageController::class);
        Route::get('/pages/{page}', ShowPageController::class);
        Route::put('/pages/{page}', UpdatePageController::class);
        Route::delete('/pages/{page}', DeletePageController::class);
    });
