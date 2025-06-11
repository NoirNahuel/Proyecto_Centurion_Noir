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
     public function login_user(){
        $data['titulo'] = 'Iniciar Sesion';
       return view('plantillas/head', $data).view('plantillas/nav').view('contenido/login').view('plantillas/footer');
    }
    public function dashboard() 
    {
        $data['titulo'] = 'Panel de Administracion';
        return view('components/dashboard_Admin', $data);
    }
    public function dashboard_2()
    {
        $data['titulo'] = 'Panel del Cliente';
        return view('plantillas/head', $data).view('plantillas/nav').view('contenido/dashboard_2').view('plantillas/footer');
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
public function cargarMas()
{
    $offset = (int) ($this->request->getGet('offset') ?? 0);

    $model = new \App\Models\LogUsuarioModel();
    $logs = $model->select('log_usuario.*, usuarios.nombre')
                  ->join('usuarios', 'usuarios.id_usuario = log_usuario.id_usuario', 'left')
                  ->orderBy('fecha_hora', 'DESC')
                  ->findAll(30, $offset);

    // Si no hay logs, devolvemos un string vacío
    if (empty($logs)) {
        return $this->response->setJSON([]);
    }

    // Renderizamos la vista parcial para cada log
    $html = '';
    foreach ($logs as $index => $log) {
        // Para no repetir IDs, sumá el offset al index para que el id sea único
        $logIndex = $offset + $index;
        $html .= view('components/notificacion_item', ['log' => $log, 'index' => $logIndex]);
    }

    return $this->response->setJSON(['html' => $html, 'count' => count($logs)]);
}


public function cargarMa()
{
    $offset = $this->request->getGet('offset') ?? 0;
    $limit = 3;

    $logModel = new \App\Models\LogUsuarioModel();

    // Obtener los registros actuales
    $logs = $logModel
        ->select('log_usuario.*, usuarios.nombre')
        ->join('usuarios', 'usuarios.id_usuario = log_usuario.id_usuario', 'left')
        ->orderBy('fecha_hora', 'DESC')
        ->findAll($limit, (int)$offset);

    // Usamos nueva instancia para contar correctamente
    $total = (new \App\Models\LogUsuarioModel())->countAll();
    $hayMas = ($offset + $limit) < $total;

    // Renderizar los logs como HTML
    $html = '';
    foreach ($logs as $index => $log) {
        $html .= view('components/notificacion_item', ['log' => $log, 'index' => $offset + $index]);
    }

    return $this->response->setJSON([
        'html' => $html,
        'hayMas' => $hayMas
    ]);
}







    
}
