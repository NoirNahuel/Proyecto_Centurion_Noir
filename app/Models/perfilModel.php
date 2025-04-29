<?php
namespace App\Models;

use CodeIgniter\Model;
class perfilModel extends Model{
    protected $table ='perfil';
    protected $primaryKey ='id_perfil';
    protected $allowedFields =['descripcion'];

    public function perfilUsuario(){
        return $this->findAll();
    }
 
}