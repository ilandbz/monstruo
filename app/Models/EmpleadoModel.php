<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadoModel extends Model
{
    protected $table = 'empleados';
    protected $primaryKey = 'id';
    protected $allowedFields = ['apellido_paterno', 'apellido_materno', 'nombres', 'contrasena', 'fecha_nacimiento', 
    'dni', 'domicilio','telefono_fijo', 'telefono_movil', 'email_1', 'email_2', 'foto', 'tipo_empleado_id', 'fecha_insert',
    'empleado_insert', 'fecha_update', 'empleado_update', 'fecha_delete', 'empleado_delete'];
}