<?php
namespace App\Models;

use CodeIgniter\Model;
class CategoriaModel extends Model{
    protected $table ='categoria';
    protected $primaryKey ='id_categoria';
    protected $allowedFields =['descripcion','activo'];

    public function getCategorias(){
        return $this->findAll();
    }
 
}