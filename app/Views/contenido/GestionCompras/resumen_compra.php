<style>
    @media (max-width: 768px) {
    h2, h3, h4 {
        font-size: 1.2rem;
    }
    .table thead {
        display: none;
    }
    .table tbody td {
        display: block;
        width: 100%;
        text-align: right;
        padding-left: 50%;
        position: relative;
    }
    .table tbody td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 50%;
        padding-left: 1rem;
        font-weight: bold;
        text-align: left;
    }
}

</style>
<br>
<?php if (session()->getFlashdata('mensaje')) : ?>
    <div class="alert alert-warning position-relative shadow-sm rounded-3 p-3" id="collapseExample2">
        <?= session()->getFlashdata('mensaje'); ?>
        <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2" class="position-absolute top-0 end-0 m-3">
            <i class="fa-solid fa-xmark fa-xl text-dark"></i>
        </a>
    </div>
<?php endif; ?>

<div class="container my-4">
<?php if ($carrito) : ?>
    <div class="card shadow-sm rounded-4 p-4">
        <h2 class="mb-4">Resumen de Compra</h2>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success shadow-sm rounded-3"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>
        
        <h4 class="mt-4">Datos del Usuario</h4>
        <ul class="list-unstyled">
            <li><strong>Nombre:</strong> <?= esc($usuario['nombre']) . ' ' . esc($usuario['apellido']); ?></li>
            <li><strong>Email:</strong> <?= esc($usuario['email']); ?></li>
        </ul>

        <h4 class="mt-4">Datos de Envío</h4>
        <?php if ($datosPersona) : ?>
            <ul class="list-unstyled">
                <li><strong>Dirección:</strong> <?= esc($datosPersona['direccion']); ?></li>
                <li><strong>Teléfono:</strong> <?= esc($datosPersona['telefono']); ?></li>
                <li><strong>Ciudad:</strong> <?= esc($datosPersona['ciudad']); ?></li>
                <li><strong>País:</strong> <?= esc($datosPersona['pais']); ?></li>
                <li><strong>DNI:</strong> <?= esc($datosPersona['dni']); ?></li>
                <li><strong>Código Postal:</strong> <?= esc($datosPersona['codigo_postal']); ?></li>
            </ul>
        <?php else : ?>
            <div class="alert alert-warning rounded-3 shadow-sm">⚠️ Debe completar sus datos antes de confirmar la compra.</div>
            <a href="<?= base_url('completar-datos-compra'); ?>" class="btn btn-warning rounded-pill shadow-sm px-4">Completar Datos</a>
        <?php endif; ?>

        <h4 class="mt-5">🛍️ Productos a comprar</h4>
        <div class="table-responsive">
            <table class="table table-hover align-middle text-center mt-3">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $gran_total = 0;
                    $i = 1;
                    if (!empty($carrito)) :
                        foreach ($carrito as $item) :
                            $totalItem = $item['price'] * $item['qty'];
                            $gran_total += $totalItem;
                    ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= esc($item['name']); ?></td>
                                <td>$<?= number_format($item['price'], 2); ?></td>
                                <td><?= esc($item['qty']); ?></td>
                                <td>$<?= number_format($totalItem, 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-primary text-dark fw-bold">
                            <td colspan="4" class="text-end">Total:</td>
                            <td>$<?= number_format($gran_total, 2); ?></td>
                        </tr>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">No hay productos en el carrito.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if ($datosPersona) : ?>
            <div class="d-flex justify-content-end mt-4">
                <a href="<?= base_url('carrito-comprar'); ?>" class="btn btn-success rounded-pill shadow px-4 py-2">
                    <i class="bi bi-check-circle me-2"></i> Confirmar Compra
                </a>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
</div>

<br>