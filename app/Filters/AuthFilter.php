<?php 
// Archivo: app/Filters/AuthFilter.php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar si el usuario ha iniciado sesión
        if (session()->get('id_perfil') != 2) {
      return redirect()->to('/login')->with('msg', 'Debes iniciar sesión.');
        }
        
        // Continuar con la solicitud si el usuario ha iniciado sesión
        return;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita realizar ninguna acción después de la solicitud
    }
}