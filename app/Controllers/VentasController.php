<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\productosModel;
use App\Models\VentasModel;
use App\Models\VentasHeadModel;
use App\Models\UsersModel;
use App\Models\PersonaModel; // Cargar el modelo de Persona

class VentasController extends BaseController
{
    public function __construct() {

        $session=session();
         $cart = \Config\Services::cart();
         $cart->contents();


     }


     public function factura($venta_id)
     {
         $detalleModel = new VentasModel();
         $ventaCabeceraModel = new VentasHeadModel();
         $productModel = new productosModel();
         $userModel = new UsersModel();
         $personaModel = new PersonaModel(); // Cargar el modelo de Persona
     
         // Obtener detalles de la venta
         $detalles = $detalleModel->getDetalles($venta_id);
     
         // Obtener información de la cabecera de la venta
         $ventaCabecera = $ventaCabeceraModel->find($venta_id);
     
         // Obtener nombres de los productos
         $productos = [];
         foreach ($detalles as $detalle) {
             $producto = $productModel->find($detalle['idProducto']);
             $productos[$detalle['idProducto']] = $producto['nombre_producto'];
         }
     
         // Obtener nombre del comprador
         $comprador = $userModel->find($ventaCabecera['usuario_id']);
          // Obtener datos de la persona
         $persona = $personaModel->where('id_usuario', $ventaCabecera['usuario_id'])->first();
         // Pasar los datos a la vista
         $data = [
             'detalles' => $detalles,
             'ventaCabecera' => $ventaCabecera,
             'productos' => $productos,
             'nombre_comprador' => $comprador['nombre'],
             'persona' => $persona // Enviar los datos de la persona a la vista
         ];
         $data['titulo'] = 'Facturacion';
       
         echo view('contenido/GestionCompras/factura', $data);
     
     }

