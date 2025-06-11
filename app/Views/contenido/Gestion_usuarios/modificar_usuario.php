<!-- app/Views/Gestion_usuarios/modificar usuarios -->
<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>

<section>


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


 
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
      <div class="card shadow-lg rounded-4">
        <div class="card-header bg-dark text-white text-center">
          <h4 class="mb-0">Modificar Usuario</h4>
        </div>
        <div class="card-body bg-light">

          <?php if (session()->get('id_perfil') == 1): ?>        
              <form action="<?= base_url('user/editar/' . $user['id_usuario']) ?>" method="post" enctype="multipart/form-data">
          <?php endif; ?>
          <?php if (session()->get('id_perfil') == 2): ?>        
              <form action="<?= base_url('userCliente/editar/' . $user['id_usuario']) ?>" method="post" enctype="multipart/form-data">
          <?php endif; ?>

            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" name="nombre" placeholder="Nombre" value="<?= $user['nombre'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="apellido" class="form-label">Apellido</label>
              <input type="text" name="apellido" placeholder="Apellido" value="<?= $user['apellido'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Correo</label>
              <input type="email" name="email" placeholder="Email" value="<?= $user['email'] ?>" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Nueva Contraseña</label>
              <input type="password" name="password" placeholder="Dejar en blanco si no desea cambiarla" class="form-control">
              <div class="form-text">Solo completá este campo si querés actualizar la contraseña.</div>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success">Guardar Cambios</button>

              <?php if (session()->get('id_perfil') == 1): ?>
                  <a href="<?= site_url('/usuarios') ?>" class="btn btn-secondary">Volver a usuarios</a>
              <?php endif; ?>

              <?php if (session()->get('id_perfil') == 2): ?>
                  <a href="<?= base_url('dashboardCliente/' . $user['id_usuario']) ?>" class="btn btn-secondary">Volver al Panel</a>
              <?php endif; ?>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

</section>
 

<?= $this->endSection() ?>