<?php
namespace App\Helpers;
use App\Models\EmpresaModel;

class DataSession
{
    public static function getData(): array
    {
        $session = session();
        
        $data =[];
        if($session->has('usuario'))
        {
            $empresamodel = new EmpresaModel();

            $data['session'] = session('usuario');
            $data['empresa'] = $empresamodel->first();        
            $data['header'] = 'templates/header_administrador';
            $data['footer'] = 'templates/footer';
            $data['script'] = "";

            return $data;
        }

        return $data;
    }
}