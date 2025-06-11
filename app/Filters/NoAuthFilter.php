<?php 

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class NoAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Verificar si el usuario ha iniciado sesión
        if (session()->get('id_perfil') == 1 || session()->get('id_perfil') == 2) {
            return redirect()->to('/')->with('errorFilter', 'Estás en sesión.');
        }
        
      
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (session()->get('id_perfil') == 1 || session()->get('id_perfil') == 2) {
            return redirect()->to('/login')->with('errorFilter', 'Debes Iniciar sesion.');
        }
    }
}
?>