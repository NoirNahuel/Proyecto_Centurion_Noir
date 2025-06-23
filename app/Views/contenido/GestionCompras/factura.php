<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
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
<section  id="factura-contenido">
    <div class="container">
        <!-- Navegación -->
        <a href="<?= site_url('/ventas') ?>" class="btn btn-outline-secondary btn-sm mt-3">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver
        </a>

        <!-- Encabezado de factura -->
        <h1 class="text-center fw-bold mt-4">Factura de Venta</h1>
        <p class="text-center text-muted">Detalles completos de la transacción realizada.</p>

        <!-- Tabla resumen de la factura -->
        <div class="container mt-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h3 class="fw-bold mb-0">Resumen de la Venta</h3>
                </div>
                <div class="card-body">
                <table class="table table-borderless">
    <tr>
        <th>Venta ID</th>
        <td><?= $ventaCabecera['id'] ?></td>
    </tr>
    <tr>
        <th>Fecha</th>
        <td><?= date('d/m/Y', strtotime($ventaCabecera['fecha'])) ?></td>
    </tr>
    <tr>
        <th>Comprador</th>
        <td><?= esc($nombre_comprador) ?></td>
    </tr>
    <?php if (!empty($persona)): ?>
    <tr>
        <th>Datos del Comprador</th>
        <td>
            <strong>Dirección:</strong> <?= esc($persona['direccion']); ?><br>
            <strong>Teléfono:</strong> <?= esc($persona['telefono']); ?><br>
            <strong>Ciudad:</strong> <?= esc($persona['ciudad']); ?><br>
            <strong>País:</strong> <?= esc($persona['pais']); ?><br>
            <strong>DNI:</strong> <?= esc($persona['dni']); ?><br>
            <strong>Código Postal:</strong> <?= esc($persona['codigo_postal']); ?>
        </td>
    </tr>   <?php endif; ?>
    <tr>
        <th>Total</th>
        <td class="text-success fw-bold">$<?= number_format($ventaCabecera['total_venta'], 2) ?></td>
    </tr>
</table>

                </div>
            </div>
        </div>

        <!-- Detalles de la venta -->
        <h2 class="mt-5 text-center">Detalles de los Productos</h2>
        <div class="container mt-3">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalFactura = 0;
                        foreach ($detalles as $detalle): 
                            $subtotal = $detalle['cantidad'] * $detalle['precio'];
                            $totalFactura += $subtotal;
                        ?>
                            <tr class="text-center">
                                <td><?= $productos[$detalle['idProducto']] ?></td>
                                <td><?= $detalle['cantidad'] ?></td>
                                <td>$<?= number_format($detalle['precio'], 2) ?></td>
                                <td class="text-success fw-bold">$<?= number_format($subtotal, 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Total general -->
        <div class="text-end mt-4">
            <h4 class="fw-bold">Total a Pagar: 
                <span class="text-success">$<?= number_format($totalFactura, 2) ?></span>
            </h4>
        </div>

        <!-- Botón imprimir -->
            <div class="text-center mt-4 no-print">
            <button class="btn btn-dark btn-sm px-4 py-2" onclick="window.print()">
                <i class="fa-solid fa-print me-2"></i> Imprimir
            </button>
        </div>
        <br>
    </div>
</section>
<?= $this->endSection() ?>