<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ConsultaModel;
use App\Models\UsersModel;


class consulta_controller extends BaseController{
 
   public function validarmensaje()
{
    helper(['form', 'log']);
    $request = \Config\Services::request();
    $id_usuario = session()->get('id_usuario');

    // 1. Definir las reglas de validación condicionalmente
    if (!$id_usuario) {
        // Visitante: validar nombre y email
        $validacion = [
            'nombre' => [
                'label'  => 'nombre',
                'rules'  => 'required|min_length[2]|max_length[50]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'Su {field} debe tener menos de {param} caracteres.',
                    'max_length' => 'Su {field} debe tener más de {param} caracteres.'
                ]
            ],
            'email' => [
                'label'  => 'correo electrónico',
                'rules'  => 'required|min_length[4]|max_length[30]|valid_email',
                'errors' => [
                    'required'    => 'Introduzca su {field}.',
                    'min_length'  => 'Su {field} debe tener más de {param} caracteres.',
                    'max_length'  => 'Su {field} debe tener menos de {param} caracteres.',
                    'valid_email' => 'El correo electrónico ({value}) no es válido.',
                ]
            ],
            'mensaje' => [
                'label'  => 'mensaje',
                'rules'  => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required'   => 'Introduzca {field}.',
                    'min_length' => 'La {field} debe tener más de {param} caracteres.',
                    'max_length' => 'La {field} debe tener menos de {param} caracteres.'
                ]
            ],
        ];
    } else {
        // Cliente registrado: solo validar mensaje
        $validacion = [
            'mensaje' => [
                'label'  => 'mensaje',
                'rules'  => 'required|min_length[4]|max_length[255]',
                'errors' => [
                    'required'   => 'Introduzca {field}.',
                    'min_length' => 'La {field} debe tener más de {param} caracteres.',
                    'max_length' => 'La {field} debe tener menos de {param} caracteres.'
                ]
            ],
        ];
    }

    // 2. Ejecutar validación
    if (!$this->validate($validacion)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->listErrors());
    } else {
        $consultaModel = new \App\Models\ConsultaModel();

        // 3. Armar los datos a guardar
        if ($id_usuario) {
            // Datos desde la sesión del cliente
            $nombre = session('nombre') . ' ' . session('apellido');
            $email = session('email');
        } else {
            // Datos desde el formulario del visitante
            $nombre = $request->getPost('nombre');
            $email  = $request->getPost('email');
        }

        $data = [
            'nombre'         => $nombre,
            'email'          => $email,
            'mensaje'        => $request->getPost('mensaje'),
            'fecha_consulta' => date('Y-m-d H:i:s'),
        ];

        // Si es cliente logueado, guardar el id_usuario
        if ($id_usuario) {
            $data['id_usuario'] = $id_usuario;
        }

        $consultaModel->save($data);

        // Registrar log
        $tipo_origen = $id_usuario ? 'usuario' : 'visitante';
        $detalle = "$nombre ($email) envió una consulta. Mensaje: " . substr(strip_tags($data['mensaje']), 0, 100) . "...";
        registrar_log($id_usuario, 'Consulta enviada', $detalle, $tipo_origen);

        return redirect()->to(base_url('/contacto'))->with('mensaje', 'Su consulta ha sido enviada con éxito!');
    }
}


    
    public function consultas()
    {
        helper(['form']);
        $consultaModel = new ConsultaModel();
        
        // Capturar fechas desde el formulario (GET)
        $fecha_desde = $this->request->getGet('fecha_desde');
        $fecha_hasta = $this->request->getGet('fecha_hasta');
    
        // Verificar si hay filtros de fecha
        if (!empty($fecha_desde) && !empty($fecha_hasta)) {
            $consultas = $consultaModel->where('fecha_consulta >=', $fecha_desde)
                                       ->where('fecha_consulta <=', $fecha_hasta)
                                       ->paginate(5);
        } elseif (!empty($fecha_desde)) {
            $consultas = $consultaModel->where('fecha_consulta >=', $fecha_desde)->paginate(5);
        } else {
            $consultas = $consultaModel->paginate(5);
        }
                $consultaModel = new ConsultaModel();

            // Obtener datos paginados con join
            $consultas = $consultaModel->obtenerConsultasConUsuarioPaginadas(10);

            $data = [
                'consultas'     => $consultas,
                'paginador'     => $consultaModel->pager,
                'fecha_desde'   => $fecha_desde,
                'fecha_hasta'   => $fecha_hasta,
                'titulo'        => 'Consultas de Clientes',
            ];

            echo view('contenido/Gestion_consulta/consultas', $data);

    
    }
     public function ajaxLista()
    {
        helper(['form']);
        $consultaModel = new ConsultaModel();
        
        // Capturar fechas desde el formulario (GET)
        $fecha_desde = $this->request->getGet('fecha_desde');
        $fecha_hasta = $this->request->getGet('fecha_hasta');
    
        // Verificar si hay filtros de fecha
        if (!empty($fecha_desde) && !empty($fecha_hasta)) {
            $consultas = $consultaModel->where('fecha_consulta >=', $fecha_desde)
                                       ->where('fecha_consulta <=', $fecha_hasta)
                                       ->paginate(5);
        } elseif (!empty($fecha_desde)) {
            $consultas = $consultaModel->where('fecha_consulta >=', $fecha_desde)->paginate(5);
        } else {
            $consultas = $consultaModel->paginate(5);
        }
       return $this->response->setJSON($consultas,$consultaModel->pager,$fecha_desde,$fecha_hasta);
       
    }
    
    public function consultas_respuestas()
{
    helper(['form']);
    $consultaModel = new ConsultaModel();
    
    // Capturar fechas desde el formulario (GET)
    $fecha_desde = $this->request->getGet('fecha_desde');
    $fecha_hasta = $this->request->getGet('fecha_hasta');

    // Verificar si hay filtros de fecha
    if (!empty($fecha_desde) && !empty($fecha_hasta)) {
        $consultas = $consultaModel->where('fecha_respuesta >=', $fecha_desde)
                                   ->where('fecha_respuesta <=', $fecha_hasta)
                                   ->paginate(5);
    } elseif (!empty($fecha_desde)) {
        $consultas = $consultaModel->where('fecha_respuesta >=', $fecha_desde)->paginate(5);
    } else {
        $consultas = $consultaModel->paginate(5);
    }

    $data = [
        'consultas' => $consultas,
        'paginador' => $consultaModel->pager,
        'fecha_desde' => $fecha_desde,
        'fecha_hasta' => $fecha_hasta
    ];

    $data['titulo'] = 'Tienda MateCamp Consultas';

    echo view('contenido/Gestion_consulta/consultas_respuestas', $data);
 
}


    public function respuestas($id){

        $consultaModel = new consultaModel();
        $consulta = $consultaModel->find($id);

        $data['titulo'] = 'Tienda MateCamp - Respuestas';
        $data['consulta']=$consulta;
        helper(['form']);
       
        echo view('contenido/Gestion_consulta/respuestas', $data);

    }
    
