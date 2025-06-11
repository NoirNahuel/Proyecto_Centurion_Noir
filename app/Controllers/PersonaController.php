<?php

namespace App\Controllers;
use App\Models\PersonaModel;
use App\Models\UsersModel;
use CodeIgniter\Controller;

class PersonaController extends Controller
{
    public function formulario()
    {
        $data['titulo'] = 'Datos Adicionales ';
     
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/Persona/formulario').view('plantillas/footer');
    }
    public function formularioCompra()
    {
        $data['titulo'] = 'Datos Adicionales para Compra ';
        $cart =\Config\Services::cart();
    
        $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos
        
        $datos = [
            'cartTotal' => count($cart->contents()),
        ];
        return view('plantillas/head', $data).view('plantillas/nav',$datos).view('contenido/Persona/formularioCompra_user').view('plantillas/footer');
    }

    public function guardarDatos()
    {   
        // Iniciar sesión
    $session = session();
    
    // Verificar si hay un usuario en sesión
    if (!$session->has('id_usuario')) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
    }

    // Obtener el id_usuario de la sesión
    $id_usuario = $session->get('id_usuario');
        // Reglas de validación
        $rules = [
            'direccion'    => 'required|min_length[5]|max_length[100]|regex_match[/^.+\s\d+$/]',
            'telefono'     => 'required|numeric|exact_length[10]',
            'ciudad'       => 'required|alpha_space|max_length[50]',
            'pais'         => 'required|alpha|max_length[50]',
            'dni'          => 'required|numeric|min_length[7]|max_length[8]',
            'codigo_postal'=> 'required|numeric|min_length[4]|max_length[5]'  // Validación para el código postal
        ];
    
        // Mensajes de error personalizados
        $messages = [
            'direccion' => [
                'required'   => 'La dirección es obligatoria.',
                'min_length' => 'La dirección debe tener al menos 5 caracteres.',
                'max_length' => 'La dirección no puede superar los 100 caracteres.',
                'regex_match' => 'La dirección debe contener al menos un número después del nombre de la calle.'
            ],
            'telefono' => [
                'required'    => 'El teléfono es obligatorio.',
                'numeric'     => 'El teléfono solo debe contener números.',
                'exact_length' => 'El teléfono debe tener exactamente 10 dígitos.'
            ],
            'ciudad' => [
                'required'    => 'La ciudad es obligatoria.',
                'alpha_space' => 'La ciudad solo puede contener letras y espacios.',
                'max_length'  => 'La ciudad no puede superar los 50 caracteres.'
            ],
            'pais' => [
                'required' => 'El país es obligatorio.',
                'alpha'    => 'El país solo debe contener letras.',
                'max_length' => 'El país no puede superar los 50 caracteres.'
            ],
            'dni' => [
                'required'   => 'El DNI es obligatorio.',
                'numeric'    => 'El DNI solo debe contener números.',
                'min_length' => 'El DNI debe tener al menos 7 dígitos.',
                'max_length' => 'El DNI no puede superar los 8 dígitos.'
            ],
            'codigo_postal' => [
                'required'    => 'El código postal es obligatorio.',
                'numeric'     => 'El código postal debe contener solo números.',
                'min_length'  => 'El código postal debe tener al menos 4 dígitos.',
                'max_length'  => 'El código postal no puede tener más de 5 dígitos.',
            ],
        ];
    
        // Ejecutar la validación
        if (!$this->validate($rules, $messages)) {
            // Si la validación falla, redirigir con los errores y valores previos del formulario
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
    // Crear un array con los datos a insertar
    $datos = [
        'id_usuario'    => $id_usuario,  // Relacionar con el usuario en sesión
        'direccion'     => $this->request->getPost('direccion'),
        'telefono'      => $this->request->getPost('telefono'),
        'ciudad'        => $this->request->getPost('ciudad'),
        'pais'          => $this->request->getPost('pais'),
        'dni'           => $this->request->getPost('dni'),
        'codigo_postal' => $this->request->getPost('codigo_postal'),
    ];

    // Cargar el modelo y guardar los datos en la base de datos
    $personaModel = new PersonaModel();
    $personaModel->insert($datos);

   
        return redirect()->back()->with('success', 'Datos guardados correctamente.');
    }
    public function guardarDatoscompra()
    {   
        // Iniciar sesión
    $session = session();
    
    // Verificar si hay un usuario en sesión
    if (!$session->has('id_usuario')) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
    }

