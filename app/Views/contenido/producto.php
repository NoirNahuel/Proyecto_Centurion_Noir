
<div>
<br>
<br>

<nav  class="d-flex justify-content-center" style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item "><a class="text-secondary text-decoration-none" href="<?php echo base_url('principal');?>">Inicio</a></li>
    <li class="breadcrumb-item navbar-brand" aria-current="page">Producto</li>
  </ol>
</nav>
 <h1  class="text-center">Nuestros Productos MateCamp</h1>
 <br>   
 <section class="container mt-4">
    <!-- Verifica si hay un mensaje flash en la sesión -->
    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
            <!-- Ícono decorativo para hacerla más atractiva -->
            <i class="bi bi-check-circle-fill me-2"></i>
            <!-- Mensaje de sesión -->
            <span><?= session()->getFlashdata('mensaje'); ?></span>
            <!-- Botones de acción -->
            <div class="ms-auto">
                <button 
                    type="button" 
                    class="btn btn-primary btn-sm" 
                    onclick="window.location.href='<?= base_url('carrito'); ?>'">
                    Ir al carrito
                </button>
                <button 
                    type="button" 
                    class="btn-close ms-2" 
                    data-bs-dismiss="alert" 
                    aria-label="Cerrar">
                </button>
            </div>
        </div>
    <?php endif; ?>
</section>
<!-- Modal carrito -->
<div  class="modal fade" id="modalProductoExistente" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title fw-bold" id="modalLabel">
          <i class="bi bi-exclamation-triangle-fill me-2"></i> Aviso
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <i class="bi bi-cart-x-fill text-dark display-3"></i>
        <p class="mt-3 fs-5 text-muted">El producto ya se ha agregado al carrito.</p>
        <p class="mt-3 fs-5 text-muted"> <small>Ir al carrito para ver cantidad.</small></p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-dark px-4 fw-bold" data-bs-dismiss="modal">Entendido</button>
      </div>
    </div>
  </div>
</div>

<!-- Mostrar el Modal si hay un producto repetido -->
<?php if (session()->getFlashdata('producto_existente')) : ?>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    var myModal = new bootstrap.Modal(document.getElementById('modalProductoExistente'));
    myModal.show();
  });
</script>
<?php endif; ?>






<section>
<h2 class="text-center mt-3">Catalogo</h2>
    <section class="container mt-4 text-center">
        <form action="<?= base_url('/buscar_catalogo') ?>" method="post" class="mb-3">
            <div class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Buscar Producto">
                <button type="submit" class="btn btn-outline-primary">Buscar</button>
            </div>
        </form>

       
    </section>
<br>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-uppercase" href="#">Categorías</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCategorias" aria-controls="navbarCategorias" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarCategorias">
            <ul class="navbar-nav mb-2 mb-lg-0 text-center" id="listaCategorias">
                <?php foreach ($categorias as $categoria): ?>
                    <li class="nav-item">
                        <form action="<?= base_url('productos') ?>" method="post" class="d-inline categoria-form">
                            <input type="hidden" name="id_categoria" value="<?= $categoria['id_categoria'] ?>">
                            <button type="submit" class="nav-link btn btn-link categoria-btn" data-id="<?= $categoria['id_categoria'] ?>">
                                <?= esc($categoria['descripcion']) ?>
                            </button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php if (!empty($search)) : ?>
                <a href="<?= site_url('/productos') ?>" class="btn btn-sm btn-success rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0">
                    <i class="bi bi-arrow-left-circle me-2"></i> Volver al catálogo
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<script>//La categoría activa cambia de color
    document.addEventListener("DOMContentLoaded", function () {
        let categoriaActiva = localStorage.getItem("categoria_activa");//para ver si hay una categoría activa guardada.

        if (categoriaActiva) {//activa estilo btn
            let botones = document.querySelectorAll(".categoria-btn");
            botones.forEach(btn => {
                if (btn.dataset.id === categoriaActiva) {//guarda id
                    btn.classList.add("text-primary", "fw-bold");
                }
            });
        }

        document.querySelectorAll(".categoria-form").forEach(form => {
            form.addEventListener("submit", function () {
                let categoriaId = this.querySelector(".categoria-btn").dataset.id;
                localStorage.setItem("categoria_activa", categoriaId);
            });
        });
    });
