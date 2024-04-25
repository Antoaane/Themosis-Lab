<?php

/**
 * Theme routes.
 *
 * The routes defined inside your theme override any similar routes
 * defined on the application global scope.
 */

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::any('template', ['home', function(PageController $page){
    return $page->render('home');
}]);