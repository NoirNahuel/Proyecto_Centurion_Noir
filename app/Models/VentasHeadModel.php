<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class VentasHeadModel extends Model{
    protected $table = 'ventas_cabecera';
    protected $primaryKey       = 'id';
    protected $returnType     = 'array';
    protected $allowedFields = [
        'fecha',
        'usuario_id',
        'total_venta',   
        'estado',   
    ];
   
    public function getVentasCabecera(){
        return $this->select('ventas_cabecera.*, registrarse.nombre AS nombre, registrarse.apellido AS apellido')
            ->join('registrarse', 'registrarse.id_usuario = ventas_cabecera.usuario_id')
            ->findAll();
    }
    public function obtenerVentasUsuario($idUsuario){
        return $this->where('usuario_id', $idUsuario)
               ->findAll(); 
    }
    public function obtenerProductosCompradosPorCliente($usuario_id) {
        // Consulta para obtener los productos comprados por el cliente
        $query = $this->db->query("
            SELECT p.nombre_producto 
            FROM productos p 
            INNER JOIN ventas_cabecera v ON p.venta_id = v.venta_id
            WHERE v.usuario_id = ?", [$usuario_id]);
    
        return $query->getResultArray();
    }
    public function obtenerVentasUsuarioPorRangoFechas($userID, $fecha_desde, $fecha_hasta)
    {
        return $this->where('usuario_id', $userID)
                    ->where('fecha >=', $fecha_desde)
                    ->where('fecha <=', $fecha_hasta)
                    ->findAll();
    }
    
    // Ya existente, pero lo dejo aquí para referencia
    public function obtenerVentasUsuarioPorFechaDesde($userID, $fecha_desde)
    {
        return $this->where('usuario_id', $userID)
                    ->where('fecha >=', $fecha_desde)
                    ->findAll();
    }
    public function obtenerVentasPorRangoFechas($fecha_desde, $fecha_hasta)
{
    return $this->where('fecha >=', $fecha_desde)
                ->where('fecha <=', $fecha_hasta)
                ->orderBy('id', 'DESC')
                ->paginate(5);
}

    

}