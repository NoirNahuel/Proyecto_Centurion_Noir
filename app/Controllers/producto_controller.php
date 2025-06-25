<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\productosModel;
use App\Models\CategoriaModel;


class producto_controller extends Controller{
    public function new(){
      
        $producto= new productosModel();
        $categoria= new CategoriaModel();
        $data['categorias']= $categoria->getCategorias();
        $data['titulo'] = 'Subir Producto ';
        
      
        echo view('contenido/Gestion_productos/alta_producto_view',$data);
   
    
    }
    public function index()
    {
        helper(['form']);
        $productoModel = new productosModel();
    
        // Capturar las fechas desde el formulario (GET)
        $fecha_desde = $this->request->getGet('fecha_desde');
        $fecha_hasta = $this->request->getGet('fecha_hasta');
    
        // Aplicar el filtro según las fechas ingresadas
        if (!empty($fecha_desde) && !empty($fecha_hasta)) {
            $productos = $productoModel->obtenerProductosPorRangoFechas($fecha_desde, $fecha_hasta);
        } elseif (!empty($fecha_desde)) {
            $productos = $productoModel->obtenerProductosPorFechaDesde($fecha_desde);
        } else {
            $productos = $productoModel->paginate(5);
        }
    
        // Obtener categorías
        $categoriaModel = new productosModel();
        $categorias = $categoriaModel->categorias();
    
        // Crear un mapa de categorías
        $categoriaMap = [];
        foreach ($categorias as $categoria) {
            $categoriaMap[$categoria['id_categoria']] = $categoria['cate'];
        }
    
        // Datos para la vista
        $data = [
            'producto' => $productos,
            'paginador' => $productoModel->pager,
            
            'categoriaMap' => $categoriaMap,
            'fecha_desde' => $fecha_desde,
            'fecha_hasta' => $fecha_hasta
        ];
    
        $data['titulo'] = 'Crud Producto';
    
       
        echo view('contenido/Gestion_productos/gestion_producto', $data);
      
    }
    

   
   public function baja()
{
    helper(['form']);
    $productoModel = new productosModel();
    $categoriaModel = new productosModel();

    $categorias = $categoriaModel->categorias();

    // Crear un mapa de categorías
    $categoriaMap = [];
    foreach ($categorias as $categoria) {
        $categoriaMap[$categoria['id_categoria']] = $categoria['cate'];
    }

    $data = [
        'titulo' => 'Baja Producto',
        'producto' => $productoModel->where('estado', 0)->paginate(5),
        'categoriaMap' => $categoriaMap,
        'paginador' => $productoModel->pager
    ];

    echo view('contenido/Gestion_productos/eliminar_producto', $data);
}


    public function store(){
        helper(['form']);
        $productoModel = new productosModel();
      
       
   
    $validation=$this->validate([
        'nombre_producto'=>[
            'label'  => 'nombre_producto',
            'rules'  => 'required|min_length[2]|max_length[255]',
            'errors' => [
                'required'   => 'Introduzca nombre del producto.',
                'min_length' => ' Debe tener menos de {param} caracteres.',
                'max_length' => 'el nombre de producto debe tener más de {param} caracteres.'
            ]
        ],
        'id_categoria'=>[
            'label'  => 'id_categoria',
            'rules'  => 'required|is_not_unique[categoria.id_categoria]',
            'errors' => [
                'required'   => 'Seleccione {field}.'
              
            ]
        ],
        'precio'=>
        [
            'label'  => 'precio',
            'rules'  => 'required|min_length[4]|max_length[30]',
            'errors' => [
                'required'    => 'Introduzca {field}.',
                'min_length'  => 'El {field} debe tener más de {param} caracteres.',
                'max_length'  => 'El {field} debe tener menos de {param} caracteres.',
              
                
            ]
        ],
        'descripcion_producto'=>[
            'label'  => 'descripcion',
            'rules'  => 'required|min_length[4]|max_length[255]',
            'errors' => [
                'required'   => 'Introduzca {field}.',
                'min_length' => 'La {field} debe tener más de {param} caracteres.',
                'max_length' => 'La {field} debe tener menos de {param} caracteres.'
            ]
        ],
        'imagen' => 
        [
            'label'  => 'Imagen',
            'rules'  => 'is_image[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png,image/webp,image/ico]',
            'errors' => [
                
                 'is_image'=>'formato de imagen incorrecto'
            ]
        ]
        ,
        'stock' => 
        [
            'label'  => 'Stock',
            'rules'  => 'required',
            'errors' => [
                'required' => 'Introduzca stock de producto.',
            ]
        ]
        ,
            'stock_min' => 
            [
                'label'  => 'Stock minimo',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Introduzca stock minimo de producto.',
                ]
            ]
        
        ])  
        ;

