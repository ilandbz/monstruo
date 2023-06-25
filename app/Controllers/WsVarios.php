<?php
namespace App\Controllers;
use App\Models\VentaModel;

class WsVarios extends BaseController
{
    public function datos_accesorios(){
        $data = 0;
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    public function index(){
        echo 'asdasd';
    }
    public function suma_mensual($anio){
        $ventasmodel = new VentaModel();

        $data = $ventasmodel->suma_mensual($anio);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }


    

}
