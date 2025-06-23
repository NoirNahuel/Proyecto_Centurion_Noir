<style>
    /* Estilo general del dropdown del carrito */
.cart-dropdown {
  font-size: 0.95rem;
  color: #212529;
  max-height: 400px;
  overflow-y: auto;
  scrollbar-width: thin;
}

.cart-dropdown::-webkit-scrollbar {
  width: 6px;
}
.cart-dropdown::-webkit-scrollbar-thumb {
  background-color: #c0c0c0;
  border-radius: 3px;
}

.cart-item {
  transition: background-color 0.2s ease;
}
.cart-item:hover {
  background-color: #f8f9fa;
}

.btn-outline-danger, .btn-primary {
  border-radius: 0.5rem;
  font-weight: 500;
}

.cart-dropdown .btn {
  font-size: 0.85rem;
  padding: 5px 12px;
}


</style>
 <div class="cart-dropdown px-3 py-2">
    <h6 class="mb-3 fw-bold text-dark-emphasis">🛒 Tu Carrito</h6>

    <?php if(session("msg")): ?>
        <div class="alert alert-success text-center p-2">
            <?= session("msg"); ?>
            <i class="bi bi-check-lg text-success"></i>
        </div>
    <?php endif; ?>

    <?php 
        $session = session();
        $cart = \Config\Services::cart();
        $cart = $cart->contents();
    ?>

    <?php if (empty($cart)) : ?>
        <div class="text-center text-muted small py-2">
            <p>No hay productos en tu carrito.</p>
            <a class="btn btn-sm btn-outline-dark rounded-pill" href="<?= base_url('productos') ?>">
                <i class="bi bi-arrow-left-circle me-1"></i> Catálogo
            </a>
        </div>
    <?php else: ?>
        <?php $gran_total = 0; ?>
        <div class="cart-items">
            <?php foreach ($cart as $item): 
                $gran_total += $item['price'] * $item['qty'];
            ?>
                <div class="d-flex justify-content-between align-items-center cart-item border-bottom py-2">
                    <div class="d-flex align-items-center" style="max-width: 200px;">
            <!-- Imagen -->
            <?php $imagen = isset($item['options']['imagen']) ? $item['options']['imagen'] : 'default.jpg'; ?>
<img src="<?= base_url('assets/uploads/' . esc($imagen)) ?>" 
     alt="<?= esc($item['name']) ?>" 
     class="img-thumbnail me-2" style="width: 40px; height: 40px;">

            
            <!-- Nombre y cantidad -->
            <div class="text-truncate">
                <span class="fw-semibold"><?= esc($item['name']) ?></span>
                <div class="small text-muted">x<?= esc($item['qty']) ?></div>
            </div>
        </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="d-flex justify-content-between fw-bold mt-3 px-1">
            <span class="text-dark">Total:</span>
            <span class="text-primary">$<?= number_format($gran_total, 2) ?></span>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-3">
            <button class="btn btn-sm btn-outline-danger px-3" onclick="window.location = '<?= base_url('borrar') ?>'">
                🗑 Vaciar
            </button>
            <button class="btn btn-sm btn-primary px-3" onclick="window.location = '<?= base_url('carrito') ?>'">
                🛍 Ir al Carrito
            </button>
        </div>
    <?php endif; ?>
</div>


