<?php 

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsersModel;
use App\Models\LoginModel;

class login_controller extends BaseController {
    public function usuarios()
    {helper(['form']);
        
    
        $data['titulo'] = 'Usuarios';
        
        echo view('contenido/Gestion_usuarios/listarUsuarios', $data);
    
    } 

 }