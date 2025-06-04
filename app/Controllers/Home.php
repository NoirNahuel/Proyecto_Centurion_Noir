<?php

namespace App\Controllers;
use App\Models\consultaModel;
use App\Models\UsersModel;
use App\Models\LogUsuarioModel;
class Home extends BaseController
{
    public function index(){
        $data['titulo'] = 'GuitarNCent';
        return view('plantillas/head', $data).view('plantillas/nav').view('principal').view('plantillas/footer');
    }
    public function quieneSomos(){
        $data['titulo'] = 'Quienes Somos';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/quienesSomos').view('plantillas/footer');
    }
    public function acerca_de(){
        $data['titulo'] = 'Nosotros';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/acercaDe').view('plantillas/footer');
    }
    public function contacto(){
        $data['titulo'] = 'Contactanos';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/contacto').view('plantillas/footer');
    }
    
    public function terminos_usos(){
        $data['titulo'] = 'Terminos y Usos';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/terminosUsos').view('plantillas/footer');
    }
    public function comercializacion(){
        $data['titulo'] = 'Comercializacion';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/comercializacion').view('plantillas/footer');
    }
    public function productos($categoria = 'todas')
    {
        $data['titulo'] = 'Productos - GuitarCN';
        return view('plantillas/head', $data). view('plantillas/nav').view('contenido/productos', ['categoria' => $categoria]).view('plantillas/footer');
    }
    public function dashboard()
    {
        $data['titulo'] = 'Panel de Administracion';
        return view('components/dashboard_Admin', $data);
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
public function cargar()
{
    $offset = (int) $this->request->getGet('offset') ?? 0;

    $model = new LogUsuarioModel();
    $logs = $model->orderBy('fecha_hora', 'DESC')
                  ->findAll(30, $offset); // LIMIT 3 OFFSET $offset

    return $this->response->setJSON($logs);
}



    
}