public function buscar()
{
    $consultaModel = new ConsultaModel();
    $search = $this->request->getPost('search');

    if ($search) {
        $resultados = $consultaModel
            ->orLike('id_consulta', $search)
            ->orLike('nombre', $search)
            ->orLike('email', $search)
            ->orLike('fecha_consulta', $search)
             ->paginate(5);
    } else {
        $resultados = $consultaModel->paginate(5);
    }

    // Si es una petición AJAX, devolvés solo las filas
    if ($this->request->isAJAX()) {
        return view('contenido/Gestion_consulta/consultas_filas', ['consultas' => $resultados]);
    }

    // Si no es AJAX, cargás la vista completa
    $data = [
        'consultas' => $resultados,
        'search' => $search,
         'paginador' => $consultaModel->pager,
        'titulo' => 'Tienda MateCamp Consultas'
    ];
    return view('contenido/Gestion_consulta/consultas_filas', ['consultas' => $resultados]);
}

    public function store()
    {
        helper(['form']);
   
           
   
        // Validación de datos (puedes personalizar las reglas según tus necesidades)
        $rules = [
            'asunto'=>  'required|min_length[2]',
            'mail'=>  'required|min_length[2]',
            'mensaje' => 'required|min_length[2]',
        
        
        ];
    
        if ($this->validate($rules)) {
            // Crea una instancia del modelo de consulta
            $consultaModel = new ConsultaModel();
    
            // Define los datos de la consulta a guardar
            $data = [
                'asunto' =>  $this->request->getVar('asunto'),
                'mail' =>  $this->request->getVar('mail'),
                'descripcion' => $this->request->getVar('mensaje'),
                'fecha_consulta' => date('Y-m-d'),
            ];
    
            // Guarda la consulta en la base de datos
            $consultaModel->save($data);
    
            // Redirecciona a la página de éxito o muestra un mensaje de confirmación
            return redirect()->to(base_url('/contacto'));
        } else {
                session()->setFlashdata('msg', '¡Datos no válidos!');
                return redirect()->to(base_url('/contacto'));
            }  
    }

