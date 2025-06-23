<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array<string, class-string|list<class-string>> [filter_name => classname]
     *                                                     or [filter_name => [classname1, classname2, ...]]
     */
    /**
   * public array $aliases = [
   *     'csrf'          => CSRF::class,
   *     'toolbar'       => DebugToolbar::class,
   *     'honeypot'      => Honeypot::class,
    *    'invalidchars'  => InvalidChars::class,
   *     'secureheaders' => SecureHeaders::class,
  *  ];
     */
      public $aliases = [
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
		//'authGuard' => \App\Filters\AuthGuard::class,
        'admin' => \App\Filters\SessionAdmin::class,
        'AuthFilter'  => \App\Filters\AuthFilter::class,
        'NoAuthFilter'  => \App\Filters\NoAuthFilter::class
	];
     public $filters = [
        'AuthFilter' => [
            // Lista de rutas en las que se aplicará el filtro "auth"
            'only' => [
            '/dashboard_cliente/(:num)',
            '/listar-compras',
            '/factura/(:num)',
            '/carrito',
            '/carrito_actualiza',
            '/carrito_agrega',
            'carrito_elimina/(:any)',
            '/borrar',
            '/carrito-comprar',
            'sumar_carrito',
            'restar_carrito',
            
            'userCliente/editar/(:num)',
            'userCliente/editar_user/(:num)',
            'editarDatos/(:num)',
            'editar-datos/(:num)'
      
        
        ],
    ],
        'admin' => [
            // Lista de rutas en las que se aplicará el filtro "admin"
            'only' => [
                '/usuarios',
                '/baja_usuarios',
                '/buscar',
                '/alta_productos',
                '/productos',
                '/ProductoController/store',
                '/product/change_baja/(:num)',
                '/productos_eliminados',
                '/buscar_producto',
                '/product/editar_producto/(:num)',
                '/product/editar/(:num)',
                '/buscar_catalogo',
                '/respuesta/(:num)',
                '/buscar_consulta',
                '/respuestas/(:num)',
                '/consultas',
                '/consultas_respuestas',
                '/dashboard',
               
                
            ],
        ],
        'NoAuthFilter' => [
            // Lista de rutas en las que se aplicará el filtro "NoAuthFilter"
            'only' => [
                '/login'
               
                
               
                
            ],
        ],
    ];
    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array<string, array<string, array<string, string>>>|array<string, list<string>>
     */
    public array $globals = [
        'before' => [
           
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don't expect could bypass the filter.
     *
     * @var array<string, list<string>>
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array<string, array<string, list<string>>>
     */
   
}
