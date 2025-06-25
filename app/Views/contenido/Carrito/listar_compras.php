
<div class="container mt-5">
    <h1 class="text-center fw-bold">Mis compras</h1>
    <div>
        <?php if(session("msg")):?>
            <br>
        <div class="container alert alert-success text-center" style="width: 30%;">
            <?php echo session("msg"); ?>
            <i class="bi bi-check-lg text-success"></i>
            </div>
            <?php endif?>
      </div>
    <!-- Formulario para el filtro -->
    <form method="GET" action="<?= base_url('listar-compras'); ?>" class="d-flex mb-3">
    <label class="me-2 fw-bold">Fecha desde:</label>
    <input type="date" name="fecha_desde" class="form-control w-25 me-2" value="<?= esc($fecha_desde ?? '') ?>">

    <label class="me-2 fw-bold">Fecha hasta:</label>
    <input type="date" name="fecha_hasta" class="form-control w-25 me-2" value="<?= esc($fecha_hasta ?? '') ?>">

    <button type="submit" class="btn btn-dark" data-bs-toggle="tooltip"
          data-bs-custom-class="custom-tooltip" data-bs-title="Filtrar Fecha" data-bs-placement="top"><i class="fas fa-filter"></i> </button>
</form>



    <a href="<?= base_url('') ?>" class="btn btn-dark mb-2">Regresar</a>

    <div class="table-responsive">
    <table class="table table-success table-striped container-fluid" id="tabla">
        <thead class="table-dark">
            <tr>
                <th scope="col" aria-label="ID de la compra">Id</th>
                <th scope="col" aria-label="Producto">Producto</th>
                <th scope="col" aria-label="Fecha de compra">Fecha</th>
                <th scope="col" aria-label="Total de la compra">Total</th>
                <th scope="col" aria-label="Acciones disponibles" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($ventas) && is_array($ventas)): ?>
               <?php foreach ($ventas as $venta): ?>
    <tr>
        <td><?= esc($venta['id']); ?></td>
        <td>
            <?php
            $productos = $productosPorVenta[$venta['id']] ?? [];
            echo implode(', ', array_map('esc', $productos));
            ?>
        </td>
                        <td><?= esc($venta['fecha']); ?></td>
                        <td><?= esc(number_format($venta['total_venta'], 2, ',', '.')); ?> $</td>
                        <td class="text-center">
                            <div class="text-nowrap">
                            <a href="<?= base_url('listar-detalle_usuario/'.$venta['id']); ?>" class="btn btn-dark btn-sm mt-1">
                                Ver detalles
                            </a>
                            </div>
                        </td>
                    </tr>
                   
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        No hay compras registradas.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

     <!-- Paginador -->
        <?php if (isset($paginador)) : ?>
            <div class="mt-4">
                <?= $paginador->simpleLinks('default', 'bootstrap') ?>
            </div>
        <?php endif; ?>

</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
</script>
