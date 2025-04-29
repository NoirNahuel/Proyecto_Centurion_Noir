<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\LoginModel;

class login_controller extends BaseController {
    public function usuarios()
    {
        
        helper(['form']);
        $userModel = new UsersModel();
       
    // Configurar la paginación
    $data=[       
        'users' => $userModel->paginate(10),
        'paginador' => $userModel->pager,
        'users'=> $userModel->perfilUsuario()
        ];
        $dato['titulo'] = 'Usuarios ';
        echo view('plantillas/head',  $dato);
        echo view('plantillas/nav');
        echo view('contenido/Gestion_usuario/listarUsuarios', $data);
        echo view('plantillas/footer');
        
   
     
 }

public function admin(){
    $data['titulo']='Administrador';
    return view('plantillas/head', $data).view('plantillas/nav').view('contenido/dashboard').view('plantillas/footer');
}   

public function AdminDashboard(){
    $data['titulo']='Administrador';
    return view('plantillas/head', $data).view('plantillas/nav').view('contenido/AdminDashboard').view('plantillas/footer');
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
                                            return redirect()->to(base_url('/usuarios'));
                                            break;
                                        case '2':
                                            return redirect()->to(base_url('/'));
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
            'isLoggedIn' => TRUE
        ];
        $this->session->set($session_data);
    }
   
    public function logout() {
        $session = session();
        $session->destroy();
   
        return redirect()->to(base_url('login'));
    }
    public function buscar()
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
            
        $paginateData = $userModel->paginate(10);
            
    }
    
    $data = [
        'users' => $paginateData,
        'paginador' => $userModel->pager,
        'search' => $search,
        'users'=> $userModel->perfilUsuario()

     ];
     $vista= $this->request->getVar('vista');

     $dato['titulo'] = 'Usuarios eliminados ';
     echo view('plantillas/head',$dato);
    echo view('plantillas/nav');
    if($vista=='1'){
        echo view('contenido/Gestion_usuario/eliminados_users', $data);
    }else{
       
        echo view('contenido/Gestion_usuario/listarUsuarios', $data);
    }
  
    echo view('plantillas/footer');
}
    public function baja()
    {
        $userModel = new UsersModel();
      $data=[ 
            'users' => $userModel->paginate(10),
            'paginador' => $userModel->pager];

            $dato['titulo'] = 'Usuarios eliminados ';
        echo view('plantillas/head',$dato);
        echo view('plantillas/nav');
        echo view('contenido/Gestion_usuario/eliminados_users', $data);
        echo view('plantillas/footer');
    }

 
    public function changeBaja($id)
    {
        // Lógica para cambiar el valor de "baja" a "SI" en la base de datos para el usuario con el ID especificado
        $this->userModel = new UsersModel();
        $user = $this->userModel->find($id);
        
    
        // Verificar si el usuario existe
        if ($user) {
            $baja = $user['estado'];
            if($baja == 1){
                $this->userModel->update($id, ['estado' => 0]);
            } else if ($baja == 0) {
                // Realiza acciones cuando $perfil_id es igual a '2'
                $this->userModel->update($id, ['estado' => 1]);
            } else {
                // Realiza acciones por defecto cuando $perfil_id no coincide con '1' ni '2'
                $this->userModel->update($id, ['estado' => 1]);
            }
            
            // Guardar los cambios en la base de datos
    
        }
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
  
    public function editar_user($id){
        $userModel = new UsersModel();
        $user = $userModel->find($id);
        
         // Pasa los datos del producto a la vista correspondiente
         $dato['titulo'] = 'Modificar Usuario';
        $data['user'] = $user;
        

        // Carga la vista y muestra el producto
        echo view('plantillas/head',$dato);
        echo view('plantillas/nav');
        echo view('contenido/Gestion_usuario/modificar_usuario', $data);
        echo view('plantillas/footer');
     
    }
    public function editar($id)
    {
        $userModel = new UsersModel();
        $producto = $userModel->find($id);
       
      
        $validation= $this->validate([
            'nombre'=>[
                'label'  => 'nombre',
                'rules'  => 'required|min_length[2]|max_length[50]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'Su {field} debe tener menos de {param} caracteres.',
                    'max_length' => 'Su {field} debe tener más de {param} caracteres.'
                ]
            ],
            'apellido'=>[
                'label'  => 'apellido',
                'rules'  => 'required|min_length[2]|max_length[25]',
                'errors' => [
                    'required'   => 'Introduzca su {field}.',
                    'min_length' => 'Su {field} debe tener más de {param} caracteres.',
                    'max_length' => 'Su {field} debe tener menos de {param} caracteres.'
                ]
            ],
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
                ],'password'=>[
            'label'  => 'Contraseña',
            'rules'  => 'required|min_length[4]|max_length[25]',
            'errors' => [
                'required'   => 'Introduzca su {field}.',
                'min_length' => 'La {field} debe tener más de {param} caracteres.',
                'max_length' => 'La {field} debe tener menos de {param} caracteres.'
            ]
        ],
        'password_equal' => 
        [
            'label'  => 'Confirmar Contraseña',
            'rules'  => 'required|matches[password]',
            'errors' => [
                'required' => 'Intruduzca su contraseña.',
                'matches'  => 'Las contraseñas no coinciden.'
            ]
            ]
            
            
            ])  
            ;
        
     

       
    if (!$validation) {
   
        session()->setFlashdata('msg', '¡Datos no válidos!');
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
 
    } 

       
        
    
        $data=[
            'nombre'=>$this->request->getPost('nombre'),
            'apellido'=>$this->request->getPost('apellido'),
            'email'=>$this->request->getPost('email'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'estado' => 1,
            'fecha_modificacion' => date('Y-m-d H:i:s')
           

        ];
        $userModel->update($id,$data);
        session()->setFlashdata('mensaje', 'El Usuario se ha modificado!');
        return redirect()->to(base_url('/'));
  
        

      
    }
}
   
    


