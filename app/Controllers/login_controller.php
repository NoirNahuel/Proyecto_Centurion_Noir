<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\LoginModel;
use App\Models\productosModel;
use App\Models\CategoriaModel;
use App\Models\VentasHeadModel;
use App\Models\VentasModel;
use App\Models\PersonaModel;

class login_controller extends BaseController {
    
      public function usuarios()
        {
        helper(['form']);
        $userModel = new UsersModel();
    
        // Configurar la paginación
        $users = $userModel->paginate(5);
        $perfiles = $userModel->perfilUsuario();
    
        // Crear un mapa de perfiles para acceder fácilmente por id_perfil
        $perfilMap = [];
        foreach ($perfiles as $perfil) {
            $perfilMap[$perfil['id_perfil']] = $perfil['descripcion'];
        }
       
        $data = [
            'users' => $users,
            'paginador' => $userModel->pager,
            'perfilMap' => $perfilMap // Enviar el mapa de perfiles a la vista
        ];
       $data['titulo'] = 'Usuarios';

          echo view('contenido/Gestion_usuarios/listarUsuarios', $data);
     
    }
   /**  */ public function usuarioss()
    {
        helper(['form']);
        $userModel = new UsersModel();
    
        // Configurar la paginación
        $users = $userModel->paginate(5);
        $perfiles = $userModel->perfilUsuario();
    
        // Crear un mapa de perfiles para acceder fácilmente por id_perfil
        $perfilMap = [];
        foreach ($perfiles as $perfil) {
            $perfilMap[$perfil['id_perfil']] = $perfil['descripcion'];
        }
    
        $data = [
            'users' => $users,
            'paginador' => $userModel->pager,
            'perfilMap' => $perfilMap // Enviar el mapa de perfiles a la vista
        ];
    
        $dato['titulo'] = 'Usuarios';
        echo view('plantillas/head', $dato);
        echo view('plantillas/nav');
        echo view('contenido/Gestion_usuarios/listarUsuarios', $data);
        echo view('plantillas/footer');
    }
    public function buscarUsuario()
{
    $userModel = new UsersModel();
    $search = $this->request->getPost('search'); // Obtiene el término de búsqueda
    $perfiles = $userModel->perfilUsuario();

    // Crear un mapa de perfiles para acceder fácilmente por id_perfil
    $perfilMap = [];
    foreach ($perfiles as $perfil) {
        $perfilMap[$perfil['id_perfil']] = $perfil['descripcion'];
    }

    if (!empty($search)) {
        $paginateData = $userModel
            ->like('nombre', $search)
            ->orLike('apellido', $search)
            ->orLike('email', $search)
            ->orLike('id_usuario', $search)
            ->paginate(5);

        // Si no se encuentran usuarios, mostrar un mensaje
        if (empty($paginateData) || count($paginateData) === 0) {
            session()->setFlashdata('mensaje', 'No se encontraron usuarios con esos datos.');
        }
    } else {
        $paginateData = $userModel->paginate(5);
    }

    $data = [
        'users' => $paginateData,
        'paginador' => $userModel->pager,
        'perfilMap' => $perfilMap,
        'search' => $search
    ];

    $data['titulo'] = 'Gestión de Usuarios';

    echo view('contenido/Gestion_usuarios/listarUsuarios', $data);

}
public function buscar()
{
    $usersModel = new UsersModel();
    $search = $this->request->getPost('search');

    // Obtener perfiles de usuario
    $perfiles = $usersModel->perfilUsuario();
    $perfilMap = [];

    foreach ($perfiles as $perfil) {
        $perfilMap[$perfil['id_perfil']] = $perfil['descripcion'];
    }

    // Builder para mejor control de la query
    $builder = $usersModel->select('*')->orderBy('id_usuario', 'DESC');

    // Si hay búsqueda, agrupar condiciones
    if (!empty($search)) {
        $builder->groupStart()
            ->orLike('id_usuario', $search)
            ->orLike('nombre', $search)
            ->orLike('apellido', $search)
            ->orLike('email', $search)
            ->orLike('estado', $search)
            ->orLike('fecha_modificacion', $search)
        ->groupEnd();
    }

    $resultados = $builder->paginate(5);
    $paginador = $usersModel->pager;

    // Si no es AJAX, cargás la vista completa
    $data = [
    'users' => $resultados,
    'search' => $search,
  
    'perfilMap' => $perfilMap
];
 return view('contenido/Gestion_usuarios/usuarios_filas', $data);

}

public function buscarUsuariosPorFechas()
{
    helper(['form']);
    $userModel = new UsersModel();
    
    // Capturar las fechas desde el formulario (GET)
    $fecha_desde = $this->request->getGet('fecha_desde');
    $fecha_hasta = $this->request->getGet('fecha_hasta');
    
    // Aplicar el filtro según las fechas ingresadas
    if (!empty($fecha_desde) && !empty($fecha_hasta)) {
        $users = $userModel->obtenerUsuariosPorRangoFechas($fecha_desde, $fecha_hasta);
    } elseif (!empty($fecha_desde)) {
        $users = $userModel->where('fecha_registro >=', $fecha_desde)->findAll();
    } elseif (!empty($fecha_hasta)) {
        $users = $userModel->where('fecha_registro <=', $fecha_hasta)->findAll();
    } else {
        // Si no se ingresan fechas, mostramos los usuarios paginados por defecto
        $users = $userModel->paginate(5);
    }
    
    // Obtener perfiles
    $perfiles = $userModel->perfilUsuario();
    
    // Crear un mapa de perfiles para acceder fácilmente por id_perfil
    $perfilMap = [];
    foreach ($perfiles as $perfil) {
        $perfilMap[$perfil['id_perfil']] = $perfil['descripcion'];
    }
    
    // Datos para la vista
    $data = [
        'users' => $users,
        'paginador' => $userModel->pager,
        'perfilMap' => $perfilMap, // Enviar el mapa de perfiles a la vista
        'fecha_desde' => $fecha_desde,
        'fecha_hasta' => $fecha_hasta
    ];
    
    $data['titulo'] = 'Usuarios';
  
    echo view('contenido/Gestion_usuarios/listarUsuarios', $data);
   
}

public function index()
	{
		$mensaje = session('mensaje');
        $data['titulo'] = 'Ingresar ';
        echo view('plantillas/head', $data);
        echo view('plantillas/nav');
        echo view('contenido/login', ['mensaje' => $mensaje]);
        echo view('plantillas/footer');
	}
    