public function respuesta($id){
$email = \Config\Services::email();
$consultaModel = new ConsultaModel();
$consulta = $consultaModel->find($id);

if($this->request->getVar('test_mailtrap')){
    
//modo mailtrap
$data = [
    'destinatario' => $this->request->getVar('email'),
    'nombre' => $this->request->getVar('nombre'),
    'descripcion' =>$this->request->getVar('descripcion'),
    'respuesta' => $this->request->getVar('respuesta'),
] ;
// Configurar los parámetros del correo

$email->setFrom('esteban.cent95@gmail.com', 'Centro de ayuda de MateCamp');
$email->setTo($data['destinatario']);

$email->setMessage( view('email_detail.php',$data));
// Enviar el correo
if ($email->send()) {
    //guardar tiempo cuando se respondio
    $consultaModel->update($id, ['fecha_respuesta'=> date('Y-m-d H:i:s')]);
    $consultaModel->update($id, ['respuesta'=> $data['respuesta']]);
    session()->setFlashdata('msg', 'Respuesta Enviada');
    return redirect()->to(site_url('/consultas'));
} else {
    session()->setFlashdata('msg', 'correo no enviado');   
    return redirect()->to(site_url('/consultas'));

}
}else{
    $data = [
        'fecha' => date('Y-m-d H:i:s'),
        'respuesta' => $this->request->getVar('respuesta'),
    ] ;
//modo sin mailtrap
$consultaModel->update($id, ['fecha_respuesta'=> date('Y-m-d H:i:s')]);
$consultaModel->update($id, ['respuesta'=> $data['respuesta']]);
session()->setFlashdata('msg', 'Respuesta Enviada');
return redirect()->to(site_url('/consultas'));
}

}

public function marcarComoLeida()
{
    if ($this->request->isAJAX()) {
        $id = $this->request->getPost('id_consulta');

        if (!$id) {
            return $this->response->setJSON(['success' => false, 'error' => 'ID no recibido']);
        }

        $modelo = new \App\Models\ConsultaModel();
        $consulta = $modelo->find($id);

        if (!$consulta) {
            return $this->response->setJSON(['success' => false, 'error' => 'Consulta no encontrada']);
        }

        $updated = $modelo->update($id, ['leida' => 1]);

        return $this->response->setJSON(['success' => (bool)$updated]);
    }

    return $this->response->setStatusCode(400)->setJSON(['success' => false, 'error' => 'Solicitud inválida']);
}
}