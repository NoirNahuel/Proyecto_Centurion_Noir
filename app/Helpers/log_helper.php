<?php

use App\Models\LogUsuarioModel;

/**
 * Registra un log de actividad (de usuario o visitante).
 *
 * @param int|null $id_usuario ID del usuario (o null si es visitante)
 * @param string $accion Acción realizada (ej: "Consulta enviada")
 * @param string $detalle Detalle adicional (formato estilo GitHub)
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
        'fecha_hora'   => date('Y-m-d H:i:s'),
    ]);
}function extraerNombre($detalle) {
    preg_match('/^(.*?) \(/', $detalle, $match);
    return $match[1] ?? 'Desconocido';
}

function extraerEmail($detalle) {
    preg_match('/\((.*?)\)/', $detalle, $match);
    return $match[1] ?? 'sin@email';
}

function extraerMensaje($detalle) {
    $pos = strpos($detalle, 'Mensaje:');
    return $pos !== false ? trim(substr($detalle, $pos + 8)) : '';
}
