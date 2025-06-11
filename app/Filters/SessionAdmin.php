<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class SessionAdmin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verifica si está logueado
        if (!session()->has('id_perfil')) {
            return redirect()->to('/login')->with('errorFilter', 'Debes iniciar sesión.');
        }

        // Verifica si el perfil no es administrador
        if (session()->get('id_perfil') != 1) {
            return redirect()->to('/')->with('errorFilter', 'No tienes autorización para acceder a esta ruta.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se usa normalmente para filtros de sesión
    }
}
