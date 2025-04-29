<?php

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;

use CodeIgniter\Model;

class UsersModel extends Model
{
  
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id_usuario';
 

    protected $allowedFields    = ['nombre','apellido','email','password','id_perfil','estado','fecha_modificacion'];

   

 public function validateUser($email, $password){

    $email = $this->where(['email'=> $email])->first();
    if($email && password_verify($password, $email['password'])){
        return $email;
    }
    return null;
 }
public function obtenerUsuario($data){
$usuario=$this->db->table('usuarios');
$usuario->where($data);
return $usuario->get()->getResultArray();

}
public function log($email, $password){
   $email_= $this->where('email',$email)->where('password',$password);
   return $email_->get()->getRowArray();

}
public function getUsuarios(){
    return $this->findAll();
}
public function perfilUsuario(){
    return $this->select('usuarios.*, perfil.descripcion AS descripcion' ) 
     ->join('perfil', 'usuarios.id_perfil = perfil.id_perfil')->findAll();
 }  
}