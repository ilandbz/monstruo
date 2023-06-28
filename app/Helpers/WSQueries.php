<?php
namespace App\Helpers;

use CodeIgniter\Database\Query;
use Config\Database;

class WSQueries
{
    private static $db;

    public function __construct() {}

    public static function selectPagination(string $tabla,int $pagina,int $filas_por_pagina,array $condicion = array(),int $id): array
    {
        self::$db = Database::connect();
        $pager = service('pager');
        $offset = ($pagina-1)*$filas_por_pagina;
       if ($condicion == '')
            $condicion = array();

        // $condiciones = [ "1"  => "1"];        
        // $condiciones = array_merge($condiciones, $condicion);
        $builder = self::$db->table($tabla)->where($condicion);
        $record = $builder->get($filas_por_pagina,$offset)->getResult();
        $total_records = self::$db->table($tabla)->where($condicion)->countAllResults();   
        return array(
            'data' => $record,
            'total_filas' => $total_records,
            'pager' => $pager->makeLinks($pagina,$filas_por_pagina,$total_records)
        );
    }

    public static function queryResultPaginado(string $consulta, int $pagina,int $filas_por_pagina): array
    {
        self::$db = Database::connect();
        $pager = service('pager');
        $offset = ($pagina-1)*$filas_por_pagina;



        $consulta = $consulta." LIMIT ".$filas_por_pagina." OFFSET ".$offset.";";

        $record = self::$db->query($consulta)->getResult();


        $total_records = self::$db->query($consulta)->getNumRows();   
        return array(
            'data' => $record,
            'total_filas' => $total_records,
            'pager' => $pager->makeLinks($pagina,$filas_por_pagina,$total_records)
        );
    }
    
    public static function queryResult($consulta, $modo){
        self::$db = Database::connect();
        $builder = self::$db->query($consulta);

        $resultado = match($modo){
            1 => $builder->getResult(), //fila como arreglo
            2 => $builder->getRow(), //fila como objeto
            3 => $builder->getResultArray() //arreglo
        };
        return $resultado;
    }


    public static function select(string $tabla, int $modo, string $select = "*", array $condicion = array(), string $order = "")
    {
        self::$db = Database::connect();

        if ($condicion == '')
            $condicion = array();

        $condiciones = [ "1"  => "1"];        
        $condiciones = array_merge($condiciones, $condicion);
        $orderby = ($order=="") ? "id DESC" : $order;

        $builder = self::$db->table($tabla)->select($select)->where($condicion)->orderBy($orderby)->get();

        $resultado = match($modo){
            1 => $builder->getResult(), //fila como arreglo
            2 => $builder->getRow(), //fila como objeto
            3 => $builder->getResultArray() //arreglo
        };

        return $resultado;
    }

    public static function buscador(string $buscar, string $tabla, array $condicion = array() ) 
    {
        self::$db = Database::connect();

        $builder = self::$db->table($tabla)->where('eliminado',0)->like($condicion);

        $record = $builder->get()->getResult();

        $rows = array();
        foreach($record as $fila)
        {
            array_push($rows, array(
                'id' => $fila->id,
                'value' => $fila->categoria
            ));
        }

        return $rows;
    }

    public static function modificar(string $tabla,array $condicion = array(), array $data=array()) 
    {
        self::$db = Database::connect();

        $builder = self::$db->table($tabla);

        return $builder->update($data,$condicion);
    }
    
}