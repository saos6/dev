<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->get('/pdf/dl/{customer_id}', 'PdfController@index')->name('pdf.dl');
    $router->get('/pdf/view/{customer_id}', 'PdfController@view')->name('pdf.view');
    $router->resource('users', UserController::class);
    $router->resource('blogs', BlogController::class);
    $router->resource('authors', AuthorController::class);
    $router->resource('books', BookController::class);

    $router->get('/pdfsample', 'SampleController@pdf_sample')->name('pdf_sample');
});
