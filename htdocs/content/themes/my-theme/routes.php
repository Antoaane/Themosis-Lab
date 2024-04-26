<?php

/**
 * Theme routes.
 *
 * The routes defined inside your theme override any similar routes
 * defined on the application global scope.
 */

use App\Http\Controllers\PageController;
use App\Http\Controllers\LieuController;
use App\Http\Controllers\MembreController;
use Illuminate\Support\Facades\Route;

Route::any('template', ['home', function(PageController $page, LieuController $lieu, MembreController $membre){
    return $page->render('home', $lieu->getAllLocations(), $membre->getAllMembres());
}]);