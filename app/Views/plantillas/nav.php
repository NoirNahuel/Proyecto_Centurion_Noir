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
               <!--
                <a class="nav-link text-white" href="<?php echo base_url('/')?>"> <i class="bi bi-house-door-fill fs-5"></i>
                Inicio
                </a>-->
                    <!-- Opciones para no autenticados -->
         
                <?php if (!(session()->get('id_perfil') == 1 || session()->get('id_perfil') == 2)): ?>  
               
               <a href="<?php echo base_url('login'); ?>" class="btn btn-dark btn-sm  shadow-sm">
                        <i class="fa-solid fa-user-large me-2"></i>Iniciar sesión
                    </a>
               <?php endif; ?> 
               
                <!-- Menú de usuario -->
    <?php if (session()->get('id_perfil') == 2): ?> 
    <div class="btn-group">
       <button 
            class="btn btn-dark btn-sm dropdown-toggle " 
            type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-user-circle me-2"></i> Bienvenido, <strong><?= esc(session('nombre')); ?></strong>
         </button>

         <ul class="dropdown-menu shadow-sm">
            <!-- Información de usuario -->
            <li><h6 class="dropdown-header text-muted">Información de la cuenta</h6></li>
            <li><span class="dropdown-item-text"><i class="fa-solid fa-envelope me-2"></i><?= esc(session('email')); ?></span></li>
            <li><span class="dropdown-item-text"><i class="fa-solid fa-id-card me-2"></i><?= esc(session('apellido')); ?> <?= esc(session('nombre')); ?></span></li>
            
            <li><hr class="dropdown-divider"></li>
            <!-- Opciones -->
            <li>
               <a class="dropdown-item text-warning" href="<?= base_url('userCliente/editar_user/'.esc(session('id_usuario')));?>"> 
                     <i class="fa-solid fa-user-edit me-2"></i>Editar perfil
               </a>
            </li>
            <li>
               <a class="dropdown-item text-danger" href="<?= base_url('/Cerrar-Sesion'); ?>">
                     <i class="fa-solid fa-sign-out-alt me-2"></i>Cerrar sesión
               </a>
            </li>
         </ul>

        
        </div>
        <div class="d-flex justify-content-between align-items-center px-2">
            <div>
                <a 
                href="<?= base_url('dashboard_cliente/' . esc(session('id_usuario'))) ?>" 
                class="btn btn-dark btn-sm ">
                <i class="fa-solid fa-chart-line me-1"></i> Mi Panel Cliente
                </a> 
            </div>  
                
        </div>
        <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalDesarrollo">Mis Compras</button>
               <a class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#modalDesarrollo">
               <i class="bi bi-cart mx-1"></i>
               </a> 
            </div>
    <?php endif; ?>
             
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
         <h4 class="mb-0 logoTienda"><a class="text-decoration-none text-white" href="<?php echo base_url('/');?>">Guitar N' Cent Store</a></h1>
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