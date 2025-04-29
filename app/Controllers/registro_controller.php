<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsersModel;

class registro_controller extends BaseController{
      public function registrarse(){
        $data['titulo'] = 'Registrarse ';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/registro_user').view('plantillas/footer');
    }
    public function index()
    {
        $userModel = new UserModel();
        $data=[
            
            'users' => $userModel->paginate(10),
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
        
       $userRegistro= new UsersModel();
       if($validation){
        $userRegistro->save([
            'nombre'   => $this->request->getVar('nombre'),
            'apellido' => $this->request->getVar('apellido'),
            'email'    => $this->request->getVar('email'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'id_perfil' => 2,
            'estado' => 1
        ]);

        session()->setFlashdata('mensaje', 'La cuenta se creó con éxito');

        return redirect()->to('/registrarse');
       
        }else{
            $data['titulo'] = 'Registrarse ';
            echo view('plantillas/head', $data);
            echo view('plantillas/nav');
            echo view('contenido/registrarte', ['validation' => $this->validator]);
            echo view('plantillas/footer');
        }
        
    }
    
        
    }
