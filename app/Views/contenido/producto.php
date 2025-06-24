<style>
    .small-card {
    font-size: 0.9rem;
    max-width: 100%;
}

.img-container {
    height: 200px; /* o el alto que prefieras */
    width: 100%;
    background-color: #f8f9fa; /* fondo claro para imágenes con transparencia */
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}

.img-container img {
    max-height: 100%;
    max-width: 100%;
    object-fit: contain;
}
.tech-card:hover {
    transform: scale(1.02);
}

.catalog-title {
    font-weight: bold;
    color: #343a40;
}

    .bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
}

.card-header h2 {
    font-size: 1.5rem;
    font-weight: bold;
}

.card-body p {
    margin-bottom: 0.6rem;
}

</style>
<div>
<br>


<nav  class="d-flex justify-content-center" style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item "><a class="text-secondary text-decoration-none" href="<?php echo base_url('principal');?>">Inicio</a></li>
    <li class="breadcrumb-item navbar-brand" aria-current="page">Producto</li>
  </ol>
</nav>
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
                    <i class="bi bi-arrow-left-circle me-2"></i> Todos los Productos
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
                    btn.classList.add("text-dark", "fw-bold");
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
 <div class="container my-5">
    <section class="catalog-container">
        <h1 class="text-center mb-4 catalog-title">
            <i class="bi bi-list-check"></i> Catálogo de Productos
        </h1>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4">
            <?php foreach ($producto as $producto) : ?>
                <div class="col">
                    <div class="card h-100 shadow-sm tech-card small-card">
                        <!-- Imagen -->
                        <!-- Contenedor de la imagen -->
                        <div class="img-container">
                            <img src="<?= base_url() ?>/assets/uploads/<?= $producto['imagen'] ?>" alt="<?= $producto['nombre_producto']; ?>">
                        </div>

                        <div class="card-body p-3">
                            <!-- Nombre del producto -->
                            <h6 class="card-title text-truncate">
                                <i class="bi bi-box-seam"></i> <?= $producto['nombre_producto']; ?>
                            </h6>

                            <!-- Categoría -->
                            <p class="card-text text-muted small mb-1">
                                <i class="bi bi-tag"></i>
                                <?php 
                                    foreach ($categorias as $categoria) {
                                        if ($categoria['id_categoria'] == $producto['id_categoria']) {
                                            echo $categoria['descripcion'];
                                            break;
                                        }
                                    }
                                ?>
                            </p>

                            <!-- Precio -->
                            <p class="card-text fw-bold text-success small mb-1">
                                <i class="bi bi-currency-dollar"></i> <?= number_format($producto['precio'], 2, ',', '.') ?>
                            </p>

                            <!-- Stock -->
                            <?php if ($producto['estado'] == 0 || $producto['stock'] <= $producto['stock_min']) : ?>
                                <p class="badge bg-danger small">No disponible</p>
                            <?php else : ?>
                                <p class="text-muted small mb-0"><i class="bi bi-boxes"></i> Stock: <?= $producto['stock']; ?></p>
                                <p class="badge bg-success small">Disponible</p>
                            <?php endif; ?>
                        </div>

                        <!-- Footer -->
                        <div class="card-footer bg-dark text-center p-2">
                            <?php if ($producto['estado'] == 0 || $producto['stock'] <= $producto['stock_min']) : ?>
                                <a href="#" class="btn btn-light btn-sm w-100 disabled">Ver detalle</a>
                            <?php else : ?>
                                <a href="#" class="btn btn-dark btn-sm w-100" data-bs-toggle="modal" data-bs-target="#productoModal<?= $producto['idProducto'] ?>">
                                    Ver detalle
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Modal del producto -->
                <div class="modal fade" id="productoModal<?= $producto['idProducto'] ?>" tabindex="-1" aria-labelledby="productoModalLabel<?= $producto['idProducto'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-body p-4">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card shadow-lg rounded">
                                            <!-- Encabezado -->
                                            <div class="card-header text-center bg-dark text-white">
                                                <h2><?= $producto['nombre_producto']; ?></h2>
                                            </div>

                                            <!-- Cuerpo de la tarjeta -->
                                            <div class="card-body bg-light">
                                                <div class="row">
                                                    <div class="col-md-5 text-center mb-3">
                                                       <div class="img-container">
                            <img src="<?= base_url() ?>/assets/uploads/<?= $producto['imagen'] ?>" alt="<?= $producto['nombre_producto']; ?>">
                        </div>
                                                           
                                                    </div>

                                                    <div class="col-md-7">
                                                        <p><strong>Descripción:</strong> <?= $producto['descripcion_producto']; ?></p>
                                                        <p><strong>Precio:</strong> $<?= number_format($producto['precio'], 2, ',', '.'); ?></p>
                                                        <p><strong>Stock:</strong> <?= $producto['stock']; ?></p>

                                                        <p><strong>Categoría:</strong>
                                                            <?php 
                                                            foreach ($categorias as $categoria) {
                                                                if ($categoria['id_categoria'] == $producto['id_categoria']) {
                                                                    echo $categoria['descripcion'];
                                                                    break;
                                                                }
                                                            }
                                                            ?>
                                                        </p>

                                                        <?php if ($producto['estado'] == 0 || $producto['stock'] <= $producto['stock_min']) : ?>
                                                            <span class="badge bg-danger">No disponible</span>
                                                        <?php else : ?>
                                                            <span class="badge bg-success">Disponible</span>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pie de tarjeta -->
                                            <div class="card-footer d-flex justify-content-between align-items-center bg-dark text-white">
                                                <button type="button" class="btn btn-outline-light btn-sm" data-bs-dismiss="modal">
                                                    <i class="bi bi-x-circle"></i> Cerrar
                                                </button>

                                                <?php if ($producto['estado'] != 0 && $producto['stock'] > $producto['stock_min']) : ?>
                                                    <?= form_open('carrito_agrega') ?>
                                                        <?= form_hidden('idProducto', $producto['idProducto']) ?>
                                                        <?= form_hidden('precio', $producto['precio']) ?>
                                                        <?= form_hidden('nombre_producto', $producto['nombre_producto']) ?>
                                                        <?= form_hidden('stock', $producto['stock']) ?>
                                                        <?= form_hidden('stock_min', $producto['stock_min']) ?>
                                                        <?= form_hidden('imagen', $producto['imagen']) ?> <!-- NUEVO -->
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="bi bi-cart-plus"></i> Agregar al carrito
                                                        </button>
                                                    <?= form_close() ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end modal-body -->
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

        <!-- Paginador -->
        <?php if (isset($paginador)) : ?>
            <div class="mt-4">
                <?= $paginador->simpleLinks('default', 'bootstrap') ?>
            </div>
        <?php endif; ?>
    </section>
</div>
