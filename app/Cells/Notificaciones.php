<?php

namespace App\Cells;

use App\Models\LogUsuarioModel;

class Notificaciones
{
public function render(): string
{
    $limit = 5;
    $logModel = new LogUsuarioModel();
    $logs = $logModel
        ->select('log_usuario.*, usuarios.nombre')
        ->join('usuarios', 'usuarios.id_usuario = log_usuario.id_usuario', 'left')
        ->orderBy('fecha_hora', 'DESC')
        ->findAll($limit, 0); // Limita los primeros 5

    $total = $logModel->countAll();
    $hayMas = $limit < $total;

    return view('components/notificaciones', [
        'logs' => $logs,
        'hayMas' => $hayMas
    ]);
}



}

