<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\productosModel;
use App\Models\CategoriaModel;
use App\Models\VentasHeadModel;
use App\Models\UsersModel;
use App\Models\VentasModel;

class carrito_controller extends BaseController{
  
    public function carrito_view(){
        helper(['form','url','cart']);
 
        $cart =\Config\Services::cart();
    
        $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos
        
        $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $cart->contents();
        $data['titulo'] = 'Carrito MateCamp';
        return view('plantillas/head', $data).view('plantillas/nav',$datos).view('contenido/Carrito/carrito').view('plantillas/footer');
    }
    public function cart_drop(){
        helper(['form','url','cart']);
 
        $cart =\Config\Services::cart();
    
        $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos
        
        $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $cart->contents();
       
        return view('contenido/Carrito/cart-drop',$datos);

        
    }
    public function __construct() {

         $session=session();
         $cart = \Config\Services::cart();
         $cart->contents();
        
 
     }

 

     public function add(){
         $cart = \Config\Services::cart();
         $request = \Config\Services::request();
         $productId = $request->getPost('idProducto');
         $cartItems = $cart->contents();
        
        
         // Verificar si el producto ya está en el carrito
         foreach ($cartItems as $item) {
             if ($item['id'] == $productId) {
                 // Producto ya está en el carrito, puedes mostrar un mensaje de error o redireccionar a otra página
                 return redirect()->back()->with('producto_existente',true);
             }
         }
         
         $cart->insert([
        'id'    => $productId,
        'qty'   => 1,
        'name'  => $request->getPost('nombre_producto'),
        'price' => $request->getPost('precio'),
        'options' => [
            'stock'     => $request->getPost('stock'),
            'stock_min' => $request->getPost('stock_min'),
            'imagen'    => $request->getPost('imagen'), // 🔥 esta es la línea clave
        ]
    ]);
         // Actualizar el total de productos en la sesión
           $session = session();
           $session->set('total_productos', $cart->totalItems());
         //return redirect()->back()->withInput();
          // Redirigir con un mensaje
          return redirect()->back()->with('mensaje', 'Producto agregado al carrito');
         
        }

 
     public function agregar_carrito(){
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();
       
        
        // Verificar si el producto ya está en el carrito
        $data=array(
            'id' => $request->getPost('idProducto'),
            'name' => $request->getPost('nombre_producto'),
            'price' => $request->getPost('precio'),
            'stock' => $request->getPost('stock'),
            'stock_min' => $request->getPost('stock_min'),
            'qty' => 1
        );
       $cart->insert($data);
    
        return redirect()->back()->withInput();
    }
     
 public function actualiza_carrito(){
     $cart = \Config\Services::cart();
     $request = \Config\Services::request();
     $cart ->update(array(
     'id' =>$request->getPost('idProducto'),
     'qty' =>1,
     'price' =>$request->getPost('precio'),
     'name' =>$request->getPost('nombre_producto'),
     'stock'=>$request->getPost('stock'),
     'stock_min' => $request->getPost('stock_min')
     ));
 
 
     return redirect()->back()->withinput();
 }
 
 
 public function remove($rowid){
     $cart = \Config\Services::cart();
 
     if ($rowid =='all'){
         $cart->destroy();
 
     }
     else{
         $cart->remove($rowid);
     }
     return redirect()->back()->withInput();
 }
 public function borrar_carrito()
 {
     $cart = \Config\Services::cart();//para que incluya el $cart
     $cart->destroy();
     return redirect()->back()->withInput();
 
 }
 
 
 public function muestra(){
     helper(['form','url','cart']);
  
     $cart =\Config\Services::cart();
     $cart->contents();
     $session = session();
     $id=$session->get('usuario_id');
     $perfil=$session->get('id_perfil');
     
         $detalle_ventas = new VentasHeadModel();
         $dates['ventaDetalle'] = $detalle_ventas->orderBy('id', 'DESC')->findAll();
 
     $dato['titulo']='Carrito';

     echo view('plantillas/head',$dato);
     echo view('plantillas/nav');
     echo view('contenido/Carrito/carrito', $dates);
     echo view('plantillas/footer');
     
 }
 
 public function comprar_carrito(){
     $cart =\Config\Services::cart();
     $productos=$cart->contents();
     $request=\Config\Services::request();
     $montoTotal=0;
     foreach($producto as $producto){
         $montoTotal+=$producto["price"]*$producto["qty"];
     }
     $ventaCabecera = new Ventas_cabecera_model();
     $idcabecera=$ventaCabecera->insert(["total_venta" => $montoTotal,"usuario_id"=>session()->id]);
     $ventaDetalle = new Ventas_detalle_model();
     $productmodel= new productosModel();
     foreach($producto as $producto){
         $ventaDEtalle->insert(["venta_id" =>$idcabecera,"producto_id"=>$producto[id],
         "stock"=>$product["qty"],"precio"=>$producto["price"]]);
         $productomodel->update($producto["id"],["stock"=>$producto["stock"]- $producto["qty"]]);
     }
     session()->setFlashdata('mensaje', 'Compra confirmada!');

     return redirect()->to('/carrito');
     return redirect()->back()->withInput();
 }
 
 public function restar_carrito(){
            $cart = \Config\Services::cart();
             $productos = $cart->contents();
              $cantidad = $cart->getItem($this->request->getGet("id"))["qty"];
         
         if($cantidad > 1){ 
             $cart->update(array(
                 "rowid" => $this->request->getGet("id"),
                 "qty" => $cantidad-1
             ));
         }
         return redirect()->back()->withInput();
        // return redirect()->route('panel_carrito');
     }
     protected $productoModel;

    
     public function sumar_carrito()
     {
        $this->productoModel = new productosModel(); // Inicializa el modelov
         $rowid = $this->request->getGet('id'); // Obtener el ID del producto en el carrito
         $carrito = \Config\Services::cart();
         $item = $carrito->getItem($rowid);
     
         if ($item) {
             // Obtener stock real desde la base de datos
             $producto = $this->productoModel->find($item['id']);
             $stockDisponible = $producto['stock'];
     
             // Verificar si aún se puede agregar más cantidad
             if ($item['qty'] < $stockDisponible) {
                 $carrito->update([
                     'rowid' => $rowid,
                     'qty'   => $item['qty'] + 1
                 ]);
             } else {
                 // Guardar mensaje de error en sesión para mostrarlo en la vista
                 session()->setFlashdata('error', 'No puedes agregar más cantidad. Stock máximo alcanzado.');
             }
         }
     
         return redirect()->to(base_url('carrito')); // Redirige de nuevo al carrito
     }
     
     public function agregarCarrito(){
        $cart = \Config\Services::cart();
        $productos= $cart->contents();
        $request=\Config\Services::request();

        $montoTotal= 0;

        foreach($productos as $producto){
            $montoTotal+= $producto['price'] * $producto['qty'];
        }

        $ventaCabecera= new VentasHeadModel();
        $idCabecera= $ventaCabecera->insert([
            "total_venta"=> $montoTotal,
            "usuario_id"=> session()->id
           
        ]);
        $ventaDetalle= new VentasModel();
        $productoModel= new productosModel();

        foreach($producotos as $producto){

            $ventaDetalle->insert([
                "venta_id" => $ventaCabecera,
                "producto_id" => $producto["id"],
                "stock"=> $producto["qty"],
                "precio"=> $producto['price']
            ]);
            $productoModel->update($producto["id"],["stock"=> $producto["stock"] - $producto["qty"]]);
        }
        return redirect()->back()->withInput();
     }

}