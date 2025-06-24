<!-- app/Views/Gestion_productos/productos.php -->
<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="card bg-dark text-light shadow-lg rounded-4 border-0">
          <div class="card-body p-5">

            <h3 class="text-center fw-bold mb-2">Registrar Producto</h3>
            <p class="text-center text-secondary mb-4">Guitar N' Cent</p>

            <!-- Flash message -->
            <?php if (session()->getFlashdata('mensaje')): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('mensaje'); ?>
                <button type="button" class="btn-close btn-close-darkgit sta" data-bs-dismiss="alert" aria-label="Cerrar"></button>
              </div>
            <?php endif; ?>

            <!-- Validación -->
            <?php if (session()->has('errors')): ?>
              <div class="alert alert-danger">
                <ul class="mb-0">
                  <?php foreach (session('errors') as $error): ?>
                    <li><?= $error ?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            <?php endif; ?>

            <!-- Formulario -->
            <form method="post" action="<?= base_url('validar_producto') ?>" enctype="multipart/form-data">
              
              <!-- Nombre -->
              <div class="form-floating mb-3">
                <input type="text" class="form-control bg-body-tertiary text-dark" id="nombre_producto" name="nombre_producto" placeholder="Nombre del producto">
                <label for="nombre_producto">Nombre del producto</label>
              </div>

              <!-- Categoría -->
              <div class="form-floating mb-3">
                <select class="form-select bg-body-tertiary text-dark" id="id_categoria" name="id_categoria">
                  <option value="">Seleccionar</option>
                  <?php foreach($categorias as $categoria): ?>
                    <option value="<?= $categoria['id_categoria']; ?>"><?= $categoria['descripcion']; ?></option>
                  <?php endforeach; ?>
                </select>
                <label for="id_categoria">Categoría</label>
              </div>

              <!-- Precio -->
              <div class="form-floating mb-3">
                <input type="number" step="0.01" min="0" class="form-control bg-body-tertiary text-dark" id="precio" name="precio" placeholder="Precio">
                <label for="precio">Precio</label>
              </div>

              <!-- Descripción -->
              <div class="form-floating mb-3">
                <textarea class="form-control bg-body-tertiary text-dark" placeholder="Descripción" id="descripcion_producto" name="descripcion_producto" style="height: 120px"></textarea>
                <label for="descripcion_producto">Descripción del producto</label>
              </div>

              <!-- Imagen -->
              <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del producto</label>
                <input class="form-control bg-body-tertiary text-dark" type="file" id="imagen" name="imagen">
              </div>

              <!-- Stock -->
              <div class="form-floating mb-3">
                <input type="number" min="0" class="form-control bg-body-tertiary text-dark" id="stock" name="stock" placeholder="Stock">
                <label for="stock">Stock</label>
              </div>

              <!-- Stock mínimo -->
              <div class="form-floating mb-4">
                <input type="number" min="0" class="form-control bg-body-tertiary text-dark" id="stock_min" name="stock_min" placeholder="Stock mínimo" value="<?= old('stock_min') ?>">
                <label for="stock_min">Stock mínimo</label>
              </div>

              <!-- Botones -->
              <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                <button type="submit" class="btn btn-success px-4">
                  <i class="bi bi-cloud-upload"></i> Subir producto
                </button>
                <button type="reset" class="btn btn-outline-light px-4">
                  <i class="bi bi-x-circle"></i> Cancelar
                </button>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
