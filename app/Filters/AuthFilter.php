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
        // Verifica si está logueado
        if (!session()->has('id_perfil')) {
            return redirect()->to('/login')->with('errorFilter', 'Debes iniciar sesión.');
        }

        // Verifica si el perfil no es administrador
        if (session()->get('id_perfil') != 2) {
            return redirect()->to('/')->with('errorFilter', 'No tienes autorización para acceder a esta ruta de usuarios Clientes.');
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No se necesita realizar ninguna acción después de la solicitud
    }
}