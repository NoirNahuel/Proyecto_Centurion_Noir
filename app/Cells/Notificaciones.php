<?php

namespace App\Cells;

use App\Models\LogUsuarioModel;

class Notificaciones
{
   public function render(): string
{
    $logModel = new LogUsuarioModel();
    $logs = $logModel->orderBy('fecha_hora', 'DESC')->findAll(5, 0); // Limite 3, offset 0

    return view('components/notificaciones', ['logs' => $logs]);
}

}

