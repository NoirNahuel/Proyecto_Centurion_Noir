<?php

namespace App\Models;
use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model; 


class ConsultaModel extends Model
{
    protected $table            = 'consultas';
    protected $primaryKey       = 'id_consulta';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'nombre','email','tipo_consulta','mensaje','fecha_consulta','fecha_respuesta','respuesta','leida'];

   

    public function getConsulta(){
        return $this->findAll();
    }
   
}
?>