    public function loginAuth()
    {   
      
    helper('date'); //cargar el helper 
   // $last_acceso = formatear_fecha(session('ultimo_acceso'));
    //$ultimo_acceso= ['ultimo_acceso' => $last_acceso];


        $validation= $this->validate([
       
            'email'=>
            [
                'label'  => 'correo electrónico',
                'rules'  => 'required|min_length[4]|max_length[30]|valid_email',
                'errors' => [
                    'required'    => 'Introduzca su {field}.',
                    'min_length'  => 'Su {field} debe tener más de {param} caracteres.',
                    'max_length'  => 'Su {field} debe tener menos de {param} caracteres.',
                    'valid_email' => 'El correo electronico ({value}) no es válido.',
                    
                ]
            ],
            'password'=>[
                'label'  => 'contraseña',
                'rules'  => 'required|min_length[4]|max_length[25]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'La {field} debe tener más de {param} caracteres.',
                    'max_length' => 'La {field} debe tener menos de {param} caracteres.'
                ]
            ]
            ]);
            
                if (!$validation){
                        
                            $data['titulo'] = 'Ingresar ';
                            echo view('plantillas/head', $data);
                            echo view('plantillas/nav');
                            echo view('contenido/login', ['validation' => $this->validator]);
                            echo view('plantillas/footer');
                         
                       
                }else{
                                    
                            $userModel = new UsersModel();
                            $post=$this->request->getPost(['email','password']);

                            $user=$userModel->validateUser($post['email'],$post['password']);
                            
                            
                            if($user !==null){
                            
                                $this->setSession($user);
                                   
                                    switch($user['id_perfil']){

                                        case '1':
                                            return redirect()->to(base_url('/dashboard'));
                                            break;
                                            case '2':
                                                $this->refreshSessionData(); // Verifica y actualiza los datos en sesión si es necesario
                                            
                                                $user = [
                                                    'nombre' => $this->session->get('nombre'),
                                                    'apellido' => $this->session->get('apellido'),
                                                    'email' => $this->session->get('email'),
                                                ];
                                            
                                                // Redirige utilizando directamente el valor de la sesión para `id_perfil`
                                                return redirect()->to(base_url('/productos'));
                                            
                                                break; // Asegúrate de romper el flujo del `switch`
   
                                            break;
                                    }
                                
                                }else{
                                return redirect()->to(base_url('/login'))->with('mensaje','El email o contraseña ingresada son incorrectas');
                                }
                            }

    }


   
    private function setSession($userData){
        $session_data = [
            'id_usuario' => $userData['id_usuario'],
            'nombre' => $userData['nombre'],
            'apellido' => $userData['apellido'],
            'email' => $userData['email'],
            'id_perfil' => $userData['id_perfil'],
            'fecha_modificacion'=> $userData['fecha_modificacion'],
            'fecha_registro'=> $userData['fecha_registro'],
            'isLoggedIn' => TRUE
        ];
        session()->set($session_data);

    }

    private function refreshSessionData() {
        $idUsuario = session()->get('id_usuario'); // Accede a la sesión usando la función global
       
            if ($idUsuario) {
                $userModel = new UsersModel(); // Crea una instancia del modelo directamente
                $userData = $userModel->find($idUsuario); // Busca la información actualizada
            }
       
        if ($userData) {
            // Compara la fecha de modificación
            if ($userData['fecha_modificacion'] !== $this->session->get('fecha_modificacion')) {
                // Si la información ha cambiado, actualiza la sesión
                $this->setSession($userData);
            }
        } else {
            // Si el usuario no existe, destruye la sesión (opcional)
            $this->session->destroy();
        }
    }
    
   
    public function logout() {
        $session = session();
        $session->destroy();
   
        return redirect()->to(base_url('login'));
    }
    public function buscara()
{
    $userModel = new UsersModel();
    $search = '';

  
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
            $search = $_POST['search'];
         $paginateData = $userModel->select('*')
          ->orLike('nombre', $search)
          ->orLike('id_usuario', $search)
          ->paginate(5);
        

    }  else {
            
        $paginateData = $userModel->paginate(5);
            
    }
    $data = [
        'users' => $paginateData,
        'paginador' => $userModel->pager,
        'search' => $search
     ];
     $vista= $this->request->getVar('vista');

     $dato['titulo'] = 'Usuarios eliminados ';
     echo view('plantillas/head',$dato);
    echo view('plantillas/nav');
    if($vista=='1'){
        echo view('contenido/Gestion_usuarios/eliminados_users', $data);
    }else{
        echo view('contenido/Gestion_usuarios/usuarios', $data);
    }
  
    echo view('plantillas/footer');
}
    public function baja()
    {
        $userModel = new UsersModel();
        $perfiles = $userModel->perfilUsuario();
    
        // Crear un mapa de perfiles para acceder fácilmente por id_perfil
        $perfilMap = [];
        foreach ($perfiles as $perfil) {
            $perfilMap[$perfil['id_perfil']] = $perfil['descripcion'];
        }
      $data=[ 
            'users' => $userModel->where('estado', 0)->paginate(5), // Muestra solo usuarios con estado 0 y 5 por página
            'perfilMap' => $perfilMap, // Enviar el mapa de perfiles a la vista
            'paginador' => $userModel->pager];

            $data['titulo'] = 'Usuarios eliminados ';
     
        echo view('contenido/Gestion_usuarios/eliminados_users', $data);
      
    }

 
    public function changeBaja($id)
    {
        // Lógica para cambiar el valor de "baja" a "SI" en la base de datos para el usuario con el ID especificado
        $this->userModel = new UsersModel();
        $user = $this->userModel->find($id);
    
        // Verificar si el usuario existe
        if ($user) {
            $baja = $user['estado'];
            if ($baja == 1) {
                // Cambiar a "inactivo" (estado 0)
                $this->userModel->update($id, ['estado' => 0]);
                session()->setFlashdata('mensaje', 'El usuario ha sido desactivado.');
            } else if ($baja == 0) {
                // Cambiar a "activo" (estado 1)
                $this->userModel->update($id, ['estado' => 1]);
                session()->setFlashdata('mensaje', 'El usuario ha sido activado.');
            } else {
                // Otro caso por defecto (si es necesario)
                $this->userModel->update($id, ['estado' => 0]);
                session()->setFlashdata('mensaje', 'El usuario ha sido activado.');
            }
        }
    
        // Redirigir a la página de usuarios con el mensaje
        return redirect()->to('/usuarios');
    }
    
    public function delete($id = 0) {
        $formModel = new UsersModel();
        $user = $formModel->where('id_usuario', $id)->first();

        if ($user['estado'] == 1) {
            $eliminado = ['estado' => 0];
        } else {
            $eliminado = ['estado' => 1];
        }        

        $formModel->update($id, $eliminado);

        return redirect()->to('/usuarios');
    }
  
    public function editar_user($id)
{
    $userModel = new UsersModel();
    $user = $userModel->find($id);
      $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
         $datos = [
            'cartTotal' => count($cart->contents()),
        ];
    $data = [
        'titulo' => 'Modificar Usuario',
        'user'   => $user
    ];
     $datas = [
        'titulo' => 'Modificar Usuario',
    ];
     return view('plantillas/head', $datas).view('plantillas/nav',$datos).view('contenido/Gestion_usuarios/modificar_usuario', $data).view('plantillas/footer');
           
}

    public function editar($id)
    {
    $userModel = new UsersModel();
    $user = $userModel->find($id); // Obtiene el usuario actual

    // Validación general de los campos
    $validation = $this->validate([
        'nombre' => [
            'label'  => 'nombre',
            'rules'  => 'required|min_length[2]|max_length[50]',
            'errors' => [
                'required'   => 'Introduzca su {field}.',
                'min_length' => 'Su {field} debe tener al menos {param} caracteres.',
                'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
            ]
        ],
        'apellido' => [
            'label'  => 'apellido',
            'rules'  => 'required|min_length[2]|max_length[25]',
            'errors' => [
                'required'   => 'Introduzca su {field}.',
                'min_length' => 'Su {field} debe tener al menos {param} caracteres.',
                'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
            ]
        ],
        'email' => [
            'label'  => 'correo electrónico',
            'rules'  => 'required|valid_email|min_length[4]|max_length[30]|is_unique[usuarios.email,id_usuario,' . $id . ']',
            'errors' => [
                'required'    => 'Introduzca su {field}.',
                'valid_email' => 'El correo electrónico no es válido.',
                'is_unique'   => 'El correo electrónico ya está registrado.',
                'min_length'  => 'El correo debe tener al menos {param} caracteres.',
                'max_length'  => 'El correo no debe superar {param} caracteres.'
            ]
        ],
        'password' => [
            'label'  => 'contraseña',
            'rules'  => 'permit_empty|min_length[6]',
            'errors' => [
                'min_length' => 'La {field} debe tener al menos {param} caracteres.',
            ]
        ]
    ]);

    if (!$validation) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Datos actualizados del usuario
    $data = [
        'nombre' => $this->request->getPost('nombre'),
        'apellido' => $this->request->getPost('apellido'),
        'email' => $this->request->getPost('email'),
        'fecha_modificacion' => date('Y-m-d H:i:s')
        
    ];

    // Si se proporciona una nueva contraseña, encriptarla y añadirla
    $password = $this->request->getPost('password');
   
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Depuración
        error_log('Nueva contraseña encriptada: ' . $hashedPassword);
        $data['password'] = $hashedPassword;
    }
    

    // Actualiza el usuario en la base de datos
    $userModel->update($id, $data);
    session()->setFlashdata('mensaje', '¡El usuario se ha modificado correctamente!');
    
    return redirect()->to(base_url('/usuarios'));
}
public function editarUser_cliente($id)
{
$userModel = new UsersModel();
$user = $userModel->find($id); // Obtiene el usuario actual

// Validación general de los campos
$validation = $this->validate([
    'nombre' => [
        'label'  => 'nombre',
        'rules'  => 'required|min_length[2]|max_length[50]',
        'errors' => [
            'required'   => 'Introduzca su {field}.',
            'min_length' => 'Su {field} debe tener al menos {param} caracteres.',
            'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
        ]
    ],
    'apellido' => [
        'label'  => 'apellido',
        'rules'  => 'required|min_length[2]|max_length[25]',
        'errors' => [
            'required'   => 'Introduzca su {field}.',
            'min_length' => 'Su {field} debe tener al menos {param} caracteres.',
            'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
        ]
    ],
    'email' => [
        'label'  => 'correo electrónico',
        'rules'  => 'required|valid_email|min_length[4]|max_length[30]|is_unique[usuarios.email,id_usuario,' . $id . ']',
        'errors' => [
            'required'    => 'Introduzca su {field}.',
            'valid_email' => 'El correo electrónico no es válido.',
            'is_unique'   => 'El correo electrónico ya está registrado.',
            'min_length'  => 'El correo debe tener al menos {param} caracteres.',
            'max_length'  => 'El correo no debe superar {param} caracteres.'
        ]
    ],
    'password' => [
        'label'  => 'contraseña',
        'rules'  => 'permit_empty|min_length[6]',
        'errors' => [
            'min_length' => 'La {field} debe tener al menos {param} caracteres.',
        ]
    ]
]);

if (!$validation) {
    return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
}

// Datos actualizados del usuario
$data = [
    'nombre' => $this->request->getPost('nombre'),
    'apellido' => $this->request->getPost('apellido'),
    'email' => $this->request->getPost('email'),
    'fecha_modificacion' => date('Y-m-d H:i:s')
    
];

// Si se proporciona una nueva contraseña, encriptarla y añadirla
$password = $this->request->getPost('password');

if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    // Depuración
    error_log('Nueva contraseña encriptada: ' . $hashedPassword);
    $data['password'] = $hashedPassword;
}


// Actualiza el usuario en la base de datos
$userModel->update($id, $data);
session()->setFlashdata('mensaje', '¡El usuario se ha modificado correctamente!');

return redirect()->to(base_url('/dashboard_cliente/' . $id));
}
 public function dashboard_cliente($id) {
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
          
            $detalles = $ventasDetalleModel->obtenerDetallesPedido($ultimaVenta['id']);

          
    
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
         $cart =\Config\Services::cart();
         $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos 
      
        $user = [
            'user' => $users,
            'cartTotal' => count($cart->contents())];
        $data['titulo'] = 'Dashboard Cliente | Tienda GuitarN Cent';
    
        // Renderizar las vistas
        echo view('plantillas/head', $data);
        echo view('plantillas/nav',$user);
        echo view('contenido/dashboard_2', $dato);
        echo view('plantillas/footer');
    }
}

