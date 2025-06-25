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
public function obtenerConsultasConUsuarioPaginadas($porPagina = 10, $fecha_desde = null, $fecha_hasta = null)
{
    // Normalizar fechas
    if (!empty($fecha_desde) && strlen($fecha_desde) === 10) {
        $fecha_desde .= ' 00:00:00';
    }

    if (!empty($fecha_hasta) && strlen($fecha_hasta) === 10) {
        $fecha_hasta .= ' 23:59:59';
    }

    $builder = $this->select('consultas.*, usuarios.nombre AS nombre_usuario, usuarios.apellido AS apellido_usuario, usuarios.email AS email_usuario, usuarios.id_perfil, perfil.descripcion AS perfil')
        ->join('usuarios', 'usuarios.id_usuario = consultas.id_usuario', 'left')
        ->join('perfil', 'perfil.id_perfil = usuarios.id_perfil', 'left')
        ->orderBy('consultas.id_consulta', 'DESC');

    // Aplicar filtros
    if (!empty($fecha_desde) && !empty($fecha_hasta)) {
        $builder->where('fecha_consulta >=', $fecha_desde)
                ->where('fecha_consulta <=', $fecha_hasta);
    } elseif (!empty($fecha_desde)) {
        $builder->where('fecha_consulta >=', $fecha_desde);
    }

    return $builder->paginate($porPagina);
}





}
?>