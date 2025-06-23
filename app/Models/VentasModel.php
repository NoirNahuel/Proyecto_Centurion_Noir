<?php 
namespace App\Models;  
use CodeIgniter\Model;
  


class VentasModel extends Model{
    protected $table = 'ventas_detalle';
    protected $primaryKey       ='id';
    protected $allowedFields = [
        'venta_id',
        'producto_id',
        'cantidad',
        'precio',    
    ];
    
    public function obtenerTopProductos()
    {
        
        return $this->select('productos.nombre_producto,productos.imagen, SUM(ventas_detalle.cantidad) as total_vendido')
                    ->join('productos', 'productos.idProducto = ventas_detalle.producto_id')
                    ->groupBy('ventas_detalle.producto_id')
                    ->orderBy('total_vendido', 'DESC')
                    ->limit(3)
                    ->findAll();              
    }


    public function getDetalles($id = null, $id_usuario = null) {
        $db = \Config\Database::connect();
        $builder = $db->table('ventas_detalle');
        $builder->select('*');
        $builder->join('ventas_cabecera', 'ventas_cabecera.id = ventas_detalle.venta_id');
        $builder->join('productos', 'productos.idProducto = ventas_detalle.producto_id');
        $builder->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id');

        if ($id !== null) {
            $builder->where('ventas_cabecera.id', $id);
        }

        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getVentasDetalle(){
        return $this->findAll();
    }

    public function obtenerDetallesPedido($idPedido)
    {
        return $this->select('ventas_detalle.*, productos.nombre_producto AS nombre_producto')
            ->join('productos', 'productos.idProducto = ventas_detalle.producto_id')
            ->where('venta_id', $idPedido)
            ->findAll();
    }
    public function getVentasCabecera(){
        return $this->select('ventas_cabecera.*, usuarios.nombre AS nombre, usuarios.apellido AS apellido')
            ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id')
            ->findAll();
    }
    public function obtenerVentasUsuario($idUsuario){
        return $this->where('usuario_id', $idUsuario)
               ->findAll(); 
    }
  
   

}