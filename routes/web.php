<?php

Route::get('/', ['as' => 'app.home.index', 'uses' => 'Web\HomeController@index']);
Route::get('/mercado_livre/categories', ['as' => 'app.mercado_livre.categories.index', 'uses' => 'MercadoLivre\CategoryController@index']);
Route::get('/mercado_livre/categories/{category_id}', ['as' => 'app.mercado_livre.categories.show', 'uses' => 'MercadoLivre\CategoryController@show']);
