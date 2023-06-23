<?php
namespace App\Controllers;
use App\Models\EmpleadoModel;
use App\Models\EmpresaModel;
use App\Models\ModuloModel;
class Home extends BaseController
{
    public function index(){
        $session = session();
      if($session->has('usuario')){
        return redirect()->route('inicio');
      }else{
        return view('acceso/login', compact('session'));
      }
    }
    public function login(){
      $session = session();
      $empleadomodel=new EmpleadoModel();
      $modulomodel = new ModuloModel();
      $request=\Config\Services::request();
      $email_1=$request->getPostGet('email_1');
      $contrasena=$request->getPostGet('contrasena');
      $where="email_1='".$email_1."' AND contrasena = '".$contrasena."'";
      $registro = $empleadomodel->where($where)->first();
      if(is_null($registro)){
        $session->setFlashdata('respuesta_login', 'Datos Incorrectos');
        return $this->response->redirect(site_url('/'));	
      }else{
			$item = array(
        'id'              => $registro['id'],
        'nombres'		      => $registro['nombres'],
        'apepat'		      => $registro['apellido_paterno'],
        'apemat'		      => $registro['apellido_materno'],
        'tipo_empleado'   => $registro['tipo_empleado_id']
			);
			$usuario = $item;
			$session->set('usuario', $usuario);
      //modulos
      $condicion_padres = array(
        'tipo_empleado_id'  =>  $registro['tipo_empleado_id'],
        'referencia'        =>  0,
        'estado'            =>  1
      );

      $padres = $modulomodel->select('modulos.id, orden, tipo_empleado_modulos.modulo_id, padre, estado, referencia, direccion_icono, modulo, enlace')
      ->join('tipo_empleado_modulos', 'modulos.id = tipo_empleado_modulos.modulo_id')
      ->where($condicion_padres)->orderBy('modulos.id', 'ASC')
      ->findAll();

      $session->set('padres', $padres);
      $condicion_hijos = array(
        'tipo_empleado_id'  =>  $registro['tipo_empleado_id'],
        'referencia != '    =>  0,
        'estado'            =>  1
      );
      $datos = $modulomodel->select('modulos.id, orden, tipo_empleado_modulos.modulo_id, padre, estado, referencia, direccion_icono, modulo, enlace')
      ->join('tipo_empleado_modulos', 'modulos.id = tipo_empleado_modulos.modulo_id')
      ->where($condicion_hijos)->orderBy('referencia', 'ASC')
      ->findAll();

      $datos_array = array();
      foreach ($datos as $value){
        $datos_array[$value['referencia']][$value['id']]['id']                = $value['id'];
        $datos_array[$value['referencia']][$value['id']]['direccion_icono']   = $value['direccion_icono'];
        $datos_array[$value['referencia']][$value['id']]['modulo']            = $value['modulo'];
        $datos_array[$value['referencia']][$value['id']]['enlace']            = $value['enlace'];
        $datos_array[$value['referencia']][$value['id']]['referencia']        = $value['referencia'];
        $datos_array[$value['referencia']][$value['id']]['orden']             = $value['orden'];
        $datos_array[$value['referencia']][$value['id']]['padre']             = $value['padre'];
        $datos_array[$value['referencia']][$value['id']]['estado']            = $value['estado'];                
      }
      $hijos = $datos_array;        
      $session->set('hijos', $hijos);



        return redirect()->route('inicio');
      }
    }
    function logout(){
      $session = session();		
      $session->destroy();
      return $this->response->redirect(site_url('/'));	
    }
    function inicio() {

      $session = session();
      $empresamodel = new EmpresaModel();
      if($session->has('usuario')){
        $data['session'] = session('usuario');
        $data['empresa'] = $empresamodel->first();        
        $data['header'] = 'templates/header_administrador';
        $data['footer'] = 'templates/footer';        
     
        return view('acceso/inicio', $data);
      }else{
        return $this->response->redirect(site_url('/'));	
      }
    }
}
