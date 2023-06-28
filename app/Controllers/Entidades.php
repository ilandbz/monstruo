<?php
namespace App\Controllers;
use App\Models\EmpresaModel;
use App\Models\Entidades_model;
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
   
    public function nuevo(){
        $this->accesos_model->menuGeneral();
        $this->load->view('entidades/nuevo');
        $this->load->view('templates/footer');
    }
    
    public function modal_importar_excel(){
        $this->load->view('entidades/modal_importar_excel');
    }
    
    public function modal_operacion(){
        return view('entidades/modal_operacion');
    }
    
    public function modal_detalle(){
        $this->load->view('entidades/modal_detalle');
    }
    
    public function modal_ubicacion(){
        $this->load->view('entidades/modal_ubicacion');
    }
    
    public function modal_cuenta_bancaria(){
        $this->load->view('entidades/modal_cuenta_bancaria');
    }
    
    public function operaciones(){
        $session = session('usuario');
        $entidades_model = new Entidades_model();
        $data = array(
            'tipo_entidad_id'   =>  $_GET['tipo_entidades'],
            'numero_documento'  =>  $_GET['numero_documento'],
            'entidad'           =>  $_GET['entidad'],
            'direccion'         =>  $_GET['direccion'],
            'telefono_movil_1'  =>  $_GET['telefono_movil_1']
        );        
        
        if(isset($_GET['entidad_id']) && ($_GET['entidad_id'] != '')){
            $entidad_id = $_GET['entidad_id'];
            $data_update = array(
                'fecha_update'      =>  date("Y-m-d H:i:s"),
                'empleado_update'   =>  $session['empleado_id']
            );
            $data = array_merge($data, $data_update);            
            $entidades_model ->modificar($_GET['entidad_id'], $data);
        }else{//puede que el cliente que se quiere ingresar nuevo Ya exista, en ese caso solo se actualizará.
            $entidad_id = $entidades_model ->select_deliverys(1, array('id'), array($_GET['numero_documento']));
            if($entidad_id == ''){
                $data_insert = array(
                    'fecha_insert'      =>  date("Y-m-d H:i:s"),
                    'empleado_insert'   =>  $session['empleado_id']
                );                
                $data = array_merge($data, $data_insert);
                $entidades_model ->insertar($data);
                $entidad_id = $entidades_model ->select_max_id();            
            }elseif($entidad_id > 0){
                $data_update = array(
                    'fecha_update'      =>  date("Y-m-d H:i:s"),
                    'empleado_update'   =>  $session['empleado_id']
                );
                $data = array_merge($data, $data_update);
                $entidades_model ->modificar($entidad_id, $data);
            }            
        }
                
        $jsondata = array(
            'success'           =>  true,
            'message'           =>  'Operación correcta',
            'entidad_id'        =>  $entidad_id
        );
        echo json_encode($jsondata);
    }        
    
    public function ubicacion(){        
        $data = array(
            'email_1'           =>  $_GET['email_1'],
            'email_2'           =>  $_GET['email_2'],
            'telefono_fijo_1'   =>  $_GET['telefono_fijo_1'],
            'telefono_fijo_2'   =>  $_GET['telefono_fijo_2'],
            'telefono_movil_1'  =>  $_GET['telefono_movil_1'],
            'telefono_movil_2'  =>  $_GET['telefono_movil_2'],
            'pagina_web'        =>  $_GET['pagina_web'],          
            'facebook'          =>  $_GET['facebook'],          
            'twitter'           =>  $_GET['twitter']
        );

        $data_update = array(
            'fecha_update'      =>  date("Y-m-d H:i:s"),
            'empleado_update'   =>  $session['empleado_id']
        );
        $data = array_merge($data, $data_update);
        $this->entidades_model->modificar($_GET['entidad_id'], $data);
                
        $jsondata = array(
            'success'   =>  true,
            'message'   =>  'Operación correcta'
        );
        echo json_encode($jsondata);
    }
    
    public function guardar_file_excel(){
        $carpeta = "files/entidades/excel/";
        
        opendir($carpeta);
        $destino = $carpeta.$_FILES['imagen']['name'];
        if(copy($_FILES['imagen']['tmp_name'], $destino)){ 
            $data = array(
                'respuesta' => 'ok'
            );
            echo json_encode($data);
        }else{
            echo "problema al cargar";
        }
    }
    
    public function importarExcel(){        
        $carpeta = "files/entidades/excel/";
        $archivo = $_GET['imagen'];
        $this->load->library('excel');
        
        $excel = PHPExcel_IOFactory::load($carpeta.$archivo);
        $excel->SetActiveSheetIndex(0);
        $numero_fila = $excel->setActiveSheetIndex(0)->getHighestRow();
                 
        for($i = 2; $i <= $numero_fila; $i++){
            $data = array(
                'tipo_entidad_id'           => $excel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue(),
                'numero_documento'          => $excel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue(),
                'entidad'                   => $excel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue(),
                'direccion'                 => $excel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue(),
                'email_1'                   => $excel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue(),
                'fecha_insert'              => date("Y-m-d H:i:s"),
                'empleado_insert'           => $session['empleado_id']
            );
            $this->entidades_model->insertar($data);
        }
        $jsondata = array(
            'success'       =>  true,
            'message'       =>  'Operación correcta'
        );
        echo json_encode($jsondata, JSON_UNESCAPED_UNICODE);
    }        


}
