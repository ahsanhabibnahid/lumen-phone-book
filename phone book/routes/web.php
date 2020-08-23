<?php



$router->post('/registration','RegistrationController@register');

$router->post('/login','LoginController@login');

$router->post('/tokenTest',['middleware'=>'auth','uses'=>'LoginController@tokenTest']);

$router->post('/insert',['middleware'=>'auth','uses'=>'DetailsControlller@insert']);

$router->post('/select',['middleware'=>'auth','uses'=>'DetailsControlller@select']);

$router->post('/delete',['middleware'=>'auth','uses'=>'DetailsControlller@delete']);

