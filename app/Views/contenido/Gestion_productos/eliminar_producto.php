<!-- app/Views/Gestion_productos/productos.php -->
<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<section>
<h1 class="text-center mt-3">Tabla de Productos Eliminados</h1>

<section class="container mt-4 text-center">
<form action="<?= base_url('/buscar_eliminado') ?>" method="post" class="d-flex">
        <input class="form-control me-2" type="text" name="search" 
        placeholder="🔍 Buscar producto..." 
               value="<?= esc($search ?? '') ?>" 
               aria-label="Buscar">
        <button class="btn btn-outline-success" type="submit">
             Buscar
        </button>
    </form>
<br>
<?php if (!empty($search)) : ?>

    <a href="<?= site_url('/productos_eliminados') ?>"  class="custom-btn btn btn-sm btn-dark rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0">Ver todos los eliminados</a>
<?php endif; ?>

<a href="<?= site_url('/productosadmin') ?>"  class="custom-btn btn btn-sm btn-dark rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0"><i class="bi bi-reply"></i>volver a productos</a>
</section>





    <div class="container mt-5">
    <div class="table-responsive">
        <table   class="table table-dark table-hover ">
            <thead class="table-dark">
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Fecha Modificación</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody >
        
                <?php foreach ($producto as $producto) : ?>
                    <?php if ($producto['estado'] == 0) : ?>
                        <tr>
                        <td><?= $producto['idProducto'] ?></td>
                        <td><?= $producto['nombre_producto'] ?></td>
                        <td><?= $categoriaMap[$producto['id_categoria']] ?? 'Sin categoria' ?></td> <!-- Obtener descripción de categoria -->
                        <td><img src="<?= base_url() ?>/assets/uploads/<?= $producto['imagen'] ?>" alt="Imagen del producto" style="max-width: 100px; max-height: 100px;"></td>
                        <td><?= $producto['precio'] ?></td>
                      
                        <td><?= $producto['stock'] ?></td>
                       
                        <td><?= $producto['fecha_modificacion'] ?></td>
                        <td><?= $producto['estado'] == 1 ? 'Activo' : 'Inactivo' ?></td>
                            <td>
                                <div class="px-3 py-2">
                            <form  action="<?= base_url('product/change_baja/' . $producto['idProducto']) ?>" method="post" style="display: inline;">
    <button  type="submit" class="btn btn-sm btn-success">Cambiar a Activo</button>
    
</form>
</div>

                            </td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>   <?php if (isset($paginador)) : ?>
    <div>
        <?= $paginador->simpleLinks('default', 'bootstrap') ?>
    </div>
<?php endif; ?>
    </div>

</section>
<?= $this->endSection() ?>