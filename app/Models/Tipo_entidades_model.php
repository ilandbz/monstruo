<?PHP
namespace App\Models;

use CodeIgniter\Model;

class Tipo_entidades_model extends Model{

    public $tabla = 'tipo_entidades';

    public function __construct() {
        parent::__construct();            
    }

    public function select($modo, $select = array(), $condicion = array(), $order = '') {

        if ($select == '')
            $select = array();
        if ($condicion == '')
            $condicion = array();

        $where = '';
        foreach ($condicion as $key => $value) {
            if ($value == 'IS NULL') {
                $where .= " AND $key " . $value;
            } else {
                $where .= " AND $key = '" . $value . "' ";
            }
        }

        $campos = ($select == array()) ? '*' : implode(", ", $select);
        $sql = "SELECT " . $campos . " FROM $this->tabla WHERE 1 = 1 " . $where . " " . $order;
        $query = $this->db->query($sql);

        switch ($modo) {
            case '1':
                $resultado = '';
                if ($query->getNumRows() > 0) {
                    $row = $query->getRow();
                    $resultado = $row[$campos];
                }
                return $resultado;

            case '2':
                $row = array();
                if ($query->getNumRows() > 0) {
                    $row = $query->getRow();
                }
                return $row;

            case '3':
                $rows = array();
                foreach ($query->getResultArray() as $row) {
                    $rows[] = $row;
                }
                return $rows;
        }
    }        

    public function insertar($data, $mensaje = '') {
        $this->db->insert($this->tabla, $data);

        $respuesta = ($mensaje == '') ? 'Operación realizada con éxito' : $mensaje;
        $this->session->set_flashdata('mensaje',$respuesta);
    }           

    public function modificar($id, $data, $mensaje='') {
        $this->db->where('id', $id);
        $this->db->update($this->tabla, $data);

        $respuesta = ($mensaje == '') ? 'Operación realizada con éxito' : $mensaje;
        $this->session->set_flashdata('mensaje',$respuesta);
    }

    public function ws_select(){
        $data = $this->select(3, array('id', 'tipo_entidad', 'codigo', 'descripcion'));

        $datos = array();
        foreach ($data as $value){
            $datos[] = array(
                'id'            => (int)$value['id'],
                'tipo_entidad'  =>$value['tipo_entidad'],
                'codigo'        =>$value['codigo'],
                'descripcion'   =>$value['descripcion']
            );
        }
        return $datos;
    }

}