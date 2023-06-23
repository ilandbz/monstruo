<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id';
    protected $allowedFields = [];

    public function suma_mensual($anio) {


        $sql = "SELECT SUM(total_a_pagar) suma, YEAR(fecha_emision) anio, MONTH(fecha_emision) mes FROM ventas WHERE YEAR(fecha_emision) = $anio "
                . " AND estado_operacion = 1 AND estado_anulacion IS NULL GROUP BY YEAR(fecha_emision), MONTH(fecha_emision) ORDER BY mes ASC";
        $query = $this->db->query($sql);


        $rows_ventas = array();
        
        foreach ($query->getResultArray() as $row) {
            $rows_ventas[$row['mes']]['mes']    = $row['mes'];
            $rows_ventas[$row['mes']]['suma']   = $row['suma'];
        }

        $sql = "SELECT SUM(total_a_pagar) suma, YEAR(fecha_emision) anio, MONTH(fecha_emision) mes FROM compras WHERE YEAR(fecha_emision) = $anio GROUP BY YEAR(fecha_emision), MONTH(fecha_emision)";
        $query = $this->db->query($sql);        
        $rows_compras = array();
        foreach ($query->getResultArray() as $row) {
            $rows_compras[$row['mes']]['mes']    = $row['mes'];
            $rows_compras[$row['mes']]['suma']   = $row['suma'];
        }
        
        $array_final = array();
        for($mes = 1; $mes <= date("m"); $mes++){
            if(isset($rows_ventas[$mes]['mes'])){
                $array_final[$mes]['mes']         = $rows_ventas[$mes]['mes'];
                $array_final[$mes]['suma_ventas'] = $rows_ventas[$mes]['suma'];
            }
            
            if(isset($rows_compras[$mes]['mes'])){                
                $array_final[$mes]['mes']          = (isset($array_final[$mes]['mes'])) ? $array_final[$mes]['mes'] : $rows_compras[$mes]['mes'];
                $array_final[$mes]['suma_compras'] = $rows_compras[$mes]['suma'];
            }            
        }
        return $array_final;
    }
}