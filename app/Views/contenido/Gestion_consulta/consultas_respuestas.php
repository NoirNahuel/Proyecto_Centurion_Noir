<!-- app/Views/consultas.php -->
<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<section>
    <br>
    

<h2 class="text-center mt-3">Tabla de Respuestas</h2>
    <?php if (session()->getFlashdata('msg')): ?>
    <div class="custom-alert h6 text-center alert alert-warning alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <?= session()->getFlashdata('msg') ?>
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
        <a href="<?= site_url('/consultas_respuestas') ?>" class="btn  btn-sm custom-btn">Volver a Respuestas</a>
    <?php endif; ?>
    <a href="<?= site_url('/consultas') ?>" class=" custom-btn btn btn-sm btn-success rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0"><i class="bi bi-question-circle"></i>
    </i>Consultas </a>
    </section>
    

<div class="container mt-5">
    <div class="table-responsive">
        <form method="GET" action="<?= base_url('/consultas_respuestas'); ?>" class="d-flex mb-3">
            <label class="me-2 fw-bold">Fecha desde:</label>
            <input type="date" name="fecha_desde" class="form-control w-25 me-2" value="<?= esc($fecha_desde ?? '') ?>">

            <label class="me-2 fw-bold">Fecha hasta:</label>
            <input type="date" name="fecha_hasta" class="form-control w-25 me-2" value="<?= esc($fecha_hasta ?? '') ?>">

            <button type="submit" class="btn btn-dark" data-bs-toggle="tooltip"
          data-bs-custom-class="custom-tooltip" data-bs-title="Filtrar Fecha" data-bs-placement="top"><i class="fas fa-filter"></i></button>

        </form>
       <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>  
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>fecha de la consulta</th>
                    <th>fecha de la respuesta</th>
                    <th>Respuesta</th>
                </tr>
            </thead>
            <tbody id="consultaTableBody">
                <?php foreach ($consultas as $consulta) : ?>
                    <?php  if(! $consulta['fecha_respuesta'] == null) :?>
                        <tr>
                        <td><?= $consulta['id_consulta'] ?></td>
                        <td><?= $consulta['nombre'] ?></td>
                        <td><?= $consulta['email'] ?></td>
                        <td><?= $consulta['fecha_consulta'] ?></td>
                      
                        <td><?= $consulta['respuesta'] == null ? 'Sin responder'  : date('d/m/Y H:i', strtotime($consulta['fecha_respuesta'])) ?>
                        <td>
                            
                       
                        <div class="d-flex justify-content-center gap-1 flex-wrap small-btn-group" >

                        <!-- Botón Ver Respuesta -->
                        <button type="button"
                                class="btn btn-icon view tooltip-custom"
                                data-tooltip="Ver Respuesta"
                                data-bs-toggle="modal"
                                data-bs-target="#respuestaModal<?= $consulta['id_consulta'] ?>">
                        
                        <!-- icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z" />
                            <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        </button>



                        </div>
                    </td>
                    </tr>
                   
                            <!-- Modal de la respuesta -->
                    <div class="modal fade respuesta-modal" id="respuestaModal<?= $consulta['id_consulta'] ?>" tabindex="-1"
                        aria-labelledby="respuestaModalLabel<?= $consulta['id_consulta'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content dark-modal">
                        <div class="modal-header border-0">
                             
                            <h5 class="modal-title text-white" id="respuestaModalLabel<?= $consulta['id_consulta'] ?>">Respuesta</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-text-content">
                                 <?php if (empty($consulta['respuesta'])) : ?>
                                <a >No hay respuestas </a>
                            <?php endif; ?>
                            <p> <?= nl2br(esc($consulta['respuesta'])) ?></p>
                            </div>
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-between">
                        <p><small >Consulta ID: <?= esc($consulta['id_consulta']) ?></small></p> 
                            <button type="button" class="btn btn-outline-light btn-sm rounded-pill px-3" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                        </div>
                    </div>
                    </div>



                    <?php endif; ?>
                <?php endforeach; ?>
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
</section>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchInput');
    input.addEventListener('keyup', function () {
        const search = this.value;

        fetch("<?= base_url('buscar_consulta') ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "search=" + encodeURIComponent(search)
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('consultaTableBody').innerHTML = data;
        });
    });
});
</script>
<?= $this->endSection() ?>