    if (!$validation) {

     
        session()->setFlashdata('msg', '¡Datos no válidos!');
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
 
    } else {

        if (!$this->request->getFile('imagen')->isValid()) {
            // El usuario no ha seleccionado un archivo de imagen válido
            session()->setFlashdata('mensaje', '¡Imagen no valida!');
            return redirect()->to(base_url('/alta_productos'));
        }
                $imagen=$this->request->getFile('imagen');
                $random_name = $imagen->getRandomName();
                $imagen->move(ROOTPATH.'assets/uploads', $random_name);
                

                $data=[
                    'nombre_producto'=>$this->request->getPost('nombre_producto'),
                    'id_categoria'=>$this->request->getPost('id_categoria'),
                    'descripcion_producto'=>$this->request->getPost('descripcion_producto'),
                    'precio'=>$this->request->getPost('precio'),
                    'imagen'=>$random_name,
                    'stock'=>$this->request->getPost('stock'),
                    'stock_min'=>$this->request->getVar('stock_min'),
                    'estado' => 1
  
                ];
                $productoModel->insert($data);
                session()->setFlashdata('mensaje', 'El producto se ha registrado!');
                return redirect()->to(site_url('alta_productos'));
        
    }}
    public function delete($id = 0) {
        $formModel = new productosModel();
        $producto = $formModel->where('idProducto', $id)->first();

        if ($producto['estado'] == 1) {
            $eliminado = ['estado' => 0];
        } else {
            $eliminado = ['estado' => 1];
        }        

        $formModel->update($id, $eliminado);

        return redirect()->to('/productosadmin');
    }
    
    public function cambiarEstado($id = 0) {
        $formModel = new productosModel();
        $producto = $formModel->where('idProducto', $id)->first();

        if ($producto['estado'] == 0) {
            $change = ['estado' => 1];
        }     

        $formModel->update($id, $change);

        return redirect()->to('/productos_eliminados');
    }
    public function buscarDesdeHasta()
{
    helper(['form']);
    $productoModel = new productosModel();
    
    // Capturar las fechas desde el formulario (GET)
    $fecha_desde = $this->request->getGet('fecha_desde');
    $fecha_hasta = $this->request->getGet('fecha_hasta');

    // Aplicar el filtro según las fechas ingresadas
    if (!empty($fecha_desde) && !empty($fecha_hasta)) {
        $productos = $productoModel->obtenerProductosPorRangoFechas($fecha_desde, $fecha_hasta);
    } elseif (!empty($fecha_desde)) {
        $productos = $productoModel->obtenerProductosPorFechaDesde($fecha_desde);
    } else {
        $productos = $productoModel->paginate(5); // Paginación por defecto si no hay filtro de fechas
    }
    
    // Obtener categorías
    $categoriaModel = new productosModel();
    $categorias = $categoriaModel->categorias();
    
    // Crear un mapa de categorías
    $categoriaMap = [];
    foreach ($categorias as $categoria) {
        $categoriaMap[$categoria['id_categoria']] = $categoria['cate'];
    }
    
    // Datos para la vista
    $data = [
        'producto' => $productos,
        'paginador' => $productoModel->pager,
        'categoriaMap' => $categoriaMap,
        'fecha_desde' => $fecha_desde,
        'fecha_hasta' => $fecha_hasta
    ];
    
    $data['titulo'] = 'Buscar Producto por Fecha';
   
    echo view('contenido/Gestion_productos/gestion_producto', $data);
 
}

    public function buscars()
{
    $productModel = new productosModel();
    $categoriaModel = new CategoriaModel();
    $search = $this->request->getPost('search'); // Obtiene el término de búsqueda
    $categoriaP = new productosModel();
    
    $categorias = $categoriaP->categorias();

    // Crear un mapa de perfiles para acceder fácilmente por id_perfil
    $categoriaMap = [];
    foreach ($categorias as $categoria) {
        $categoriaMap[$categoria['id_categoria']] = $categoria['cate'];
    }

    if (!empty($search)) {
        $paginateData = $productModel
            ->like('nombre_producto', $search)
            ->orLike('idProducto', $search)
            ->paginate(5);

        // Si no se encuentran productos, mostrar un mensaje
        if (empty($paginateData) || count($paginateData) === 0) {
            session()->setFlashdata('mensaje', 'No se encontraron productos con ese nombre.');
        }
    } else {
        $paginateData = $productModel->paginate(5);
    }

    $data = [
        'producto' => $paginateData,
        'paginador' => $productModel->pager,
        'categorias' => $categoriaModel->getCategorias(),
        'categoriaMap' => $categoriaMap,
        'search' => $search
    ];

    $data['titulo'] = 'Gestión Productos de Baja';

        echo view('contenido/Gestion_productos/eliminar_producto', $data);
    }

   

