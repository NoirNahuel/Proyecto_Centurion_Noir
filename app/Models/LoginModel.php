<?php
namespace App\Models;
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class LoginModel extends Model {
	protected $table = 'usuarios';
	protected $primaryKey = 'id_usuario';
	protected $allowedFields    = ['nombre','apellido','email','password','id_perfil','fecha_modificacion'];
}