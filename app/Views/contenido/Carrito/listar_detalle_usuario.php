<style>
@media print {
    body * {
        visibility: hidden;
    }

    #factura-contenido, #factura-contenido * {
        visibility: visible;
    }

    #factura-contenido {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }

    /* Opcional: ocultar botones de imprimir */
    .btn, .no-print {
        display: none !important;
    }
}
</style>

<section>
<div>
    <!--recuperamos datos con la funcion flashdata para mostralos en la vista -->
    <?php if (session()->getFlashdata('success')) {
        echo "
        <div class='mt-3b mb-3 ms-3 me-3 h4 text-center alert alert-success alert-dismissible'>'
        <button type= 'button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('
        succes') .  "
        </div>";
    } ?>
    
</div>

<div id="factura-contenido">
<div class="container">
    <a href="<?php echo base_url('listar-compras') ?>" class="btn btn-outline-secondary btn-sm mt-3">
    <i class="fa-solid fa-arrow-left me-1"></i> Regresar
</a>
<br>
<br>
<div class="card border-secondary ">
    <div class="card-header bg-dark text-white text-center">
         <div class="d-flex align-items-center mb-2 mb-md-0">
         <img class="logoTienda img-fluid" src="<?php echo base_url('../assets/img/guitarCent_logo.png'); ?>" alt="Logo" style="height: 40px;" class="me-3 img-fluid">
         <h4 class="mb-0 logoTienda"><a class="text-decoration-none text-white" href="<?php echo base_url('/');?>">Guitar N' Cent Store</a></h1>
      </div>
        <h4 class="fw-bold mb-0">Factura de mi compra</h4>
         <p class="text-light text-center">Detalles completos de la compra realizada.</p>
    </div>
    <div class="card-body">
        <!-- Información del Cliente -->
        <div class="mb-4">
            <h5 class="fw-bold text-secondary">Información del Cliente</h5>
            <p class="mb-1"><strong>Nombre:</strong> <?= esc($nombre_comprador) ?></p>
            <?php if (!empty($persona)): ?>
                <p class="mb-1"><strong>Dirección:</strong> <?= esc($persona['direccion'] ?? 'N/A') ?></p>
                <p class="mb-1"><strong>Teléfono:</strong> <?= esc($persona['telefono'] ?? 'N/A') ?></p>
                <p class="mb-1"><strong>Ciudad:</strong> <?= esc($persona['ciudad'] ?? 'N/A') ?></p>
                <p class="mb-1"><strong>País:</strong> <?= esc($persona['pais'] ?? 'N/A') ?></p>
                <p class="mb-1"><strong>DNI:</strong> <?= esc($persona['dni'] ?? 'N/A') ?></p>
                <p class="mb-1"><strong>Código Postal:</strong> <?= esc($persona['codigo_postal'] ?? 'N/A') ?></p>
            <?php endif; ?>
        </div>

        <!-- Tabla de Productos -->
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th>Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Precio Unitario</th>
                        <th class="text-center">SubTotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0; 
                    foreach ($productos as $index => $producto): 
                        $subtotal = $detalles[$index]['cantidad'] * $detalles[$index]['precio'];
                        $total += $subtotal; 
                    ?>
                        <tr>
                            <td>
  <div class="d-flex align-items-center">
    <div style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;" class="me-3 bg-white rounded shadow-sm">
      <img 
        src="<?= base_url('/assets/uploads/' . $producto['imagen']) ?>" 
        alt="<?= esc($producto['nombre_producto']); ?>"
        class="img-fluid"
        style="max-width: 100%; max-height: 100%; object-fit: contain;"
      >
    </div>
    <span class="fw-semibold"><?= esc($producto['nombre_producto']); ?></span>
  </div>
</td>

                            <td class="text-center"><?= esc($detalles[$index]['cantidad']); ?></td>
                            <td class="text-center">$<?= number_format($detalles[$index]['precio'], 2); ?></td>
                            <td class="text-center fw-bold text-success">$<?= number_format($subtotal, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-dark text-end">
        <h4 class="text-white fw-bold mb-0">Total: 
            <span class="text-success">$<?= number_format($total, 2); ?></span>
        </h4>
    </div>
</div>
</div>
<div class="text-center mt-4 no-print">
    <button class="btn btn-dark btn-sm px-4 py-2" onclick="window.print()">
        <i class="fa-solid fa-print me-2"></i> Imprimir
    </button>
</div>

<br>
</section>

