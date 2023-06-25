<?php

//CATEGORIAS
$routes->group('categorias' ,['namespace' => 'App\Controllers'],function($routes){
    $routes->get('index', 'Categorias::index');
    $routes->post('store', 'Categorias::store');
    //WebService Categoría
});
$routes->group('wscategorias' ,['namespace' => 'App\Controllers\WebServices'],function($routes){
    $routes->get('todos', 'WSCategorias::wsSelect');
    //$routes->post('store', 'Categorias::store');
    //WebService Categoría
});