    // Obtener el id_usuario de la sesión
    $id_usuario = $session->get('id_usuario');
        // Reglas de validación
        $rules = [
            'direccion'    => 'required|min_length[5]|max_length[100]|regex_match[/^.+\s\d+$/]',
            'telefono'     => 'required|numeric|exact_length[10]',
            'ciudad'       => 'required|alpha_space|max_length[50]',
            'pais'         => 'required|alpha|max_length[50]',
            'dni'          => 'required|numeric|min_length[7]|max_length[8]',
            'codigo_postal'=> 'required|numeric|min_length[4]|max_length[5]'  // Validación para el código postal
        ];
    
        // Mensajes de error personalizados
        $messages = [
            'direccion' => [
                'required'   => 'La dirección es obligatoria.',
                'min_length' => 'La dirección debe tener al menos 5 caracteres.',
                'max_length' => 'La dirección no puede superar los 100 caracteres.',
                'regex_match' => 'La dirección debe contener al menos un número después del nombre de la calle.'
            ],
            'telefono' => [
                'required'    => 'El teléfono es obligatorio.',
                'numeric'     => 'El teléfono solo debe contener números.',
                'exact_length' => 'El teléfono debe tener exactamente 10 dígitos.'
            ],
            'ciudad' => [
                'required'    => 'La ciudad es obligatoria.',
                'alpha_space' => 'La ciudad solo puede contener letras y espacios.',
                'max_length'  => 'La ciudad no puede superar los 50 caracteres.'
            ],
            'pais' => [
                'required' => 'El país es obligatorio.',
                'alpha'    => 'El país solo debe contener letras.',
                'max_length' => 'El país no puede superar los 50 caracteres.'
            ],
            'dni' => [
                'required'   => 'El DNI es obligatorio.',
                'numeric'    => 'El DNI solo debe contener números.',
                'min_length' => 'El DNI debe tener al menos 7 dígitos.',
                'max_length' => 'El DNI no puede superar los 8 dígitos.'
            ],
            'codigo_postal' => [
                'required'    => 'El código postal es obligatorio.',
                'numeric'     => 'El código postal debe contener solo números.',
                'min_length'  => 'El código postal debe tener al menos 4 dígitos.',
                'max_length'  => 'El código postal no puede tener más de 5 dígitos.',
            ],
        ];
    
