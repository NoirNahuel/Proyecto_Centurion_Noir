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
    protected $allowedFields    = [ 'nombre','email','tipo_consulta','mensaje','fecha_consulta','fecha_respuesta','respuesta','leida','id_usuario'];
 

   

    public function getConsulta(){
        return $this->findAll();
    }
public function obtenerConsultasConUsuarioPaginadas($porPagina = 10)
{
    return $this->select('consultas.*, usuarios.nombre AS nombre_usuario, usuarios.apellido AS apellido_usuario, usuarios.email AS email_usuario, usuarios.id_perfil, perfil.descripcion AS perfil')
        ->join('usuarios', 'usuarios.id_usuario = consultas.id_usuario', 'left')
        ->join('perfil', 'perfil.id_perfil = usuarios.id_perfil', 'left')
       ->orderBy('consultas.id_consulta', 'DESC')// asegura el orden
        ->paginate($porPagina);
}



}
?>