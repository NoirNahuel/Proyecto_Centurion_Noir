<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsersModel;

class registrarse_controller extends BaseController{

    public function registrarse(){
        $data['titulo'] = 'Registrarse ';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/registro_user').view('plantillas/footer');
    }
    public function index()
    {
        $userModel = new UserModel();
        $data=[
            
            'users' => $userModel->paginate(5),
            'paginador' => $userModel->pager];

        echo view('front/header');
        echo view('front/navbar');
        echo view('backend/User/usarios', $data);
        echo view('front/footer');
    }

    public function validation(){
      
      
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
            'rules'  => 'required|min_length[4]|max_length[30]|valid_email|is_unique[usuarios.email]',
            'errors' => [
                'required'    => 'Introduzca su {field}.',
                'min_length'  => 'Su {field} debe tener más de {param} caracteres.',
                'max_length'  => 'Su {field} debe tener menos de {param} caracteres.',
                'valid_email' => 'El correo electronico ({value}) no es válido.',
                'is_unique'   => 'El correo electronico ({value}) ya está registrado.'
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
        ],
        'password_equal' => 
        [
            'label'  => 'Confirmar contraseña',
            'rules'  => 'required|matches[password]',
            'errors' => [
                'required' => 'Introduzca su contraseña.',
                'matches'  => 'Las contraseñas no coinciden.'
            ]
        ]
        ])  
        ;
        
 
       /* $validations= $this->validate($rules);*/
       $userRegistro= new UsersModel();
       if($validation){
        $userRegistro->save([
            'nombre'   => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
           // 'usuario'  => $this->request->getVar('usuario'),
            'email'    => $this->request->getVar('email'),
           'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'fecha_registro' => date('Y-m-d H:i:s'),
            
            'id_perfil' => 2,
            'estado' => 1
        ]);

        session()->setFlashdata('mensaje', 'La cuenta ha sido creada con éxito');

        return redirect()->to('/registro');
       
    
   // $userRegistro-> insert($data);
    //return redirect()->back()->withInput()->with('mensaje', 'su registro se realizo correctamente!');  
        }else{
            $data['titulo'] = 'Registrarse ';
            echo view('plantillas/head', $data);
            echo view('plantillas/nav');
            echo view('contenido/registro_user', ['validation' => $this->validator]);
            echo view('plantillas/footer');
       // return redirect()->back()->withInput()->with('errors',$this->validator->listErrors());
        }
        
    }    
    public function registroNewAdmin(){
        $data['titulo'] = 'Registrar nuevo Administrador ';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/registroNewAdmin').view('plantillas/footer');
    }
    public function validationNewAdmin(){
      
      
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
            'rules'  => 'required|min_length[4]|max_length[30]|valid_email|is_unique[usuarios.email]',
            'errors' => [
                'required'    => 'Introduzca su {field}.',
                'min_length'  => 'Su {field} debe tener más de {param} caracteres.',
                'max_length'  => 'Su {field} debe tener menos de {param} caracteres.',
                'valid_email' => 'El correo electronico ({value}) no es válido.',
                'is_unique'   => 'El correo electronico ({value}) ya está registrado.'
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
        ],
        'password_equal' => 
        [
            'label'  => 'Confirmar contraseña',
            'rules'  => 'required|matches[password]',
            'errors' => [
                'required' => 'Introduzca su contraseña.',
                'matches'  => 'Las contraseñas no coinciden.'
            ]
        ]
        ])  
        ;
        
 
       /* $validations= $this->validate($rules);*/
       $userRegistro= new UsersModel();
       if($validation){
        $userRegistro->save([
            'nombre'   => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
           // 'usuario'  => $this->request->getVar('usuario'),
            'email'    => $this->request->getVar('email'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
             
          // 'password'    => $this->request->getVar('password'),
            
            'id_perfil' => 1,
            'estado' => 1
        ]);

        session()->setFlashdata('mensaje', 'La cuenta administrador ha sido creada con éxito');

        return redirect()->to('/registroNewAdmin');
       
    
   // $userRegistro-> insert($data);
    //return redirect()->back()->withInput()->with('mensaje', 'su registro se realizo correctamente!');  
        }else{
            $data['titulo'] = 'Crear usuario Administrador ';
            echo view('plantillas/head', $data);
            echo view('plantillas/nav');
            echo view('contenido/registro_user', ['validation' => $this->validator]);
            echo view('plantillas/footer');
       // return redirect()->back()->withInput()->with('errors',$this->validator->listErrors());
        }
        
    }         
}   