        // Ejecutar la validación
        if (!$this->validate($rules, $messages)) {
            // Si la validación falla, redirigir con los errores y valores previos del formulario
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        
    // Crear un array con los datos a insertar
    $datos = [
        'id_usuario'    => $id_usuario,  // Relacionar con el usuario en sesión
        'direccion'     => $this->request->getPost('direccion'),
        'telefono'      => $this->request->getPost('telefono'),
        'ciudad'        => $this->request->getPost('ciudad'),
        'pais'          => $this->request->getPost('pais'),
        'dni'           => $this->request->getPost('dni'),
        'codigo_postal' => $this->request->getPost('codigo_postal'),
    ];

    // Cargar el modelo y guardar los datos en la base de datos
    $personaModel = new PersonaModel();
    $personaModel->insert($datos);

   
        
        return redirect()->to(base_url('resumen-compra'))->with('success', 'Datos guardados correctamente para su compra.');
    }
    public function verificarDatosUsuario()
{
    $userID = session()->get('id_usuario');
    $personaModel = new PersonaModel();
    
    // Buscar los datos adicionales del usuario
    $datosPersona = $personaModel->where('id_usuario', $userID)->first();

   // if (!$datosPersona) {
        // Si no existen datos adicionales, redirigir a la vista de completar datos
     //   return redirect()->to(base_url('completar-datos-compra'))->with('error', 'Debe completar sus datos antes de confirmar la compra.');
    //}

    // Si los datos están completos, redirigir al resumen de compra
    return redirect()->to(base_url('resumen-compra'));
}
public function editar($idUsuario)
{
    $usuarioModel = new UsersModel();
    $personaModel = new PersonaModel();

    $usuario = $usuarioModel->find($idUsuario);
    $persona = $personaModel->where('id_persona', $usuario['id_usuario'])->first();
    $data['titulo'] = 'Datos Adicionales ';
    $cart =\Config\Services::cart();

    $cartTotal=['cartTotal'=>count($cart->contents())] ; // Obtiene el total de productos
    $datos = [
        'cartTotal' => count($cart->contents()),
    ];
    $dato = [
        'usuario' => $usuario,
        'persona' => $persona
    ];

    return view('plantillas/head', $data).view('plantillas/nav',$datos).view('contenido/Persona/editarDatos',$dato).view('plantillas/footer');
   
}
public function actualizarDatos($id)
{   
    // Iniciar sesión
    $session = session();
    
    // Verificar si hay un usuario en sesión
    if (!$session->has('id_usuario')) {
        return redirect()->to('/login')->with('error', 'Debes iniciar sesión primero.');
    }

    // Obtener el id_usuario de la sesión
    $id_usuario = $session->get('id_usuario');

    // Cargar el modelo
    $personaModel = new PersonaModel();
    
    // Verificar si el registro existe y pertenece al usuario en sesión
    $persona = $personaModel->where('id_persona', $id)->where('id_usuario', $id_usuario)->first();
    
    if (!$persona) {
        return redirect()->back()->with('error', 'No tienes permisos para modificar este registro.');
    }

    // Reglas de validación (igual que en guardarDatos)
    $rules = [
        'direccion'    => 'required|min_length[5]|max_length[100]|regex_match[/^.+\s\d+$/]',
        'telefono'     => 'required|numeric|exact_length[10]',
        'ciudad'       => 'required|alpha_space|max_length[50]',
        'pais'         => 'required|alpha|max_length[50]',
        'dni'          => 'required|numeric|min_length[7]|max_length[8]',
        'codigo_postal'=> 'required|numeric|min_length[4]|max_length[5]'
    ];

    // Mensajes de error (igual que en guardarDatos)
    $messages = [
        'direccion' => [
            'required'   => 'La dirección es obligatoria.',
            'min_length' => 'La dirección debe tener al menos 5 caracteres.',
            'max_length' => 'La dirección no puede superar los 100 caracteres.',
            'regex_match' => 'La dirección debe contener al menos un número después del nombre de la calle.'
        ],
        'telefono' => [
            'required'    => 'El teléfono es obligatorio.',
            'numeric'     => 'El teléfono solo debe contener números.',
            'exact_length' => 'El teléfono debe tener exactamente 10 dígitos.'
        ],
        'ciudad' => [
            'required'    => 'La ciudad es obligatoria.',
            'alpha_space' => 'La ciudad solo puede contener letras y espacios.',
            'max_length'  => 'La ciudad no puede superar los 50 caracteres.'
        ],
        'pais' => [
            'required' => 'El país es obligatorio.',
            'alpha'    => 'El país solo debe contener letras.',
            'max_length' => 'El país no puede superar los 50 caracteres.'
        ],
        'dni' => [
            'required'   => 'El DNI es obligatorio.',
            'numeric'    => 'El DNI solo debe contener números.',
            'min_length' => 'El DNI debe tener al menos 7 dígitos.',
            'max_length' => 'El DNI no puede superar los 8 dígitos.'
        ],
        'codigo_postal' => [
            'required'    => 'El código postal es obligatorio.',
            'numeric'     => 'El código postal debe contener solo números.',
            'min_length'  => 'El código postal debe tener al menos 4 dígitos.',
            'max_length'  => 'El código postal no puede tener más de 5 dígitos.',
        ],
    ];

    // Ejecutar la validación
    if (!$this->validate($rules, $messages)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Crear un array con los datos a actualizar
    $datos = [
        'direccion'     => $this->request->getPost('direccion'),
        'telefono'      => $this->request->getPost('telefono'),
        'ciudad'        => $this->request->getPost('ciudad'),
        'pais'          => $this->request->getPost('pais'),
        'dni'           => $this->request->getPost('dni'),
        'codigo_postal' => $this->request->getPost('codigo_postal'),
    ];

    // Actualizar los datos en la base de datos
    $personaModel->update($id, $datos);

    return redirect()->to(base_url('resumen-compra'))->with('success', 'Datos actualizados correctamente para su compra.');
}


}
