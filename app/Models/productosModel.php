<?php 
namespace App\Models;  
use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class productosModel extends Model{
    protected $table = 'productos';
    protected $primaryKey = 'idProducto';
    protected $returnType       = 'array';
    protected $allowedFields = [

        'nombre_producto',
        'id_categoria',
        'precio',
        'descripcion_producto',
        'imagen',      
        'stock',
        'stock_min',
        'estado',
        'fecha_modificacion'
        
        
    ];
    public function getCategorias(){
        return $this->findAll();
    }
    public function categorias(){
       return $this->select('productos.*, categoria.descripcion AS cate' ) 
        ->join('categoria', 'productos.id_categoria = categoria.id_categoria')->findAll();
    }
 
    
  
    // Obtener productos entre un rango de fechas
public function aobtenerProductosPorRangoFechas($fecha_desde, $fecha_hasta)
{
    return $this->where('fecha_modificacion >=', $fecha_desde)
                ->where('fecha_modificacion <=', $fecha_hasta)
                ->paginate(5);
}
public function obtenerProductosPorRangoFechas($fecha_desde, $fecha_hasta)
{
    if ($fecha_desde === $fecha_hasta) {
        return $this->where('DATE(fecha_modificacion)', $fecha_desde)
        ->paginate(5);
    }
    return $this->where('DATE(fecha_modificacion) >=', $fecha_desde)
                ->where('DATE(fecha_modificacion) <=', $fecha_hasta)
                ->paginate(5);
}

// Obtener productos desde una fecha
public function obtenerProductosPorFechaDesde($fecha_desde)
{
    return $this->where('fecha_modificacion >=', $fecha_desde)
    ->paginate(5);
}

}
?>


