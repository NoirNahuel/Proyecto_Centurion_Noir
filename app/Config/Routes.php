<?php

use CodeIgniter\Router\RouteCollection;
use App\Filters\AuthFilter;
use App\Filters\SessionAdmin;
// Create a new instance of our RouteCollection class.
$routes = \Config\Services::routes();
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

/**
 * @var RouteCollection $routes
 */
/** Rutas paginas de navegacion inicial */
$routes->get('/', 'Home::index');
$routes->get('/principal',  'Home::ver');
$routes->match(['post'], 'products/category/(:num)', 'Home::ver/$1');// categoriza los productos
$routes->get('topProductos', 'Home::topProductos');// Trae los productos mas vendidos 
$routes->get('/quieneSomos', 'Home::quieneSomos');
$routes->get('/contacto', 'Home::contacto');
$routes->get('/terminos_usos', 'Home::terminos_usos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->match(['get', 'post'],'/buscar_catalogo', 'producto_controller::buscar_catalogo');
//$routes->get('productos', 'Home::productos');
//$routes->get('productos/(:segment)', 'Home::productos/$1');
$routes->match(['get', 'post'],'/productos', 'producto_controller::catalogo');
/** Rutas paginas de consulta Publico General y Clientes*/
$routes->match(['get', 'post'], 'enviarconsultas', 'consulta_controller::validarmensaje');
//Registro Usuarios
$routes->get('/registro', 'registrarse_controller::registrarse',['filter' => 'NoAuthFilter']);
$routes->post('/validar', 'registrarse_controller::validation',['filter' => 'NoAuthFilter']);

//login 
$routes->get('/login', 'Home::login_user',['filter' => 'NoAuthFilter']);
$routes->get('/raiz', 'login_controller::index');
$routes->post( 'ingresar', 'login_controller::loginAuth');//Ingresa sesion
$routes->get('/Cerrar-Sesion', 'login_controller::logout');//Cierra sesion
/* Filtro para Usuarios Administrador (acceso a CRUD-Productos-Usuarios-Consultas-Respuestas)*/

$routes->group('', ['filter' => 'admin'], function ($routes) {
$routes->get('dashboard', 'Home::dashboard');
/** Rutas paginas de Panel de Administrador */
$routes->get('layouts', 'Home::layouts');
$routes->get('cargar', 'Home::cargar');
$routes->get('cargarMas', 'Home::cargarMas');
$routes->get('cargarVista/(:any)', 'Home::cargarVista/$1'); //revisar ruta 

/** Rutas paginas de Productos Panel de Administrador */
$routes->get('Gestion_Producto', 'producto_controller::index');
/** Rutas paginas de Usuarios Panel de Administrador */
$routes->get('usuarios', 'login_controller::usuarios');
$routes->post('user/change_baja/(:num)', 'login_controller::changeBaja/$1');
$routes->post('user/change_id/(:num)', 'login_controller::change_id/$1');
$routes->get('/Baja-user/(:num)', 'login_controller::delete/$1');
$routes->match(['get', 'post'], '/buscarUsuario', 'login_controller::buscarUsuario');
$routes->match(['get', 'post'],'user/editar_user/(:num)', 'login_controller::editar_user/$1');
$routes->match(['get', 'post'],'user/editar/(:num)', 'login_controller::editar/$1');
$routes->get('/baja_usuario', 'login_controller::baja');
$routes->post('/buscar', 'login_controller::buscar');
$routes->match(['get', 'post'], '/buscar_usuario', 'login_controller::buscar');
$routes->match(['get', 'post'],'/buscarUsuariosPorFechas', 'login_controller::buscarUsuariosPorFechas');

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

//Gestion Producto
$routes->get('/alta_productos', 'producto_controller::new');
$routes->match(['get', 'post'], '/validar_producto', 'producto_controller::store');
$routes->get('/productosadmin', 'producto_controller::index');
$routes->match(['get', 'post'], '/buscar_producto', 'producto_controller::buscar');
$routes->match(['get', 'post'], '/buscarDesdeHasta', 'producto_controller::buscarDesdeHasta');
$routes->get('/Baja-Producto/(:num)', 'producto_controller::delete/$1');
$routes->get('/productos_eliminados', 'producto_controller::baja');
$routes->post('product/change_baja/(:num)', 'producto_controller::cambiarEstado/$1');
$routes->match(['get', 'post'],'product/editar_producto/(:num)', 'producto_controller::editar_producto/$1');
$routes->match(['get', 'post'],'product/editar/(:num)', 'producto_controller::editar/$1');
$routes->get('/gestionar', 'Home::gestion');
/*ventas*/
$routes->match(['get', 'post'],'/facturas/(:num)', 'VentasController::factura/$1');
$routes->get('/ventas', 'VentasController::ventas');
$routes->match(['get', 'post'], '/buscarVentas', 'VentasController::buscarVentas');
$routes->post('ventas/actualizarEstado', 'VentasController::actualizarEstado');

});

/** Rutas paginas de Usuarios Panel de Cliente */

/* Filtro para Usuarios Clientes (acceso a Productos-Carrito-Compras)*/
$routes->group('', ['filter' => 'AuthFilter'], function ($routes) {
//Modificat usuario
$routes->match(['get', 'post'],'userCliente/editar_user/(:num)', 'login_controller::editar_user/$1');  
$routes->match(['get', 'post'],'userCliente/editar/(:num)', 'login_controller::editarUser_cliente/$1');
//Gestion Carrito
$routes->get('/carrito', 'carrito_controller::carrito_view');
$routes->get('/cart_drop', 'carrito_controller::cart_drop');
$routes->add('/carrito_actualiza','carrito_controller::actualiza_carrito');
$routes->post('/carrito_agrega', 'carrito_controller::add');
$routes->add('carrito_elimina/(:any)','carrito_controller::remove/$1');
$routes->get('/borrar','carrito_controller::borrar_carrito');
$routes->get('/carrito-comprar', 'VentasController::comprar_carrito');
$routes->get('sumar_carrito', 'carrito_controller::sumar_carrito', ['as' => 'sumar_carrito']);
$routes->get('restar_carrito', 'carrito_controller::restar_carrito', ['as' => 'restar_carrito']);
//Datos adicionales Persona
$routes->get('completar-datos', 'PersonaController::formulario');
$routes->post('guardar-datos', 'PersonaController::guardarDatos');
$routes->get('verificarDatosCompra', 'PersonaController::verificarDatosUsuario');
$routes->post('guardar-datos-compra', 'PersonaController::guardarDatoscompra');
$routes->get('completar-datos-compra', 'PersonaController::formularioCompra');
$routes->match(['get', 'post'],'editarDatos/(:num)', 'PersonaController::editar/$1');
$routes->match(['get', 'post'],'editar-datos/(:num)', 'PersonaController::actualizarDatos/$1');



 /*rutas del cliente para ver sus compras y el detalle*/
 $routes->get('resumen-compra', 'compras_controller::resumen_compras');
 $routes->get('listar-compras', 'compras_controller::listarComprasUsuario');
 $routes->get('listar-detalle_usuario/(:num)', 'compras_controller::listarDetalleUsuario/$1');
 $routes->get('/dashboard_cliente/(:num)',  'login_controller::dashboard_cliente/$1');

});