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
    public function registrarCompra(){
        $usuarioID = session()->get('id_usuario');
        $cart = \Config\Services::cart();
        $totalCompra = 0;
        $contenidoCarrito = $cart->contents();
        foreach ($contenidoCarrito as $producto) {
            $totalCompra += $producto['price'] * $producto['qty'];
        }
        $data = [
            'usuario_id' => $usuarioID,
            'total_venta' => $totalCompra,
        ];
        $this->ventas->insert($data);
        $pedidoID = $this->ventas->getInsertID();
        foreach ($contenidoCarrito as $producto) {
            $idProducto = $producto['id'];
            $productoObtenido = $this->productos->find($idProducto);
             $detalleVenta = [
                'venta_id' => $pedidoID,
                'producto_id' => $idProducto,
                'cantidad' => $producto['qty'],
                'precio' => $producto['qty'] * $producto['price'],
            ];
            $stock = $productoObtenido['stock'] - $producto['qty'];
            $this->productos->update($idProducto, ['stock' => $stock]);
            $this->detalleVentas->insert($detalleVenta);
        }
        $cart->destroy();
        session()->setFlashdata('msg','Compra registrada exitosamente!');
        return redirect()->to(base_url('carrito')); 
    }

     public function listarVentas(){ 
        $ventas = $this->ventas->getVentasCabecera();
        
        echo view('front/navbar_admin');
        echo view('back/carrito/listar_ventas' ,['ventas'=> $ventas]);

     }

      public function listarDetalle($id){ 
        $data = [
            'numero_pedido' => $id,
            'detalles' => $this->detalleVentas->obtenerDetallesPedido($id)
        ];
         echo view('front/navbar_admin');
         echo view('back/carrito/listar_detalle' ,$data);
    }

    
    public function listarComprasUsuario()
{
    $userID = session()->get('id_usuario');
    $ventasModel = new VentasHeadModel();

    // Capturar las fechas desde el formulario (GET)
    $fecha_desde = $this->request->getGet('fecha_desde');
    $fecha_hasta = $this->request->getGet('fecha_hasta');

    $porPagina = 5; // Cantidad de resultados por página

    if (!empty($fecha_desde) && !empty($fecha_hasta)) {
        $ventasUsuario = $ventasModel->where('usuario_id', $userID)
                                     ->where('fecha >=', $fecha_desde)
                                     ->where('fecha <=', $fecha_hasta)
                                     ->orderBy('fecha', 'DESC')
                                     ->paginate($porPagina);
    } elseif (!empty($fecha_desde)) {
        $ventasUsuario = $ventasModel->where('usuario_id', $userID)
                                     ->where('fecha >=', $fecha_desde)
                                     ->orderBy('fecha', 'DESC')
                                     ->paginate($porPagina);
    } else {
        $ventasUsuario = $ventasModel->where('usuario_id', $userID)
                                     ->orderBy('fecha', 'DESC')
                                     ->paginate($porPagina);
    }

    $cart = \Config\Services::cart();
    $cartTotal = ['cartTotal' => count($cart->contents())];

    $datos = [
        'cartTotal' => count($cart->contents()),
    ];
     // Obtener el ID del usuario actual (de sesión)
        $usuarioId = session('id_usuario');
          $db = \Config\Database::connect();
    $query = $db->query("
    SELECT vd.venta_id, p.nombre_producto
    FROM ventas_detalle vd
    INNER JOIN productos p ON vd.producto_id = p.idProducto
    INNER JOIN ventas_cabecera vh ON vd.venta_id = vh.id
    WHERE vh.usuario_id = ?
", [$usuarioId]);

$resultado = $query->getResultArray();

// Agrupar por venta_id:
$productosPorVenta = [];
foreach ($resultado as $row) {
    $productosPorVenta[$row['venta_id']][] = $row['nombre_producto'];
}
   $data = [
    'productosPorVenta' => $productosPorVenta,
    'ventas' => $ventasUsuario,
        'paginador' => $ventasModel->pager, // Aquí pasamos el paginador a la vista
        'fecha_desde' => $fecha_desde,
        'fecha_hasta' => $fecha_hasta,
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
    //Estadistica para dashboard
   
    public function dashboardCliente($id) {
        // Obtener el ID del usuario en sesión
        $id_usuario = session('id_usuario');

        // Cargar los modelos
        $userModel = new UsersModel();
        $personaModel = new PersonaModel();

        // Obtener los datos del usuario
        $usuario = $userModel->find($id_usuario);

        // Obtener los datos adicionales de persona
        $persona = $personaModel->where('id_usuario', $id_usuario)->first();

       
        $ventasDetalleModel = new VentasModel();
        $ventasCabeceraModel = new VentasHeadModel();
        $productosModel = new productosModel();
        
        // Obtener el ID del usuario actual (de sesión)
        $usuarioId = session('id_usuario');
    
        // Consultar los productos comprados por el usuario
        $db = \Config\Database::connect();
        $query = $db->query("
            SELECT p.nombre_producto
            FROM ventas_detalle vd
            INNER JOIN productos p ON vd.producto_id = p.idProducto
            INNER JOIN ventas_cabecera vh ON vd.venta_id = vh.id
            WHERE vh.usuario_id = ?
        ", [$usuarioId]);
    
        $productosComprados = $query->getResultArray();
    
        // Obtener las ventas del usuario
        $ventasUsuario = $ventasCabeceraModel->obtenerVentasUsuario($usuarioId);
    
        // Obtener el último pedido
        $ultimaVenta = $ventasUsuario[0] ?? null; // Asegurarse de que exista una venta
    
        $detalles = [];
        $productos = [];
        if ($ultimaVenta) {
            // Obtener los detalles del último pedido
            $detalles = $this->detalleVentas->obtenerDetallesPedido($ultimaVenta['id']);
    
            // Obtener los productos relacionados a esa venta
            foreach ($detalles as $producto) {
                $productos[] = $productosModel->find($producto['producto_id']);
            }
        }
        
        // Obtener las últimas 3 compras basadas en la fecha de la cabecera de ventas
        $ultimasCompras = $ventasDetalleModel
            ->select('productos.nombre_producto')
            ->join('productos', 'productos.idProducto = ventas_detalle.producto_id')
            ->join('ventas_cabecera', 'ventas_cabecera.id = ventas_detalle.venta_id')
            ->where('ventas_cabecera.usuario_id', $usuarioId)
            ->orderBy('ventas_cabecera.fecha', 'DESC')
            ->limit(3)
            ->findAll();
    
        // Calcular el total acumulado (cantidad * precio) para todas las compras del cliente en sesión
$totalGastado = 0;

if (!empty($usuarioId)) {
    $queryTotal = $db->table('ventas_detalle vd')
        ->select('SUM(vd.cantidad * vd.precio) AS total_gastado')
        ->join('ventas_cabecera vh', 'vd.venta_id = vh.id')
        ->where('vh.usuario_id', $usuarioId)
        ->get();

    $totalGastado = $queryTotal->getRow()->total_gastado ?? 0; // Asegura que devuelva 0 si no hay registros
}
        $userModel = new UsersModel();
        $users = $userModel->find($id);
       
          
        // Preparar los datos para la vista
        $dato = [
            'productos_comprados' => $productosComprados,
            'numero_pedido' => $ultimaVenta['id'] ?? null,
            'detalles' => $detalles,
            'productos' => $productos,
            'ventas' => $ventasUsuario,
            'ultimas_compras' => $ultimasCompras,
            'total_gastado' => $totalGastado, // Pasar el total acumulado a la vista
            'usuario' => $usuario,
            'persona' => $persona,
            
        ];
        $user = [
            'user' => $users];
        $data['titulo'] = 'Dashboard Cliente | Tienda MateCamp';
    
        // Renderizar las vistas
        echo view('plantillas/head', $data);
        echo view('plantillas/nav',$user);
        echo view('contenido/dashboardCliente', $dato);
        echo view('plantillas/footer');
    }
    
    public function listarUltimasCompras()
    {
        // Instancia de los modelos
        $ventasDetalleModel = new VentasModel();
        $ventasCabeceraModel = new VentasHeadModel();
        $productosModel = new productosModel();

        // Obtener las últimas 3 compras basadas en la fecha de la cabecera de ventas
        $ultimasCompras = $ventasDetalleModel
            ->select('productos.nombre_producto')
            ->join('productos', 'productos.idProducto = ventas_detalle.producto_id')
            ->join('ventas_cabecera', 'ventas_cabecera.id = ventas_detalle.venta_id')
            ->orderBy('ventas_cabecera.fecha', 'DESC') // Ordenar por fecha descendente
            ->limit(3) // Limitar a 3 resultados
            ->findAll();

        // Pasar los datos a la vista
        
        $dato = ['ultimas_compras'=>$ultimasCompras];
        $data['titulo'] = 'Dashboard Cliente| Tienda MateCamp';
        
        echo view('plantillas/head',$data);
        echo view('plantillas/nav');
        echo view('contenido/dashboardCliente',$dato);
        echo view('plantillas/footer');
    }



}