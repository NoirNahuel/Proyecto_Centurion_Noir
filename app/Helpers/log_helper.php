<?php

use App\Models\LogUsuarioModel;

/**
 * Registra un log de actividad (de usuario o visitante).
 *
 * @param int|null $id_usuario ID del usuario (o null si es visitante)
 * @param string $accion Acción realizada (ej: "Consulta enviada")
 * @param string $detalle Detalle adicional
 * @param string $tipo_origen 'usuario' o 'visitante'
 */
function registrar_log(?int $id_usuario, string $accion, string $detalle = '', string $tipo_origen = 'usuario')
{
    $logModel = new LogUsuarioModel();

    $logModel->insert([
        'id_usuario'   => $id_usuario,
        'tipo_origen'  => $tipo_origen,
        'accion'       => $accion,
        'detalle'      => $detalle,
    ]);
}

