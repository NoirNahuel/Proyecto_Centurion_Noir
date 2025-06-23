<style>
    .table td, .table th {
    vertical-align: middle;
}

.card-body .btn {
    font-size: 0.85rem;
}

.table-responsive {
    border-radius: 0.5rem;
    overflow: hidden;
}

</style>
<section style="min-height: 400px;">
<div >
<div>
<?php if(session("msg")):?>
   <div class="container alert alert-success text-center" style="width: 30%;">
      <?php echo session("msg"); ?>
      <i class="bi bi-check-lg text-success"></i>
      </div>
      <?php endif?>
      </div>
<?php
        $session = session();
        $cart = \Config\Services::cart();
        $cart = $cart->contents();
        if (empty($cart)) : ?>
       
    <div class="d-flex justify-content-center align-items-center" style="min-height: 60vh;">
        <div class="text-center">
            <h4 class="mb-4 text-muted">🛒 No hay productos en el carrito</h4>
            <a href="<?= base_url('productos') ?>" class="btn btn-success rounded-pill shadow-sm px-4">
                <i class="bi bi-arrow-left-circle me-2"></i>Volver al Catálogo
            </a>
        </div>
    </div>
<?php endif; ?>

    
        
        <?php if (session()->getFlashdata('error')): ?>
    <!-- Modal stock maximo -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title text-danger " id="errorModalLabel">¡Atención!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?= session()->getFlashdata('error'); ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>


        
         <?php if (session()->getFlashdata('mensaje')) { ?>
                        <div class="alert alert-warning collapse show" id="collapseExample2">
                        <?= session()->getFlashdata('mensaje');?>
                        <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27; color:black;"></i></a>
                        </div>
                        <?php } ?>
      
                        <?php if ($cart == true) : ?>
    <div class="container mt-5"> <div>
    <a class="btn btn-sm btn-success rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0"  href="productos"> 
        <i class="bi bi-arrow-left-circle me-2"></i>Volver al Catalogo</a></div><br>
    <div class="cart-message text-center">
       
        <div class="card  text-white shadow">
            
          <div class="card-header text-center bg-light">
    <h3 class="mb-0 text-dark fw-bold">🛒 Tu Carrito</h3>
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <?php
            echo form_open('carrito_actualiza');
            $gran_total = 0;
            $i = 1;
            foreach ($cart as $item) :
                echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                echo form_hidden('cart[' . $item['id'] . '][stock]', $item['options']['stock']);
            ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td>
                        <?php 
                            $imagen = $item['options']['imagen'] ?? 'default.jpg';
                        ?>
                        <img src="<?= base_url('assets/uploads/' . esc($imagen)) ?>" 
                             alt="<?= esc($item['name']) ?>" 
                             class="img-fluid rounded" style="width: 60px; height: 60px; object-fit: cover;">
                    </td>
                    <td><?= esc($item['name']) ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <span class="fw-semibold"><?= $item['qty'] ?></span>
                            <?= anchor('sumar_carrito?id=' . $item['rowid'], '<i class="fa fa-plus"></i>', ['class' => 'btn btn-sm btn-outline-success']) ?>
                            <?= anchor('restar_carrito?id=' . $item['rowid'], '<i class="fa fa-minus"></i>', ['class' => 'btn btn-sm btn-outline-secondary']) ?>
                        </div>
                    </td>
                    <?php $gran_total += $item['price'] * $item['qty']; ?>
                    <td>$<?= number_format($item['subtotal'], 2) ?></td>
                    <td>
                        <?= anchor('carrito_elimina/' . $item['rowid'], '<i class="fa fa-trash"></i>', ['class' => 'btn btn-sm btn-outline-danger']) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="table-light">
                <td></td>
                <td colspan="4" class="text-end fw-bold">Total:</td>
                <td colspan="2" class="fw-bold text-success">$<?= number_format($gran_total, 2) ?></td>
            </tr>
            <tr>
                <td colspan="5"></td>
                <td>
                    <button type="button" class="btn btn-outline-danger w-100" onclick="window.location = 'borrar'">
                        <i class="fa fa-trash"></i> Vaciar Carrito
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-outline-success w-100" onclick="window.location = 'verificarDatosCompra'">
                        <i class="fa fa-check"></i> Continuar compra
                    </button>
                </td>
            </tr>
            <?= form_close(); ?>
        </table>
    </div>
</div>

    </div>
<?php endif; ?>
<!-- Modal de Alerta de Stock -->
<div class="modal fade" id="stockModal" tabindex="-1" aria-labelledby="stockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stockModalLabel">Aviso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                No puedes agregar más cantidad. Stock máximo alcanzado.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

</section>
<br>
<br>
<script>// Modal stock maximo
    document.addEventListener("DOMContentLoaded", function () {
        var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));

        <?php if (session()->getFlashdata('error')): ?>
            errorModal.show(); // Mostrar el modal
            setTimeout(function () {
                errorModal.hide(); // Cerrar el modal después de 5 segundos
            }, 5000);
        <?php endif; ?>
    });
</script>

<?php $session = session();
        $cart = \Config\Services::cart();
        $cart = $cart->contents();?>



  