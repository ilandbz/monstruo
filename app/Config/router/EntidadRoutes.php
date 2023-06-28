<?php

//PROVEEDORES
$routes->group('Proveedor' ,['namespace' => 'App\Controllers'],function($routes){
    $routes->get('index', 'Proveedor::index');
    $routes->post('store', 'Proveedor::store');
});
//EMPLEADOS
$routes->group('empleados' ,['namespace' => 'App\Controllers'],function($routes){
    $routes->get('index', 'Empleados::index');
    // $routes->get('item','Empleados::wsItem');
    // $routes->post('deleteItem','Empleados::deleteItem');
    // $routes->get('buscar','Empleados::wsBuscador');
});
//WEBSERVICE CATEGORÍA
$routes->group('wsempleados' ,['namespace' => 'App\Controllers\WebServices'],function($routes){
    $routes->get('todos', 'WSEmpleados::wsSelect');
    $routes->get('item','WSEmpleados::wsItem');
    $routes->post('deleteItem','WSEmpleados::deleteItem');
    $routes->get('buscar','WSEmpleados::wsBuscador');
});