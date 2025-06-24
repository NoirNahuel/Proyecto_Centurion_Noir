<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<style>
    select.transition {
    transition: all 0.3s ease-in-out;
    
}
</style>

        <!-- Título principal -->
        <h1 class="text-center fw-bold mt-4">Listado de Ventas</h1>
        <p class="text-center text-muted">Consulta el historial completo de las ventas realizadas en la plataforma.</p>
        <br>
        <!-- Formulario de búsqueda -->
<form action="<?= base_url('buscarVentas') ?>" method="get" class="row g-3">
    <div class="col-md-4">
        <label for="cliente" class="form-label">Buscar por Cliente</label>
        <input type="text" class="form-control" id="cliente" name="cliente" 
               value="<?= esc($cliente ?? '') ?>" placeholder="Ingrese el nombre del comprador">
    </div>
    <div class="col-md-2 align-self-end">
        <button type="submit" class="btn btn-dark"><i class="fa-solid fa-search"></i></button>
    </div>
</form>
<br>
<section class="container text-center">
    <?php if (!empty($_GET['cliente'])) : ?>
        <a href="<?= site_url('/ventas') ?>"  class="custom-btn btn btn-sm btn-dark rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0"><i class="bi bi-reply"></i>volver a ventas</a>
    <?php endif; ?>
</section>
<br>
<!-- Mostrar mensaje si no hay registros encontrados -->
<?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cliente'])) : ?>
    <?php if (empty($_GET['cliente'])) : ?>
        <p class="alert alert-warning text-center">Por favor, ingrese un término de búsqueda.</p>
    <?php elseif (empty($ventaDetalle)) : ?>
        <p class="alert alert-warning text-center">No se encontraron registros para el nombre buscado.</p>
    <?php endif; ?>
<?php endif; ?>


        <form method="GET" action="<?= base_url('/ventas'); ?>" class="d-flex mb-3">
            <label class="me-2 fw-bold">Fecha desde:</label>
            <input type="date" name="fecha_desde" class="form-control w-25 me-2" value="<?= esc($fecha_desde ?? '') ?>">

            <label class="me-2 fw-bold">Fecha hasta:</label>
            <input type="date" name="fecha_hasta" class="form-control w-25 me-2" value="<?= esc($fecha_hasta ?? '') ?>">

             <button type="submit" class="btn btn-dark" data-bs-toggle="tooltip"
          data-bs-custom-class="custom-tooltip" data-bs-title="Filtrar Fecha" data-bs-placement="top"><i class="fas fa-filter"></i> </button>
        </form>
        <!-- Mostrar mensaje si no hay registros encontrados -->
<?php if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fecha_desde']) && isset($_GET['fecha_hasta'])) : ?>
    <?php if (empty($_GET['fecha_desde']) || empty($_GET['fecha_hasta'])) : ?>
        <p class="alert alert-warning text-center">Por favor, ingrese un rango de fechas para la búsqueda.</p>
    <?php elseif (empty($ventas)) : ?>
        <p class="alert alert-warning text-center">No se encontraron registros en ese periodo de tiempo.</p>
    <?php endif; ?>
<?php endif; ?>
      <div class="table-responsive" >
  <table class="table table-sm table-hover align-middle text-center">

    <thead class="table-dark">
      <tr>
        <th class="text-nowrap">Venta ID</th>
        <?php if (session()->get('id_perfil') == 2): ?>
          <th class="text-nowrap">Usuario ID</th>
        <?php endif; ?>
        <th>Cliente</th>
        <th class="text-nowrap">Fecha</th>
        <th class="text-nowrap">Total</th>
        <th class="text-nowrap">Detalles</th>
        <th class="text-nowrap">Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ventaDetalle as $detalle): ?>
        <tr>
          <td class="text-nowrap"><?= esc($detalle['id']) ?></td>

          <?php if (session()->get('id_perfil') == 2): ?>
            <td class="text-nowrap"><?= esc($detalle['usuario_id']) ?></td>
          <?php endif; ?>

          <td class="text-nowrap"><?= esc($detalle['nombre_comprador']) ?></td>
          <td class="text-nowrap"><?= date('d/m/Y H:i', strtotime($detalle['fecha'])) ?></td>
          <td class="fw-bold text-success text-nowrap">$<?= number_format($detalle['total_venta'], 2) ?></td>
          <td class="text-nowrap">
            <form action="<?= base_url('facturas/' . $detalle['id']) ?>" method="post" style="display: inline;">
              <button type="submit" class="btn btn-sm btn-outline-dark">
                <i class="fa-solid fa-file-invoice"></i> Factura
              </button>
            </form>
          </td>
          <td class="text-nowrap">
            <?php 
              $estado = esc($detalle['estado']);
              $ventaId = esc($detalle['id']);
              $badge = match ($estado) {
                'pendiente'   => ['label' => ' Pendiente',   'class' => 'bg-danger'],
                'preparando'  => ['label' => ' Preparando', 'class' => 'bg-warning text-dark'],
                'despachado'  => ['label' => ' Despachado',  'class' => 'bg-info text-dark'],
                'entregado'   => ['label' => ' Entregado',   'class' => 'bg-success'],
                default       => ['label' => '❓ Desconocido', 'class' => 'bg-secondary']
              };
            ?>

            <div class="dropdown">
              <button class="btn btn-sm dropdown-toggle <?= $badge['class'] ?>" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $badge['label'] ?>
              </button>
              <ul class="dropdown-menu shadow border-0">
                <?php 
                  $estadosDisponibles = [
                    'pendiente'   => ' Pendiente',
                    'preparando'  => ' Preparando',
                    'despachado'  => ' Despachado',
                    'entregado'   => ' Entregado'
                  ];
                  foreach ($estadosDisponibles as $valor => $texto):
                    if ($valor === $estado) continue;
                ?>
                  <li>
                    <form action="<?= base_url('ventas/actualizarEstado') ?>" method="post" class="px-3 py-1">
                      <input type="hidden" name="venta_id" value="<?= $ventaId ?>">
                      <input type="hidden" name="estado" value="<?= $valor ?>">
                      <button type="submit" class="dropdown-item text-dark">
                        <?= $texto ?>
                      </button>
                    </form>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>



                  <!-- Paginador -->
        <?php if (isset($paginador)) : ?>
            <div class="mt-4">
                <?= $paginador->simpleLinks('default', 'bootstrap') ?>
            </div>
        <?php endif; ?>
      

<?= $this->endSection() ?>