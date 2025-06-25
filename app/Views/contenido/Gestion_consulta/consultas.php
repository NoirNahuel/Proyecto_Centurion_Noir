<!-- app/Views/consultas.php -->
<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<style>
    .search-box {
    transition: box-shadow 0.3s ease;
    border-radius: 0.5rem;
    overflow: hidden;
}

.search-box input.form-control {
    border: 1px solid #dee2e6;
    border-left: none;
    background-color: #f9f9f9;
    transition: all 0.3s ease;
    font-size: 0.95rem;
    padding: 0.6rem 0.75rem;
}

.search-box input.form-control:focus {
    background-color: #ffffff;
    box-shadow: none;
    outline: none;
    border-color: #86b7fe;
}

.search-box .input-group-text {
    border: 1px solid #dee2e6;
    border-right: none;
    background-color: #ffffff;
    padding: 0.6rem 0.75rem;
}

.search-box .bi-search {
    font-size: 1rem;
    color: #6c757d;
}
.pagination .page-item.active .page-link {
    background-color:rgb(11, 13, 15);
    border-color:rgb(4, 4, 5);
    color: white;
}
.pagination .page-link:hover {
    background-color: #e9ecef;
    
}
.table-dark tbody {
  background-color: #1e1e2f; /* Fondo tipo Visual Studio */
  color: #e0e0e0;            /* Texto claro */
}

.table-dark tbody tr {
  transition: background-color 0.2s ease-in-out;
}

.table-dark tbody tr:hover {
  background-color: #2c2c40; /* Hover más claro */
  color: #ffffff;
}

.table-dark tbody td {
  border-color: #2f2f44;
  padding: 0.75rem;
  vertical-align: middle;
  font-size: 0.95rem;
}

</style>
<h2 class="text-center mt-3">Tabla de Consulta</h2>
  
 <!-- Flash de éxito -->
    <?php if(session()->getFlashdata('msg')): ?>
      <div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?= session()->getFlashdata('msg') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    <?php endif; ?>
    <section class="container mt-4 text-center">
<div class="input-group mb-3 shadow-sm search-box" style="max-width: 400px;">
    <span class="input-group-text bg-white border-end-0" id="search-icon">
        <i class="bi bi-search text-muted"></i>
    </span>
    <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Buscar consulta..." aria-label="Buscar consulta" aria-describedby="search-icon">
</div>




    <?php if (!empty($search)) : ?>
        <a href="<?= site_url('Gestion_consultas/consultas') ?>" class="btn  btn-sm custom-btn">Volver a consultas</a>
    <?php endif; ?>
    <a href="<?= site_url('/consultas_respuestas') ?>" class="btn  btn-sm custom-btn custom-btn btn-secondary rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0"><i class="bi bi-reply"></i>Respuestas </a>
    </section>

<div class="container mt-5">
    <div class="table-responsive">
   <form method="GET" id="filtroFechas" class="d-flex mb-3">
    <label class="me-2 fw-bold">Fecha desde:</label>
    <input type="date" name="fecha_desde" class="form-control w-25 me-2" value="<?= esc($fecha_desde ?? '') ?>">

    <label class="me-2 fw-bold">Fecha hasta:</label>
    <input type="date" name="fecha_hasta" class="form-control w-25 me-2" value="<?= esc($fecha_hasta ?? '') ?>">

    <button type="submit" class="btn btn-dark" data-bs-toggle="tooltip"
          data-bs-custom-class="custom-tooltip" data-bs-title="Filtrar Fecha" data-bs-placement="top"><i class="fas fa-filter"></i> </button>
</form>
<!-- Mostrar mensaje si no hay registros encontrados -->
<?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && (isset($fecha_desde) || isset($fecha_hasta))) : ?>
    <?php if (empty($fecha_desde) || empty($fecha_hasta)) : ?>
        <p class="alert alert-warning text-center">Por favor, ingrese un rango de fechas completo para la búsqueda.</p>
    <?php elseif (isset($consultas) && count($consultas) === 0) : ?>
        <p class="alert alert-warning text-center">No se encontraron registros en ese periodo de tiempo.</p>
    <?php endif; ?>
<?php endif; ?>


<div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>fecha de la consulta</th>
                    <th>Respondido</th>
                    <th>Responder</th>
                </tr>
            </thead>
            <tbody id="consultaTableBody">
    <?= $this->include('contenido/Gestion_consulta/consultas_filas') ?>
</tbody>

        </table>
        </div>
    </div>
<?php if (isset($paginador)) : ?>
    <div>
        <?= $paginador->simpleLinks('default', 'bootstrap') ?>
    </div>
<?php endif; ?>


    </div>    </div>



<?= $this->endSection() ?>