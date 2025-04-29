 <!--<header>
    <div id="inicio" class="divBoxFooter">  
      <img  class="imgFooter" src="<?php echo base_url("../assets/img/logo2.png");?>" alt="Logo Footer">
      
    </div>
    <h2 class="h2">Bienvenido al mundo de la Musica y sus instrumentos</h2>
</header>

  
 
    
 <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand text-white" href="<?php echo base_url('/');?>">Guitar CN</a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                Menú
                <i class="fas fa-bars ms-1"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                
                   
<ul class="navbar-nav ms-auto">
    <li class="nav-item"><a class="nav-link text-white " href="<?php echo base_url('/');?>">Inicio</a></li>
    <li class="nav-item"><a class="nav-link text-white hover-blanco " href="<?php echo base_url('quieneSomos');?>">Quiénes Somos</a></li>
    <li class="nav-item"><a class="nav-link text-white hover-blanco" href="productos">Productos</a></li>
    <li class="nav-item"><a class="nav-link text-white hover-blanco" href="<?php echo base_url('contacto');?>">Contacto</a></li>
    <li class="nav-item"><a class="nav-link text-white hover-blanco" href="terminos_usos">Términos y Usos</a></li>
</ul>
               
            </div>
        </div>
    </nav>
    <div class="container text-white text-center py-5" style="padding-top: 6rem;">
        <h1 class="display-4 fw-bold">Bienvenido a Guitar CN</h1>
        <p class="lead">Tu tienda online de instrumentos musicales</p>
    </div>

-->
<!-- Contenedor general fijo en el top -->

<!-- HEADER STICKY CON NAVBAR -->
<header class="degradado position-sticky top-0 shadow-sm" style="z-index: 1020;">

   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg px-3" style="background-color: transparent;">
   <div class="container-fluid">
     <!-- Botón hamburguesa -->
<button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
   aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
   <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
</button>


      <!-- Offcanvas para mobile -->
      <div class="offcanvas offcanvas-end degradado" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
         <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel"></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
               aria-label="Close"></button>
         </div>
         <div class="offcanvas-body">
            <div class="d-md-flex align-items-center gap-2">
               <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalDesarrollo">Iniciar Sesión</button>
               <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalDesarrollo">Shop</button>
               <a class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalDesarrollo">
                  <i class="fas fa-shopping-cart"></i>
               </a>
            </div>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
               <li class="nav-item">
                  <a class="nav-link text-white" href="<?php echo base_url('quieneSomos');?>">Quiénes Somos</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link text-white" href="productos">Productos</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link text-white" href="comercializacion">Comercialización</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link text-white" href="<?php echo base_url('contacto');?>">Contacto</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link text-white" href="<?php echo base_url('terminos_usos');?>">Términos y Usos</a>
               </li>
            </ul>
         </div>
      </div>
   </div>
</nav>

   <!-- Header inferior con logo y nombre -->
   <div class="d-flex justify-content-center" class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
      <!-- Logo y nombre -->
      <div class="d-flex align-items-center mb-2 mb-md-0">
         <img class="logoTienda img-fluid" src="<?php echo base_url('../assets/img/guitarCent_logo.png'); ?>" alt="Logo" style="height: 100px;" class="me-3 img-fluid">
         <h4 class="mb-0 logoTienda"><a class="text-decoration-none text-white" href="<?php echo base_url('/');?>">Guitar'N Cent Store</a></h1>
      </div>
   </div>
</header>

<!-- Modal -->
<div class="modal fade" id="modalDesarrollo" tabindex="-1" aria-labelledby="modalDesarrolloLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-center text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 text-white" id="modalDesarrolloLabel">🔧 En Desarrollo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p style="color:rgb(19, 96, 99); font-size: 1.1rem;">
          Esta funcionalidad aún no está disponible.<br>
          ¡Estamos afinando los últimos detalles! 🎸
        </p>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


    
  <!--       
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a href="<?php echo base_url('/');?>"><img class="logo_nav" src="<?php echo base_url("../assets/img/guitar_logo_title.jpg");?>" alt=""></a>
    <a class="navbar-brand" href="<?php echo base_url('/');?>">Guitar Cent</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
        <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('/');?>">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('quieneSomos');?>">Quienes Somos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('acercaDe');?>">Acerca De</a>
          </li>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            productos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Guitarras</a></li>
            <li><a class="dropdown-item" href="#">Bajos</a></li>
            <li><a class="dropdown-item" href="#">Baterias</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Componentes</a></li>
          </ul>
        </li>
        <?php if (!(session()->get('id_perfil') == 1 || session()->get('id_perfil') == 2)): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('registrarse');?>">Registrate</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('login');?>"><i class="fa-solid fa-user-large"> </i>Iniciar Sesion</a>
          </li>
          <?php endif; ?>
          <?php if (session()->get('id_perfil') == 2): ?>
            <li>
            <a class="nav-link" class="btn btn-outline-success d-block mb-3" href="<?= base_url('user/editar_user/'.session()->get('id_usuario'));?>">Modificar mis Datos</a>
            </li>
            <li >
              <a class="nav-link"  href="<?php echo base_url('/Cerrar-Sesion') ?>">Cerrar sesión</a>
             </li>
             
                <?php endif; ?>
          <?php if (session()->get('id_perfil') == 1): ?>
                  
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Crud Usuarios
                        </a>
                     
                       <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo base_url("/usuarios"); ?>">Tabla de Usuarios</a>
                            </li>
                            <li><a class="dropdown-item" href="<?php echo base_url("/baja_usuario"); ?>">Tabla de Eliminados</a>
                            </li>
                                                   
                        </ul>
                       
  

                        </li>
                        

   

                       
    <li >
        <a class="nav-link" href="<?php echo base_url('/Cerrar-Sesion') ?>">Cerrar sesión</a>
    </li>

  
    
 
              
                <?php endif; ?>
      
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
      </div>
    </div>



</nav>  

