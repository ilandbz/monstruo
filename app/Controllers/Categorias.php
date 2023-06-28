<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\DataSession;
use App\Models\CategoriaModel;
use Config\Services;
class Categorias extends BaseController
{
    protected $helpers = ['form'];
    private CategoriaModel $categoria_model;

    public function __construct()
    {
        $this->categoria_model = new CategoriaModel();
    }

    public function index()
    {
        $data = DataSession::getData();

        $validation = Services::validation();

        $data['script'] = "categorias/script";
        $data['modal_operacion'] = 'categorias/modal-operacion';

        return view('categorias/index',$data);
    }

    public function guardar() {

        $rules = [
            'categoria' => 'required|string|max_length[150]',
        ];
        $messages = [
            'categoria' => [
                'required' => '* Campo Obligatorio'
            ]
        ];

        $validation = Services::validation();

        if($this->validate($rules,$messages))
        {
            $data = array(
                'categoria' => $this->request->getPost('categoria'),
                'codigo' => $this->request->getPost('codigo'),
            );
            
            if(!$this->request->getPost('id'))
            {
                $this->categoria_model->insert($data);
    
                return response()->setContentType('application/json')
                        ->setStatusCode(201)
                        ->setJSON([
                            'success' => true,
                            'message' => 'Categoría registrada satisfactoriamente'
                ]);
            }
    
            if($this->request->getPost('id')) {
                $this->categoria_model->update($this->request->getPost('id'),$data);
    
                return response()->setContentType('application/json')
                        ->setStatusCode(200)
                        ->setJSON([
                            'success' => true,
                            'message' => 'Categoría modificada satisfactoriamente'
                ]);
            }
        } else {
            $output  = [
                'errors' => $validation->getErrors()
            ];

            return response()->setContentType('application/json')
                        ->setStatusCode(422)
                        ->setJSON($output)
            ;
        }
    
    }
}
