<!-- app/Views/Gestion_productos/productos.php -->
<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<section >
<div class="container" >
    <div class="row mt-3">
      <div class="col-md-6 mx-auto bg-dark rounded-top wrapper">
        <h3 class="text-white text-center pt-3">Registrar Producto</h3>
        <p class="text-white text-center lead mb-3">Guitar N' Cent</p>
        <!-- Comienzo del formulario -->
  <!--inicio de secion-->
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


  
             
           
    <form  method="post" action="<?php echo base_url('validar_producto') ?>" enctype="multipart/form-data">
    <div class=" text-white imb-3">
        <label for="nombre_producto" class="form-label">Nombre del producto:</label>
        <input type="text" name="nombre_producto" id="nombre_producto" placeholder="Nombre del producto"  class="form-control">
    </div>
   
    <div class="text-white mb-3">
        <label for="id_categoria" class="text-white">Categoría:</label>
        <select name="id_categoria" class="form-select" id="form-select" > 
        <option value="">Seleccionar</option>
            <?php foreach($categorias as $categoria) : ?>
                
    <option value="<?= $categoria['id_categoria']; ?>"><?= $categoria['descripcion']; ?>
               
                </option>
           <?php  endforeach;?>
        </select>
    </div>
    
    <div class=" text-white mb-3">
        <label for="precio" class="form-label">Precio:</label>
        <input type="number" name="precio" id="precio" placeholder="Precio" value="" step="0.01"  min="0" class="form-control"  >
       
    </div>
   
   
    
    <div class="input-group mb-3">
    <label for="descripcion_producto" ></label>
        <textarea name="descripcion_producto" placeholder="Descripción" class="form-control" rows="5" ></textarea>
    </div>

    <div class=" text-white  mb-3">
    <label for="imagen" class="form-label text-white">imagen</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="imagen" name="imagen" > 
              </div>
    </div>
    
    <div class= " text-white  mb-3">
        <label for="stock" class="form-label">Stock:</label>
        <input type="number" name="stock" id="stock" min="0"  placeholder="Stock"  value=""  class="form-control" >
    </div>
    <div class=" text-white  mb-3">
        <label for="stock_min" class="form-label">Stock mínimo:</label>
        <input type="number" name="stock_min" id="stock_min" placeholder="Stock mínimo" min="0" value="<?= old('stock_min') ?>"  class="form-control">
    </div>
    <div class="d-grid">
    <button type="submit" class="btn btn-danger mb-3">subir producto</button>
    <button type="reset" class="btn btn-danger mb-3">cancelar</button>
</div>

</form>

             <!-- Fin del formulario -->
           </div>
         </div>
       </div>
</section>
<?= $this->endSection() ?>
