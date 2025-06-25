<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\productosModel;
use App\Models\CategoriaModel;
use App\Models\VentasHeadModel;
use App\Models\UsersModel;
use App\Models\VentasModel;
use App\Models\PersonaModel;

class compras_controller extends Controller{
    protected $ventas;
    protected $detalleVentas;
    protected $usuarios;
    protected $productos;

    public function __construct(){
           helper(['form', 'url']);
           $this->ventas = new VentasHeadModel();
           $this->detalleVentas = new VentasModel();
           $this->usuarios = new UsersModel();
           $this->productos = new productosModel();
    }
 
    public function listarComprasUsuario()
{
    $userID = session()->get('id_usuario');
    $ventasModel = new VentasHeadModel();

    // Capturar fechas del GET
    $fecha_desde = $this->request->getGet('fecha_desde');
    $fecha_hasta = $this->request->getGet('fecha_hasta');

    $porPagina = 5;

    // Usar builder para más control
    $builder = $ventasModel->where('usuario_id', $userID)->orderBy('fecha', 'DESC');

    // Aplicar filtros de fecha (considerando hora si es datetime)
    if (!empty($fecha_desde) && !empty($fecha_hasta)) {
        $builder->where('fecha >=', $fecha_desde . ' 00:00:00')
                ->where('fecha <=', $fecha_hasta . ' 23:59:59');
    } elseif (!empty($fecha_desde)) {
        $builder->where('fecha >=', $fecha_desde . ' 00:00:00');
    }

    // Obtener resultados paginados
    $ventasUsuario = $builder->paginate($porPagina);
    $paginador = $ventasModel->pager;

    // Cargar carrito
    $cart = \Config\Services::cart();
    $datos = ['cartTotal' => count($cart->contents())];

    // Obtener productos de cada venta del usuario
    $db = \Config\Database::connect();
    $query = $db->query("
        SELECT vd.venta_id, p.nombre_producto
        FROM ventas_detalle vd
        INNER JOIN productos p ON vd.producto_id = p.idProducto
        INNER JOIN ventas_cabecera vh ON vd.venta_id = vh.id
        WHERE vh.usuario_id = ?
    ", [$userID]);

    $resultado = $query->getResultArray();

    // Agrupar productos por venta_id
    $productosPorVenta = [];
    foreach ($resultado as $row) {
        $productosPorVenta[$row['venta_id']][] = $row['nombre_producto'];
    }

    $data = [
        'productosPorVenta' => $productosPorVenta,
        'ventas' => $ventasUsuario,
        'paginador' => $paginador,
        'fecha_desde' => $fecha_desde,
        'fecha_hasta' => $fecha_hasta
    ];

    $dato['titulo'] = 'Mis Compras';

    echo view('plantillas/head', $dato);
    echo view('plantillas/nav', $datos);
    echo view('contenido/Carrito/listar_compras', $data);
    echo view('plantillas/footer');
}

public function resumen_compras()
{   
    helper(['form','url','cart']);
 
    $cart =\Config\Services::cart();

    $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos
    
    $datos = [
        'cartTotal' => count($cart->contents()),
    ];
    $cart->contents();

    $session = session();
    $id_usuario = $session->get('id_usuario'); // Obtener el id del usuario logueado

    // Cargar los modelos
    $usersModel = new \App\Models\UsersModel();
    $personaModel = new \App\Models\PersonaModel();
    $cart = \Config\Services::cart(); // Obtener servicio de carrito

    // Obtener los datos del usuario
    $usuario = $usersModel->find($id_usuario);
    $datosPersona = $personaModel->where('id_usuario', $id_usuario)->first();
      $carrito = $cart->contents(); // Obtener contenido del carrito
    // Pasar los datos a la vista
     $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos para nav
         $datosCart = [
            'cartTotal' => count($cart->contents()),
        ];
    $datos = [
        'usuario' => $usuario,
        'datosPersona' => $datosPersona, // También pasamos los datos adicionales de la persona
        'carrito' => $carrito 
    ];
    $data['titulo'] = 'Confirmar Compra ';
    return view('plantillas/head', $data).view('plantillas/nav',$datosCart).view('contenido/GestionCompras/resumen_compra',$datos).view('plantillas/footer');
}


    public function listarDetalleUsuario($id){ 
        $userID = session()->get('id_usuario');
        $ventasModel = new VentasHeadModel();
        $ventaCabeceraModel = new VentasHeadModel();
        $userModel = new UsersModel();
        $personaModel = new PersonaModel(); // Cargar el modelo de Persona
        $ventasUsuario = $ventasModel->obtenerVentasUsuario($userID);
        $ventas['ventas'] = $ventasUsuario;
        $detalles = $this->detalleVentas->obtenerDetallesPedido($id);
          // Obtener información de la cabecera de la venta
          $ventaCabecera = $ventaCabeceraModel->find($id);
       
         // Obtener nombre del comprador
         $comprador = $userModel->find($ventaCabecera['usuario_id']);
          // Obtener datos de la persona
         $persona = $personaModel->where('id_usuario', $ventaCabecera['usuario_id'])->first();
         // Pasar los datos a la vista
     
        foreach ($detalles as $producto) {
            $productos[] = $this->productos->find($producto['producto_id']);
        }
          $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $data = [
            'numero_pedido' => $id,
            'detalles' => $detalles,
            'productos' => $productos,
            'ventas' => $ventasUsuario,
            'nombre_comprador' => $comprador['nombre'],
            'persona' => $persona // Enviar los datos de la persona a la vista
           
        ];
        $dato['titulo'] = 'Detalle de Compra ';
        
         echo view('plantillas/head',$dato);
         echo view('plantillas/nav',$datos);
         echo view('contenido/Carrito/listar_detalle_usuario' ,$data);
         echo view('plantillas/footer');
    }
    



}