     public function ventas()
     {
         $session = session();
         $id = $session->get('usuario_id');
     
         // Modelos
         $ventaCabeceraModel = new VentasHeadModel();
         $userModel = new UsersModel();
     
         // Capturar fechas desde el formulario (GET)
         $fecha_desde = $this->request->getGet('fecha_desde');
         $fecha_hasta = $this->request->getGet('fecha_hasta');
     
         // Construir la consulta con filtros de fecha si es necesario
         $query = $ventaCabeceraModel->orderBy('id', 'DESC');
     
         if (!empty($fecha_desde) && !empty($fecha_hasta)) {
             $query->where('fecha >=', $fecha_desde)
                   ->where('fecha <=', $fecha_hasta);
         } elseif (!empty($fecha_desde)) {
             $query->where('fecha >=', $fecha_desde);
         }
     
         // Obtener los resultados paginados
         $ventaDetalle = $query->paginate(5);
         $paginador = $ventaCabeceraModel->pager;
     
         // Agregar el nombre del comprador a cada venta
         foreach ($ventaDetalle as &$venta) {
             $comprador = $userModel->find($venta['usuario_id'] ?? null);
             $venta['nombre_comprador'] = $comprador['nombre'] ?? 'Desconocido';
         }
     
         $data = [
             'ventaDetalle' => $ventaDetalle,
             'paginador' => $paginador,
             'fecha_desde' => $fecha_desde,
             'fecha_hasta' => $fecha_hasta
         ];
     
         $data['titulo'] = 'Ventas';
    
       
         echo view('contenido/vista_ventas', $data);
    
     }
    public function buscarVentas()
{
    $session = session();
    $usuarioId = $session->get('usuario_id');

    $ventaCabeceraModel = new VentasHeadModel();

    $cliente = $this->request->getGet('cliente');

    // Siempre unir con usuarios para obtener el nombre
    $builder = $ventaCabeceraModel
        ->select('ventas_cabecera.*, usuarios.nombre AS nombre_comprador')
        ->join('usuarios', 'usuarios.id_usuario = ventas_cabecera.usuario_id', 'left')
        ->orderBy('ventas_cabecera.id', 'DESC');

    // Filtro por cliente si está presente
    if (!empty($cliente)) {
        $builder->like('usuarios.nombre', $cliente);
    }

    $ventaDetalle = $builder->paginate(5);
    $paginador = $ventaCabeceraModel->pager;

    $data = [
        'ventaDetalle' => $ventaDetalle,
        'paginador' => $paginador,
        'cliente' => $cliente
    ];

    $dato['titulo'] = 'Buscar Ventas';
    echo view('plantillas/head', $dato);
    echo view('plantillas/nav');
    echo view('contenido/vista_ventas', $data);
    echo view('plantillas/footer');
}

     

     
public function comprar_carrito()
{
    
    $cart = \Config\Services::cart();
    $productos = $cart->contents();
    $request = \Config\Services::request();
    $montoTotal = 0;

    foreach ($productos as $producto) {
        $montoTotal += $producto["price"] * $producto["qty"];
    }

    $ventaCabecera = new VentasHeadModel();
    $id_session=intval(session()->id_usuario);

    $fechaActual = date('Y-m-d'); // Obtener la fecha actual en el formato deseado

    $idcabecera = $ventaCabecera->insert([
        "total_venta" => $montoTotal,
        "usuario_id" => $id_session,
        "fecha" => date('Y-m-d H:i:s'), // Agregar la fecha actual al array de datos
    ]);
    $ventaDetalle = new VentasModel();
    $productModel = new productosModel();

    foreach ($productos as $producto) {
        $ventaDetalle->insert([
            "venta_id" => $idcabecera,
            "producto_id" => $producto['id'],
            "cantidad" => $producto["qty"],
            "precio" => $producto["price"]
        ]);
        $productStock = $productModel->find($producto["id"]); // Obtener los detalles del producto


            $stock = $productStock["stock"]; // Obtener el stock del producto
            // Restar la cantidad del carrito al stock actual
            $newStock = $stock - $producto["qty"];

        $productModel->update($producto["id"], ['stock' => $newStock]);
    }
    $cart->destroy();
    session()->setFlashdata('msg', '¡La compra se ha realizado Exitosamente!');
    return redirect()->to(base_url('/carrito'));
}


public function guardar_venta()
{
    
    $cart = \Config\Services::cart();
    $productos = new productosModel();
    $detalle =new VentasModel();
    $venta= new VentasHeadModel();

   $cart1 = $cart->contents();
      
     foreach ($cart1 as $item) {
        $producto= $productos->where('idProducto',$item['id'])->first();
          if($producto['stock'] < $item['qty']){
            //producto sin stock
            return redirect()->back()->withInput('msg','Producto sin Stock');
          }else{

     $data= array(
        'id_perfil'=>session('id_perfil'),
        'fecha' =>date('Y-m-d'),
     );
     $venta_id = $venta->insert($data);
     $cart1=$cart->contents();
     foreach($cart1 as $item){
        $detalle_venta=array(
            "venta_id" =>  $venta_id,
            "producto_id" => $item['idProducto'],
            "cantidad" => $item["qty"],
            "precio" => $item["price"]
        );
       
        $productStock = $productos->find($productos['idProducto']); // Obtener los detalles del producto


        $stock = $productStock['stock']; // Obtener el stock del producto
        // Restar la cantidad del carrito al stock actual
        $newStock = $stock - $producto['qty'];

    $productos->update($item['idProducto'], ['stock' => $newStock]);
    $detalleVenta =  $detalle->insert($detalle_venta);
     }  

   }
   $cart->destroy();
   return redirect()->back()->withInput('msg','Compra realizada');
 }
} 
public function registrar_venta()
{
     $session = session();
       
     require(APPPATH . 'Controllers/carrito_controller.php');
    //hago esto porque tengo que traer el contenido del carrito desde el controlador.
      $cart = new carrito_controller();
      $carrito_contents = $cart->add(); //función dentro de carrito_controller 
   
      $ventas = new VentasHeadModel();
      $detalleventas = new VentasModel();
      $producto = new productosModel();
      
   //recorro el carrito de compras para calcular el total
    $total = 0;
    foreach ($carrito_contents as $row) {
        $total += $row['subtotal'];
    }
    // guardo la venta en un array
    $nueva_venta = [
       'usuario_id' => $session->get('usuario_id'),
       'total_venta' => $total
    ];
    $venta_id = $ventas->insert($nueva_venta); //inserta en la tabla (ventas_cabecera)
   
    foreach ($carrito_contents as $row) {
        $detalle = array(
            'venta_id' => $venta_id,
            'producto_id' => $row['id'],
            'cantidad' => $row['qty'],
            'precio' => $row['subtotal']
        );
         //pasamos el id del producto al modelo método getProducto() para que me recupere ese registro con ese id
        $producto_actual = $producto->getProducto($row['id']);
    
      if($producto_actual['stock'] >= $row['qty']){
           $detalleventas->insert($detalle);//guarda el detalle en tabla ventas_detalle
             //actualiza el stock
          $producto->updateStock($row['id'], $producto_actual['stock'] - $row['qty']);
       }else{
            $session->setFlashdata('mensaje', 'No hay stock disponible para el producto "'.$row['name'].'"');
             return redirect()->to(base_url('muestro'));
        }
      }
    $cart->borrar_carrito();
    $session =session();
    $session->setFlashdata('mensaje', "Venta registrada Exitosamente");
    return redirect()->to(base_url('vista_compras/'. $venta_id));
}
public function actualizarEstado()
{
    $ventaId = $this->request->getPost('venta_id');
    $nuevoEstado = $this->request->getPost('estado');

    $ventasModel = new \App\Models\VentasHeadModel();
    $ventasModel->update($ventaId, ['estado' => $nuevoEstado]);

    return redirect()->back()->with('mensaje', 'Estado actualizado correctamente.');
}

}