public function buscar(){
    $search = $this->request->getPost('search');
    $productModel = new productosModel();
    $categoriaModel = new CategoriaModel();
    $categoriaP = new productosModel();
    
    $categorias = $categoriaP->categorias();

    // Crear un mapa de perfiles para acceder fácilmente por id_perfil
    $categoriaMap = [];
    foreach ($categorias as $categoria) {
        $categoriaMap[$categoria['id_categoria']] = $categoria['cate'];
    }
    if ($search) {
        $resultados =  $productModel
            ->orLike('idProducto', $search)
            ->orLike('nombre_producto', $search)
            ->orLike('id_categoria', $search)
            ->orLike('estado', $search)
             ->orLike('fecha_modificacion', $search)
            ->paginate(5);
    } else {
        $resultados =  $productModel->paginate(5);
    }

    // Si no es AJAX, cargás la vista completa
    $data = [
    'producto' => $resultados,
    'search' => $search,
    'categoriaMap' => $categoriaMap
];
 return view('contenido/Gestion_productos/productos_filas', $data);

}
    
    public function editar_producto($id){
        $productoModel = new productosModel();
        $producto = $productoModel->find($id);
        $categoria= new CategoriaModel();
        $data['categorias']= $categoria->getCategorias();
         // Pasa los datos del producto a la vista correspondiente
         $data['titulo'] = 'Modificar Producto ';
        $data['producto'] = $producto;
        

        // Carga la vista y muestra el producto
    
        echo view('contenido/Gestion_productos/modificar_producto', $data);
     
    }
    public function editar($id)
    {
        $productModel = new productosModel();
        $producto = $productModel->find($id);
        $imagenActual = $producto['imagen'];
        $img_flag=false;
        $validation=$this->validate([
            'nombre_producto'=>[
                'label'  => 'nombre_producto',
                'rules'  => 'required|min_length[2]|max_length[255]',
                'errors' => [
                    'required'   => 'Introduzca nombre del producto.',
                    'min_length' => ' Debe tener menos de {param} caracteres.',
                    'max_length' => 'el nombre de producto debe tener más de {param} caracteres.'
                ]
            ],
            'id_categoria'=>[
                'label'  => 'id_categoria',
                'rules'  => 'required|is_not_unique[categoria.id_categoria]',
                'errors' => [
                    'required'   => 'Seleccione {field}.'
                  
                ]
            ],
            'precio'=>
            [
                'label'  => 'precio',
                'rules'  => 'required|min_length[4]|max_length[30]',
                'errors' => [
                    'required'    => 'Introduzca {field}.',
                    'min_length'  => 'El {field} debe tener más de {param} caracteres.',
                    'max_length'  => 'El {field} debe tener menos de {param} caracteres.',
                  
                    
                ]
            ],
            'descripcion_producto'=>[
                'label'  => 'descripcion_producto',
                'rules'  => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required'   => 'Introduzca {field}.',
                    'min_length' => 'La {field} debe tener más de {param} caracteres.',
                    'max_length' => 'La {field} debe tener menos de {param} caracteres.'
                ]
            ],
            'imagen' => 
            [
                'label'  => 'Imagen',
                'rules'  => 'is_image[imagen]|mime_in[imagen,image/jpg,image/jpeg,image/png,image/webp,image/ico]',
                'errors' => [
                    
                     'is_image'=>'formato de imagen incorrecto'
                ]
            ]
            ,
            'stock' => 
            [
                'label'  => 'Stock',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Introduzca stock de producto.',
                ]
            ]
            ,
            'stock_min' => 
            [
                'label'  => 'Stock minimo',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Introduzca stock minimo de producto.',
                ]
            ]
            
            ])  
            ;
        
     

       
    if (!$validation) {
   
        session()->setFlashdata('msg', '¡Datos no válidos!');
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
 
    } 

        // Verificar si se ha proporcionado una nueva imagen
        if ($this->request->getFile('imagen')->isValid()) {
            // Agregar reglas de validación específicas para la imagen
            $validationRules['imagen'] = 'is_image[imagen]|mime_in[imagen,image/jpeg,image/png,image/webp,image/x-icon]';

            if (!$validation)  {
                // El usuario ha seleccionado un archivo de imagen, pero no es válido
                session()->setFlashdata('msg', '¡Imagen no válida!');
                return redirect()->to(base_url('/productos'));
            }else{
               
                    // Cargar y mover la nueva imagen
            $img = $this->request->getFile('imagen');
            $randomName = $img->getRandomName();
            $img->move(ROOTPATH.'assets/uploads', $randomName);
    
            // Actualizar el campo 'img' en el array $data
            $data['imagen'] = $randomName;
          
            $productModel->update($id, ['imagen' =>$randomName]);
            // Eliminar la imagen antigua
            if ($imagenActual) {
                $rutaImagenAntigua = ROOTPATH.'assets/uploads/'.$imagenActual;
                if (file_exists($rutaImagenAntigua)) {
                    unlink($rutaImagenAntigua);
                }
            }
            }
        }
        
    
        $data=[
            'nombre_producto'=>$this->request->getPost('nombre_producto'),
            'id_categoria'=>$this->request->getPost('id_categoria'),
            'descripcion_producto'=>$this->request->getPost('descripcion_producto'),
            'precio'=>$this->request->getPost('precio'),
             
            'stock'=>$this->request->getPost('stock'),
            'stock_min' => $this->request->getVar('stock_min'),
            'estado' => 1,
            'fecha_modificacion' => date('Y-m-d H:i:s')
           

        ];
        $productModel->update($id,$data);
        session()->setFlashdata('mensaje', 'El producto se ha modificado!');
        return redirect()->to(base_url('/productosadmin'));
  
        

      
    }
    public function catalogo()
    {
        helper(['form','url','cart']);
       
        $productModel= new productosModel();
        $categoriasmodel= new CategoriaModel();
        $session=session();
        
        $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $contadorCart = [
            'cartTotal' => count($cart->contents()),
        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_categoria'])) {
            $search = $_POST['id_categoria'];
            
         $paginateData = $productModel->select('*')
          ->orLike('id_categoria', $search)
          ->paginate(6);
          $data = [
            'producto' => $paginateData,
            'paginador' => $productModel->pager,
            'search' => $search, // Agregar el campo 'search' al array $data con el valor recibido
        ];
        } else {            
            $paginateData = $productModel->paginate(6);
            $data = [
                'producto' => $paginateData,
                'paginador' => $productModel->pager,
                
             ];
        }
  
       
        // Recupera todos los productos desde el modelo
      //  $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos
        $data['categorias']=$categoriasmodel->getCategorias();
        $datos = [
           // 'cartTotal' => count($cart->contents()),
            'categorias' => $categoriasmodel->getCategorias(),
            'titulo' => 'Nuestros Productos'
        ];
        
        echo view('plantillas/head', $datos);
        echo view('plantillas/nav', $contadorCart);
        echo view('contenido/producto', $data);
        echo view('plantillas/footer');
                    
   
     
 }

public function buscar_catalogo()
    {
        helper(['form','url','cart']);
          $cart =\Config\Services::cart();
         $contadorCart=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        $categoriasmodel= new CategoriaModel();
        $productModel = new productosModel();
        $session=session();
        $search = '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $search = $_POST['search'];
         $paginateData = $productModel->select('*')
          ->orLike('nombre_producto', $search)
          ->orLike('idProducto', $search)
          ->paginate(4);
        } else {
            
            $paginateData = $productModel->paginate(4);
                
        }
        
        $data = [
            'producto' => $paginateData,
            'paginador' => $productModel->pager,
            'search' => $search,
            'categorias'=> $categoriasmodel->getCategorias()
         ];

   
    $datos['titulo']='Productos';

   
        echo view('plantillas/head', $datos);
        echo view('plantillas/nav', $contadorCart);
          echo view('contenido/producto', $data);
        echo view('plantillas/footer');
    } 
   
                    
   
     
 
    
}