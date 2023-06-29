<?php

namespace App\Controllers\WebServices;

use App\Controllers\BaseController;
use App\Helpers\WSQueries;

class WSUnidades extends BaseController
{
    public function __construct() {}

     public function wsSelect()
    {                      
        $pagina = (int) $this->request->getGet('page');
        $filas_por_pagina = (int) $this->request->getGet('paginacion');
        $unidad_id = (int)$this->request->getGet('unidad_id');
        $mostrar = $this->request->getGet('mostrar');

        $condicion = array();
        $condicion = match($mostrar) {
            'todos' => $condicion = array(),
            'activos' => $condicion = array('activo' => 1),
            'inactivos' => $condicion = array('activo' => 0)
        };
        
        $orderBy = "";
        $orderBy = match($mostrar) {
            'todos' => $orderBy = 'activo DESC',
            'activos' => $orderBy = "",
            'inactivos' => $orderBy = ""
        };

        if($unidad_id != 0)
        {
            $condicion = array_merge($condicion, array('id' => $unidad_id));
        }


        $data = WSQueries::selectPagination('unidades',$pagina,$filas_por_pagina,$condicion,$orderBy,$unidad_id);

        echo json_encode(
            [
                'data' => $data['data'],
                'total_filas' => $data['total_filas'],
                'from' => $data['from'],
                'to' => $data['to'],
                'pager' => $data['pager']
            ], JSON_UNESCAPED_UNICODE
        );
    }

    public function wsItem() 
    {
        $condicion = array('id' => $this->request->getGet('id'));

        $data = WSQueries::select('unidades',2,"*",$condicion,"");

        echo json_encode(
            array(
                'unidad_id' => $data->id,
                'unidad' => $data->unidad,
                'codigo' => $data->codigo
            )
        );
    }

    public function wsBuscador()
    {
        $buscar = (string)$this->request->getGet('term');

        $condicion = array(
            'unidad' => $buscar
        );

        $data = WSQueries::buscador($buscar,'unidades',$condicion);

        echo json_encode($data);
    }

    public function deleteItem()
    {
        $condicion = array( 'id' => $this->request->getPost('id'));

        $resultado = WSQueries::eliminar('unidades',$condicion);

        echo json_encode(array(
            'resultado' => $resultado
        ));
    }
}
