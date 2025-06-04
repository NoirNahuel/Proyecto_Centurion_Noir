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

/** Rutas paginas de consulta Publico General y Clientes*/
$routes->match(['get', 'post'], 'enviarconsultas', 'consulta_controller::validarmensaje');

/*Rutas paginas de Consultas*/
$routes->match(['get', 'post'], 'Gestion_consultas/consultas', 'consulta_controller::consultas');
$routes->match(['get', 'post'], 'Gestion_consultas/respuesta/(:num)', 'consulta_controller::respuesta/$1');
$routes->match(['get', 'post'], 'Gestion_consultas/respuestas/(:num)', 'consulta_controller::respuestas/$1');
$routes->match(['get', 'post'], 'Gestion_consultas/buscar_consulta', 'consulta_controller::buscar');
$routes->get('/consultas', 'consulta_controller::consultas');
$routes->get('/consultas_respuestas', 'consulta_controller::consultas_respuestas');
$routes->match(['get', 'post'], '/respuesta/(:num)', 'consulta_controller::respuesta/$1');
$routes->match(['get', 'post'], '/respuestas/(:num)', 'consulta_controller::respuestas/$1');
$routes->match(['get', 'post'], '/buscar_consulta', 'consulta_controller::buscar');

$routes->post('marcar', 'consulta_controller::marcarComoLeida');
$routes->get('/consultas/ajaxLista', 'consulta_controller::ajaxLista');//revisar ruta 



/** Rutas paginas de Panel de Administrador */
$routes->get('layouts', 'Home::layouts');
$routes->get('cargar', 'Home::cargar');
$routes->get('dashboard', 'Home::dashboard');
$routes->get('cargarVista/(:any)', 'Home::cargarVista/$1'); //revisar ruta 

/** Rutas paginas de Productos Panel de Administrador */
$routes->get('Gestion_Producto', 'producto_controller::index');
/** Rutas paginas de Usuarios Panel de Administrador */
$routes->get('usuarios', 'login_controller::usuarios');


