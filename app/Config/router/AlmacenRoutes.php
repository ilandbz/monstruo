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
    $routes->post('delete-item','WSCategorias::deleteItem');
    $routes->get('buscar','WSCategorias::wsBuscador');
});

//UNIDADES
$routes->group('unidades' ,['namespace' => 'App\Controllers'],function($routes){
    $routes->get('index', 'Unidades::index');
    $routes->post('guardar', 'Unidades::guardar');
});
//WEBSERVICE UNIDAD
$routes->group('wsunidades' ,['namespace' => 'App\Controllers\WebServices'],function($routes){
    $routes->get('/', 'WSUnidades::wsSelect');
    $routes->get('item','WSUnidades::wsItem');
    $routes->post('delete-item','WSUnidades::deleteItem');
    $routes->get('buscar','WSUnidades::wsBuscador');
});
