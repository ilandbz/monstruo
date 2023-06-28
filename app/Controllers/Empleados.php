<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Helpers\DataSession;

class Empleados extends BaseController
{
    public function index()
    {
        $data = DataSession::getData();

        $data['script'] = "empleados/script";
        //$data['modal_operacion'] = 'categorias/modal-operacion';

        return view('empleados/index',$data);
    }
}
