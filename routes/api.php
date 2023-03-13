<?php

// Api
$router->group(["prefix" => "api"], function() use ($router){
    $router->get("kontak", "KontakController@index");
    $router->post("kontak/post","KontakController@store");
    $router->post("kontak/update/{nomor}","KontakController@update");
    $router->delete("kontak/delete/{nomor}","KontakController@destroy");
    $router->get("kontak/show/{nomor}","KontakController@show");


});

// Auth
$router->group(["prefix" => "auth"], function() use ($router){
    $router->post('register','UserController@register');
    $router->post('login','UserController@login');
});