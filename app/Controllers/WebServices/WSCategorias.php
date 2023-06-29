<?php

namespace App\Controllers\WebServices;

use App\Controllers\BaseController;
use App\Helpers\WSQueries;

class WSCategorias extends BaseController
{
    public function __construct() {}

    public function wsSelect()
    {                      
        $pagina = (int) $this->request->getGet('page');
        $filas_por_pagina = (int) $this->request->getGet('paginacion');
        $categoria_id = (int)$this->request->getGet('categoria_id');

        $condicion = array( 'eliminado' => 0);
        if($categoria_id != 0)
        {
            $condicion = array_merge($condicion, array('id' => $categoria_id));
        }

        $orderBy = "id ASC";

        $data = WSQueries::selectPagination('categorias',$pagina,$filas_por_pagina,$condicion, $orderBy,$categoria_id);

        echo json_encode(
            [
                'data' => $data['data'],
                'total_filas' => $data['total_filas'],
                'pager' => $data['pager']
            ], JSON_UNESCAPED_UNICODE
        );
    }

    public function wsItem() 
    {
        $condicion = array('id' => $this->request->getGet('id'));

        $data = WSQueries::select('categorias',2,"*",$condicion,"");

        echo json_encode(
            array(
                'categoria_id' => $data->id,
                'categoria' => $data->categoria,
                'codigo' => $data->codigo
            )
        );
    }

    public function wsBuscador()
    {
        $buscar = (string)$this->request->getGet('term');

        $condicion = array('categoria' => $buscar);

        $data = WSQueries::buscador($buscar,'categorias',$condicion);

        echo json_encode($data);
    }

    public function deleteItem()
    {
        $condicion = array( 'id' => $this->request->getPost('id'));
        $data = array('eliminado' => 1);

        $resultado = WSQueries::modificar('categorias',$condicion,$data);

        echo json_encode(array(
            'resultado' => $resultado
        ));
    }
}