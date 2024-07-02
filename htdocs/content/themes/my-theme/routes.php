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

Route::any('template', ['home', function(PageController $page){
    $data = $page->render('home', 'accueil', 'page');
    // dd($data);
    return $data;
}]);

Route::any('template', ['ratatest', function(PageController $page){
    $data = $page->render('ratatest', 'ratatest', 'page');
    // dd($data);
    return $data;
}]);


// --------------------------------- EXAMPLE --------------------------------- //


// Route::any('page-url/{slug}', ['template-name', function(pageController $page, Request $request){
//     $data = $page->renderpage(
//         'template-name', (required)
//         'slug', (required)
//         'post-type', (required)
//         ['linked-post-1', 'linked-post-2', 'etc'], 
//         'img-size'
//     );
//     // dd($data);
//     return $data;
// }]);