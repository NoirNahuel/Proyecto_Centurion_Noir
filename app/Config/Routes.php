<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/** Rutas paginas de navegacion inicial */
$routes->get('/', 'Home::index');
$routes->get('/quieneSomos', 'Home::quieneSomos');
$routes->get('/contacto', 'Home::contacto');
$routes->get('/terminos_usos', 'Home::terminos_usos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('productos', 'Home::productos');
$routes->get('productos/(:segment)', 'Home::productos/$1');


/** Rutas paginas de consulta */
$routes->match(['get', 'post'], 'enviarconsultas', 'ConsultaController::validarmensaje');