</script>



    </div>
    <div class="container">
    <div class="row g-4 justify-content-center">
        <?php foreach ($producto as $producto) : ?>
            <div class="col-12 col-md-3 col-lg-3">
                <div class="card h-100 d-flex flex-column shadow-sm">
                    <img src="<?= base_url() ?>/assets/uploads/<?= $producto['imagen'] ?>" alt="<?= $producto['nombre_producto']; ?>" class="card-img-top">
                    <div class="card-body d-flex flex-column">
                        <div class="text-center">
                            <a href="#" class="text-reset text-decoration-none fw-bold" data-bs-toggle="modal" data-bs-target="#productoModal<?= $producto['idProducto'] ?>">
                                <i class="bi bi-info-circle-fill"></i> Descripción
                            </a>
                        </div>
                        <?php foreach ($categorias as $categoria) { ?>
                            <?php if ($categoria['id_categoria'] == $producto['id_categoria']) : ?>
                                <span class=" text-center mt-2"><?php echo $categoria['descripcion']; ?></span>
                            <?php endif ?>
                        <?php } ?>
                        <h5 class="text-center mt-2"><?php echo $producto['nombre_producto']; ?></h5>
                        <p class="product-price text-center text-dark fw-bold">$<?php echo $producto['precio']; ?></p>

                        <?php if ($producto['estado'] == 0 || $producto['stock_min'] == $producto['stock'] || $producto['stock'] == 0) : ?>
                            <p class=" text-danger text-center mt-auto">Sin Stock</p>
                            <p class="badge bg-danger text-white text-center mt-auto">No disponible</p>
                        <?php else : ?>
                            <p class="text-center text-muted">Stock: <?php echo $producto['stock']; ?></p>
                            <p class="badge bg-success text-white text-center mt-auto">Disponible</p>

                            <div class="text-center mt-auto">
                                <?php
                                echo form_open('carrito_agrega');
                                echo form_hidden('idProducto', $producto['idProducto']);
                                echo form_hidden('precio', $producto['precio']);
                                echo form_hidden('nombre_producto', $producto['nombre_producto']);
                                echo form_hidden('stock', $producto['stock']);
                                echo form_hidden('stock_min', $producto['stock_min']);
                                ?>
                                <button class="btn btn-dark btn-sm mt-2">
                                    <i class="bi bi-cart-plus"></i> Agregar al Carrito
                                </button>
                                <?php echo form_close(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

           <!-- Modal del producto mejorado -->
<div class="modal fade" id="productoModal<?= $producto['idProducto'] ?>" tabindex="-1" aria-labelledby="productoModalLabel<?= $producto['idProducto'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-body p-4">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Imagen del producto -->
                        <div class="col-md-5 text-center">
                            <img src="<?= base_url() ?>/asset/uploads/<?= $producto['imagen'] ?>" 
                                 alt="<?= $producto['nombre_producto']; ?>" 
                                 class="img-fluid rounded-3 shadow-sm">
                        </div>
                        <!-- Información del producto -->
                        <div class="col-md-7">
                            <h3 class="fw-bold text-primary"><?= $producto['nombre_producto']; ?></h3>
                            <p class="text-muted"><?= $producto['descripcion_producto']; ?></p>
                            <div class="mb-3">
                                <span class="fs-4 fw-bold text-success">Precio: $<?= number_format($producto['precio'], 2, ',', '.'); ?></span>
                                <br>
                                <span class="text-muted text-decoration-line-through">Precio lista: $<?= number_format($producto['precio'] + 500, 2, ',', '.'); ?></span>
                                <br>
                                <span class="fs-4 fw-bold text-secondary">Stock:<?= number_format($producto['stock']); ?></span>
                            </div>
                            <!-- Botón de cierre -->
                            <button type="button" class="btn btn-danger px-4 fw-bold" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle"></i> Cerrar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <?php endforeach; ?>
    </div>
</div>

<br>
<br>
      
        <?php if (isset($paginador)) : ?>
    <div>
        <?= $paginador->simpleLinks('default', 'bootstrap') ?>
    </div>
<?php endif; ?>
        </div>


      
  

</section>
</div>
