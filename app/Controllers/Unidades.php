<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\DataSession;
use App\Models\UnidadModel;
use Config\Services;

class Unidades extends BaseController
{
    private UnidadModel $unidadModel;

    public function __construct()
    {
        $this->unidadModel = new UnidadModel();    
    }

    public function index()
    {
        $data = DataSession::getData();

        $data['script'] = "unidades/script";
        $data['modal_operacion'] = 'unidades/modal-operacion';

        return view('unidades/index',$data);
    }

    public function guardar() {

        $rules = [
            'codigo' => 'required|string|max_length[3]',
            'unidad' => 'required|string|max_length[150]',
        ];
        $messages = [
            'codigo' => [
                'required' => '* Campo Obligatorio',
                'max_length[3]' => 'Máximo 3 caracteres'
            ],
            'unidad' => [
                'required' => '* Campo Obligatorio',
                'max_length[150]' => 'Máximo 150 caracteres'
            ]
        ];

        $validation = Services::validation();

        if($this->validate($rules,$messages))
        {

            $data = array(
                'unidad' => $this->request->getPost('unidad'),
                'codigo' => $this->request->getPost('codigo'),
                'activo' => $this->request->getPost('activo') ?? 1
            );
            
            if(!$this->request->getPost('id'))
            {
                $this->unidadModel->insert($data);
    
                return response()->setContentType('application/json')
                        ->setStatusCode(201)
                        ->setJSON([
                            'success' => true,
                            'message' => 'Unidad registrada satisfactoriamente'
                ]);
            }
    
            if($this->request->getPost('id')) {
                $this->unidadModel->update($this->request->getPost('id'),$data);
    
                return response()->setContentType('application/json')
                        ->setStatusCode(200)
                        ->setJSON([
                            'success' => true,
                            'message' => 'Unidad modificada satisfactoriamente'
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
