<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
/** Rutas paginas de navegacion inicial */
$routes->get('/', 'Home::index');
$routes->get('/quieneSomos', 'Home::quieneSomos');
$routes->get('/acercaDe', 'Home::acerca_de');
$routes->get('/contacto', 'Home::contacto');
$routes->get('/terminos_usos', 'Home::terminos_usos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('productos', 'Home::productos');

/** Rutas paginas de consulta */
$routes->match(['get', 'post'], 'enviarconsultas', 'ConsultaController::validarmensaje');








