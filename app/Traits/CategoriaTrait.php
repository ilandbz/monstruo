<?php

namespace App\Traits;

use App\Models\CategoriaModel;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;

trait CategoriaTrait
{
    public function todos(IncomingRequest $request): array
    {
        $categoria_model = new CategoriaModel();
        $categorias =$categoria_model->paginate($request->getGet('paginacion') );

        $data= [
            'data' => $categorias,
            'pager' => $categoria_model->pager
        ];
        return  $data;
    }
}