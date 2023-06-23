<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpresaModel extends Model
{
    protected $table = 'empresas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['empresa', 'nombre_comercial', 'ruc', 'domicilio_fiscal', 'telefono_fijo', 
    'telefono_fijo2', 'telefono_movil','telefono_movil2', 'foto', 'correo', 'ubigeo', 'codigo_sucursal_sunat', 'regimen_id', 'urbanizacion'];
}