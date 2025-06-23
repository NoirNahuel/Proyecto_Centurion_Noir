<?php

namespace App\Controllers;
use App\Models\consultaModel;
use App\Models\UsersModel;
use App\Models\LogUsuarioModel;
use App\Models\CategoriaModel;
use App\Models\productosModel;
use App\Models\VentasModel;
use CodeIgniter\Cart\Cart;
class Home extends BaseController
{
    public function index(){
         helper(['form','url','cart']);
        $cart =\Config\Services::cart();
        $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos
        $datos = ['cartTotal' => count($cart->contents()),];

        $productModel= new productosModel();
        $categoriasmodel= new CategoriaModel();

        $detalleVentaModel = new VentasModel();
        $topProductos = $detalleVentaModel->obtenerTopProductos();
        $session=session();
       
       
        // Recupera todos los productos desde el modelo
        $dato=['categorias'=>$categoriasmodel->getCategorias(),
        'topProductos' =>$detalleVentaModel->obtenerTopProductos(3),
 ];

        $data['titulo'] = 'Tienda GuitarNCent'; 
        return view('plantillas/head', $data).view('plantillas/nav',$datos).view('principal',$dato).view('plantillas/footer');
    }
     public function ver($categoryId = null)
    {
        $categoryModel = new CategoriaModel();
        $productModel = new productosModel();
       
        // Si se pasa un ID de categoría, mostrar solo esa categoría
        if ($categoryId) {
            $category = $categoryModel->find($categoryId);
            if (!$category) {
                throw new \CodeIgniter\Exceptions\PageNotFoundException('Categoría no encontrada');
            }


            $data['category'] = $category;
            $data['products'] = $productModel->getProductsByCategory($categoryId);
        } else {
            // Si no se pasa un ID, redirigir o mostrar un mensaje
            return redirect()->to('/');
        }
        $data= ['categorias'=>$categoriasmodel->getCategorias(),
                'topProductos' =>$detalleVentaModel->obtenerTopProductos(3),
         ];
        $dato['titulo'] = 'Tienda GuitarNCent';
        return view('plantillas/head', $dato).view('plantillas/nav').view('principal',$data).view('plantillas/footer');
       
    }
    public function quieneSomos(){
         $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $data['titulo'] = 'Quienes Somos';
        return view('plantillas/head', $data).view('plantillas/nav',$datos).view('contenido/quienesSomos').view('plantillas/footer');
    }
    public function acerca_de(){
         $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $data['titulo'] = 'Nosotros';
        return view('plantillas/head', $data).view('plantillas/nav',$datos).view('contenido/acercaDe').view('plantillas/footer');
    }
    public function contacto(){
         $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $data['titulo'] = 'Contactanos';
        return view('plantillas/head', $data).view('plantillas/nav',$datos).view('contenido/contacto').view('plantillas/footer');
    }
    
    public function terminos_usos(){
        $data['titulo'] = 'Terminos y Usos';
         $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        return view('plantillas/head', $data).view('plantillas/nav',$datos).view('contenido/terminosUsos').view('plantillas/footer');
    }
    public function comercializacion(){
         $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $data['titulo'] = 'Comercializacion';
        return view('plantillas/head', $data).view('plantillas/nav',$datos).view('contenido/comercializacion').view('plantillas/footer');
    }
    public function productos($categoria = 'todas'){   
         $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $data['titulo'] = 'Productos - GuitarCN';
        return view('plantillas/head', $data). view('plantillas/nav',$datos).view('contenido/productos', ['categoria' => $categoria]).view('plantillas/footer');
    }
     public function login_user(){
         $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $data['titulo'] = 'Iniciar Sesion';
       return view('plantillas/head', $data).view('plantillas/nav',$datos).view('contenido/login').view('plantillas/footer');
    }
    public function dashboard() 
    {
        $data['titulo'] = 'Panel de Administracion';
        return view('components/dashboard_Admin', $data);
    }
    public function dashboard_2(){
         $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $data['titulo'] = 'Panel del Cliente'; 
        return view('plantillas/head', $data).view('plantillas/nav',$datos).view('contenido/dashboard_2').view('plantillas/footer');
    }
    public function layouts()
    {
    $logModel = new \App\Models\LogUsuarioModel();

    $data['logs'] = $logModel
        ->select('log_usuario.*, usuarios.nombre')
        ->join('usuarios', 'usuarios.id_usuario = log_usuario.id_usuario', 'left')
        ->orderBy('fecha_hora', 'DESC')
        ->limit(5)
        ->findAll();
     $data['titulo'] = 'Panel- GuitarCN';
    return view('layouts', $data);
}
public function cargarMas()
{
    $offset = (int) ($this->request->getGet('offset') ?? 0);

    $model = new \App\Models\LogUsuarioModel();
    $logs = $model->select('log_usuario.*, usuarios.nombre')
                  ->join('usuarios', 'usuarios.id_usuario = log_usuario.id_usuario', 'left')
                  ->orderBy('fecha_hora', 'DESC')
                  ->findAll(30, $offset);

    // Si no hay logs, devolvemos un string vacío
    if (empty($logs)) {
        return $this->response->setJSON([]);
    }

    // Renderizamos la vista parcial para cada log
    $html = '';
    foreach ($logs as $index => $log) {
        // Para no repetir IDs, sumá el offset al index para que el id sea único
        $logIndex = $offset + $index;
        $html .= view('components/notificacion_item', ['log' => $log, 'index' => $logIndex]);
    }

    return $this->response->setJSON(['html' => $html, 'count' => count($logs)]);
}


public function cargarMa()
{
    $offset = $this->request->getGet('offset') ?? 0;
    $limit = 3;

    $logModel = new \App\Models\LogUsuarioModel();

    // Obtener los registros actuales
    $logs = $logModel
        ->select('log_usuario.*, usuarios.nombre')
        ->join('usuarios', 'usuarios.id_usuario = log_usuario.id_usuario', 'left')
        ->orderBy('fecha_hora', 'DESC')
        ->findAll($limit, (int)$offset);

    // Usamos nueva instancia para contar correctamente
    $total = (new \App\Models\LogUsuarioModel())->countAll();
    $hayMas = ($offset + $limit) < $total;

    // Renderizar los logs como HTML
    $html = '';
    foreach ($logs as $index => $log) {
        $html .= view('components/notificacion_item', ['log' => $log, 'index' => $offset + $index]);
    }

    return $this->response->setJSON([
        'html' => $html,
        'hayMas' => $hayMas
    ]);
}







    
}
