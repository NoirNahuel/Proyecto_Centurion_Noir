<?php

namespace App\Models;

use CodeIgniter\Model;

class LogUsuarioModel extends Model
{
    protected $table = 'log_usuario';
    protected $primaryKey = 'id_log';
    protected $allowedFields = ['id_usuario', 'tipo_origen', 'accion', 'detalle', 'fecha_hora'];
    public $timestamps = false;
}
