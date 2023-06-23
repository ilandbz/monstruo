<?php
namespace App\Controllers;
use App\Models\EmpresaModel;
class Entidades extends BaseController
{
    public function index(){
        $session = session();
        if($session->has('usuario')){
            $empresamodel = new EmpresaModel();

            $data['session'] = session('usuario');
            $data['empresa'] = $empresamodel->first();        
            $data['header'] = 'templates/header_administrador';
            $data['footer'] = 'templates/footer';    
            return view('entidades/index', $data);
        }else{

        }
    }

}
