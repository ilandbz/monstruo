<?php

//CATEGORIAS
$routes->group('categorias' ,['namespace' => 'App\Controllers'],function($routes){
    $routes->get('index', 'Categorias::index');
    $routes->post('guardar', 'Categorias::guardar');
});
//WEBSERVICE CATEGORÍA
$routes->group('wscategorias' ,['namespace' => 'App\Controllers\WebServices'],function($routes){
    $routes->get('todos', 'WSCategorias::wsSelect');
    $routes->get('item','WSCategorias::wsItem');
    $routes->post('deleteItem','WSCategorias::deleteItem');
    $routes->get('buscar','WSCategorias::wsBuscador');
});
