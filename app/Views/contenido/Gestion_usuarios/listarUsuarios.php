<!-- app/Views/Gestion_usuarios/listarUsuarios.php -->
<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<section>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Gestion de Usuarios</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">GuitarN' Cent</a>
        </li>
        <li class="nav-item">
       
        </li>
        <li class="nav-item">
        <a href="<?= site_url('/baja_usuario') ?>" class="btn btn-outline-secondary rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0"><i class="bi bi-trash"></i>Usuarios Eliminados</a>
        </li>
       
      </ul>
      

    </div>
  </div>

</nav>
<section class="container mt-4 text-center">
    <?php if (!empty($search)) : ?>
        <a href="<?= site_url('/usuarios') ?>"  class="custom-btn btn btn-sm btn-dark rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0"><i class="bi bi-reply"></i>volver a usuarios</a>
    <?php endif; ?>
   
</section>
    <?php if (session()->getFlashdata('warning')): ?>
    <div class="custom-alert h6 text-center alert alert-warning alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <?= session()->getFlashdata('warning') ?>
    </div>
<?php endif; ?>
    <section class="container mt-4 text-center">
   

   
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
    <?php if (empty($search)) : ?>
        <p class="alert alert-warning">Por favor, ingrese un término de búsqueda.</p>
    <?php elseif (empty($users)) : ?>
        <p class="alert alert-warning">No se encontraron registros para el nombre buscado.</p>
    <?php endif; ?>
<?php endif; ?>
<form method="GET" action="<?= base_url('/buscarUsuariosPorFechas'); ?>" class="d-flex mb-3">
            <label class="me-2 fw-bold">Fecha desde:</label>
            <input type="date" name="fecha_desde" class="form-control w-25 me-2" value="<?= esc($fecha_desde ?? '') ?>">

            <label class="me-2 fw-bold">Fecha hasta:</label>
            <input type="date" name="fecha_hasta" class="form-control w-25 me-2" value="<?= esc($fecha_hasta ?? '') ?>">

            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
        <div class="input-group mb-3 shadow-sm search-box" style="max-width: 400px;">
    <span class="input-group-text bg-white border-end-0" id="search-icon">
        <i class="bi bi-search text-muted"></i>
    </span>
    <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Buscar usuario..." aria-label="Buscar usuario" aria-describedby="search-icon">
</div>
<!-- Mostrar mensaje si no hay registros encontrados -->
<?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fecha_desde']) && isset($_GET['fecha_hasta'])) : ?>
    <?php if (empty($_GET['fecha_desde']) || empty($_GET['fecha_hasta'])) : ?>
        <p class="alert alert-warning text-center">Por favor, ingrese un rango de fechas para la búsqueda.</p>
    <?php elseif (empty($ventas)) : ?>
        <p class="alert alert-warning text-center">No se encontraron registros en ese periodo de tiempo.</p>
    <?php endif; ?>
<?php endif; ?>
<!-- Resto de tu contenido de usuarios -->

   
</section>


<section>
    <div class="container mt-5">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo</th>
                        <th>Perfil</th>
                        <th>Estado</th>
                        <th>Fecha Modificación</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                        <tbody id="usuarioTableBody">
    <?= $this->include('contenido/Gestion_usuarios/usuarios_filas') ?>
</tbody>
                
            </table>
            <?php if (isset($paginador)) : ?>
    <div>
        <?= $paginador->simpleLinks('default', 'bootstrap') ?>
    </div>
<?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>