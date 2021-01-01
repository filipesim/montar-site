<?php

//Definindo rotas para a aplicação
Route::get('/crud-index', function () {
    return view('crud-index');
});

//Rotas das requisições AJAX
Route::get('/read-user', 					['uses' => 'CrudController@readUser']);
Route::post('/create-user', 				['uses' => 'CrudController@createUser']);
Route::post('/update-user', 				['uses' => 'CrudController@updateUser']);
Route::post('/delete-user', 				['uses' => 'CrudController@deleteUser']);

