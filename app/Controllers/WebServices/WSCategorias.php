<?php

namespace App\Controllers\WebServices;

use App\Controllers\BaseController;
use App\Models\CategoriaModel;

class WSCategorias extends BaseController
{
    private CategoriaModel $categoria_model;

    public function __construct()
    {
        $this->categoria_model = new CategoriaModel();
    }

    public function wsSelect()
    {                      
        $pagina = (int) $this->request->getGet('page');
        $filas_por_pagina = (int) $this->request->getGet('paginacion');
        $buscar = (string)$this->request->getGet('buscar');

        $data = array();
        $data = $this->selectCategorias($pagina,$filas_por_pagina,$buscar);

        echo json_encode(
            [
                'data' => $data['data'],
                'total_filas' => $data['total_filas'],
                'pager' => $data['pager']
            ], JSON_UNESCAPED_UNICODE
        );
    }

    public function selectCategorias(int $pagina,int $filas_por_pagina,string $buscar)
    {        
        $categorias =$this->categoria_model->paginate($filas_por_pagina);
        
        $total_categorias = $this->categoria_model->countAllResults();
        return array(
            'data' => $categorias,
            'total_filas' => $this->categoria_model->countAllResults(),
            'pager' =>  $this->categoria_model->pager
        );
        
    }
}