<?php 
namespace App\Controllers;  
use CodeIgniter\Controller;
use App\Models\productosModel;
use App\Models\CategoriaModel;

class producto_controller extends Controller{
public function index()
    {
      
    
        $data['titulo'] = 'Crud Producto';
    
        echo view('contenido/Gestion_productos/crud_table', $data);
      
    }

 }