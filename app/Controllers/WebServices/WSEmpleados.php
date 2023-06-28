<?php

namespace App\Controllers\WebServices;

use App\Controllers\BaseController;
use App\Helpers\DataSession;
use App\Helpers\WSQueries;

class WSEmpleados extends BaseController
{
    private $session;
    public function __construct() {
        $this->session = DataSession::getData()['session'];
    }

    public function wsSelect()
    {                      
        $pagina = (int) $this->request->getGet('page');
        $filas_por_pagina = (int) $this->request->getGet('paginacion');
        $empleado_id = (int)$this->request->getGet('empleado_id');
        $condicion = array(
            'fecha_delete' => null
        );


        $consulta = "SELECT * FROM empleados join tipo_empleados on empleados.tipo_empleado_id=tipo_empleados.id";

        $data = WSQueries::queryResultPaginado($consulta, $pagina,$filas_por_pagina);

        //$data = WSQueries::selectPagination('empleados',$pagina,$filas_por_pagina,$condicion,$empleado_id);

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

        $data = WSQueries::select('empleados',2,"*",$condicion,"");

        //$data = WSQueries::select('empleados',2,"*",$condicion,"");

        
        echo json_encode(
            array(
                'empleado_id' => $data->id,
                'apellido_materno' => $data->apellido_materno,
                'apellido_paterno' => $data->apellido_paterno,
                'nombres' => $data->nombres,
                'dni' => $data->dni,
                'domicilio' => $data->domicilio
            )
        );
    }

    public function wsBuscador()
    {
        $buscar = (string)$this->request->getGet('term');

        $condicion = array('apellido_paterno' => $buscar, 'apellido_materno' => $buscar, 'nombres' => $buscar);

        $data = WSQueries::buscador($buscar,'empleados',$condicion);

        echo json_encode($data);
    }

    public function deleteItem()
    {

        $condicion = array( 'id' => $this->request->getPost('id'));
        $data = array('fecha_delete' => date('Y-m-d H:i:s'),
                        'empleado_delete' => $this->session['empleado_id']);

        $resultado = WSQueries::modificar('empleados',$condicion,$data);

        echo json_encode(array(
            'resultado' => $resultado
        ));
    }
}
