<!-- app/Views/Gestion_productos/productos.php -->
<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<section>

<div>
    <div class="row mt-3">
      <div class="col-md-6 mx-auto bg-dark rounded-top wrapper">
      <h3 class="text-white text-center pt-3">Editar Producto</h3>
      <p class="text-white text-center lead mb-3">Mate Camp</p>
        <!-- Comienzo del formulario -->
  <!--inicio de secion-->
  <div class="custom-alert">
    <!--recuperamos datos con la función Flashdata para mostrarlos-->
    <?php if (session()->getFlashdata('warning')) {
        echo "<div class='h6 text-center alert alert-warning alert-dismissible'>
              <button type='button' class='btn-close' data-bs-dismiss='alert'></button>" . session()->getFlashdata('warning') . "
           </div>";
    }
    ?>
</div>
<?php if (session()->getFlashdata('mensaje')) { ?>
                        <div class="alert alert-warning collapse show" id="collapseExample2">
                        <?= session()->getFlashdata('mensaje');?>
                        <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="true" aria-controls="collapseExample2"><i class="fa-solid fa-xmark fa-xl" style="position: absolute; right: 15px; top: 27; color:black;"></i></a>
                        </div>
                        <?php } ?>



<!-- Resto del código del formulario -->


    <?php  $validation = \Config\Services::validation();?>
    
    <?php if (session()->has('errors')) : ?>
    <div class="mensajeBad" role="alert">
        <ul>
            <?php foreach (session('errors') as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<!-- Resto del código del formulario -->


 
             
           
    <form action="<?= base_url('product/editar/' . $producto['idProducto']) ?>"  method="post" enctype="multipart/form-data">
    <div class=" text-white imb-3">
        <label for="nombre_pro" class="form-label">Nombre del producto:</label>
        <input type="text" name="nombre_producto" placeholder="nombre producto" value="<?= $producto['nombre_producto'] ?>" class="form-control" >
    </div>
  
    <div class="text-white mb-3">
    <label for="id_categoria" class="text-white">Categoría:</label>
    <select name="id_categoria" class="form-select" id="form-select"> 
        <option value="<?= $producto['id_categoria'] ?>">Cambiar categoria 
            <?php 
                foreach ($categorias as $categoria) {
                    if ($categoria['id_categoria'] == $producto['id_categoria']) {
                        echo esc($categoria['descripcion']); // Muestra la categoría seleccionada
                    }
                }
            ?> a:
        </option>
        
        <?php foreach($categorias as $categoria) : ?>
            <option value="<?= $categoria['id_categoria']; ?>" <?= ($categoria['id_categoria'] == $producto['id_categoria']) ? 'selected' : '' ?>>
                <?= esc($categoria['descripcion']); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

    <div class=" text-white mb-3">
        <label for="precio" class="form-label">Precio:</label>
        <input type="number" name="precio" placeholder="precio" value="<?= $producto['precio'] ?>"  class="form-control">
    </div>
  
    <div class= " text-white  mb-3">
        <label for="stock" class="form-label">Stock:</label>
        <input type="number" name="stock" placeholder="stock"   value="<?= $producto['stock'] ?>"   class="form-control" >
    </div>
    <div class=" text-white  mb-3">
        <label for="stock_min" class="form-label">Stock mínimo:</label>
        <input type="number" name="stock_min" id="stock_min" placeholder="Stock mínimo" min="0" value="<?= $producto['stock'] ?>"  class="form-control">
    </div>
  
    <div class="input-group mb-3">
    <textarea name="descripcion_producto" placeholder="Descripción" class="form-control scrollable-textarea" rows="5"><?= $producto['descripcion_producto'] ?></textarea>
</div>
    <div class="d-flex justify-content-center">
    <div class="image-container text-center">
        <label for="imagen" class="text-white">Imagen Actual</label><br>
        <img src="<?= base_url() ?>/assets/uploads/<?= $producto['imagen'] ?>" alt="Imagen del producto" style="max-width: 250px; max-height: 250px;">
    </div>
</div>

<div class=" text-white  mb-3">
    <label for="img" class="form-label text-white">Nueva Imagen</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="imagen" name="imagen">
              </div>
    </div>







<div class="d-grid mt-3">
    <button type="submit" class="btn btn-danger mb-3">Modificar producto</button>
     <a href="<?= site_url('/productosadmin') ?>" class="btn btn-outline-warning">Volver a Productos</a>
</div>

</form>

<br>

             <!-- Fin del formulario -->
           </div>
         </div>
       </div>
     

</section>
<?= $this->endSection() ?>