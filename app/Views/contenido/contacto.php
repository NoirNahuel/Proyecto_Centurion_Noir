<section class="divBoxPrincipal ">
  <br>
<nav  class="d-flex justify-content-center" style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item "><a class="text-secondary text-decoration-none" href="<?php echo base_url('/');?>">Inicio</a></li>
    <li class="breadcrumb-item navbar-brand" aria-current="page">Contacto</li>
  </ol>
</nav>

  <div class="container">
    <h2 class="titulo text-center mb-5">Dejanos tu consulta</h2>

    <!-- Flash de error -->
    <?php if(session()->getFlashdata('errors')): ?>
  <div class="alert alert-danger text-center w-75 mx-auto">
    <i class="fa fa-exclamation-triangle me-2"></i><p>Atencion! Debe seguir los siguientes items:</p>
    <ul class="list-unstyled mb-0">
      <?= session()->getFlashdata('errors') ?>
    </ul>
  </div>
<?php endif; ?>


    <!-- Flash de éxito -->
    <?php if(session()->getFlashdata('mensaje')): ?>
      <div class="alert alert-success alert-dismissible fade show w-75 mx-auto" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <?= session()->getFlashdata('mensaje') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    <?php endif; ?>

    <!-- Formulario y contacto -->
    <div class="row justify-content-center align-items-start mt-4">
      <!-- Formulario -->
      <div class="col-lg-6 col-md-10 mb-4">
        <?php $validation = \Config\Services::validation(); ?>
        <form action="<?= base_url('enviarconsultas') ?>" method="post" class="p-4 rounded shadow bg-dark text-white">
          <?php if (!session()->has('id_usuario')): ?>
         <!-- Campos visibles solo para visitantes -->
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input class="form-control <?= $validation->getError('nombre') ? 'is-invalid' : '' ?>" name="nombre" type="text" id="nombre" value="<?= set_value('nombre') ?>">
            <?php if ($validation->getError('nombre')): ?>
              <div class="invalid-feedback d-block">
                <i class="fa fa-exclamation-triangle me-2"></i><?= $validation->getError('nombre'); ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Dirección de Correo</label>
            <input type="email" name="email" class="form-control <?= $validation->getError('email') ? 'is-invalid' : '' ?>" id="email" value="<?= set_value('email') ?>">
            <?php if ($validation->getError('email')): ?>
              <div class="invalid-feedback d-block">
                <i class="fa fa-exclamation-triangle me-2"></i><?= $validation->getError('email'); ?>
              </div>
            <?php endif; ?>
          </div>
           <?php endif; ?>
          <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control <?= $validation->getError('mensaje') ? 'is-invalid' : '' ?>" name="mensaje" id="mensaje" rows="4"><?= set_value('mensaje') ?></textarea>
            <?php if ($validation->getError('mensaje')): ?>
              <div class="invalid-feedback d-block">
                <i class="fa fa-exclamation-triangle me-2"></i><?= $validation->getError('mensaje'); ?>
              </div>
            <?php endif; ?>
          </div>

          <button type="submit" class="btn btn-dark text-white w-100">Enviar Consulta</button>
        </form>
      </div>

      <!-- Información de la empresa -->
      <div class="col-lg-5 col-md-10">
        <div class="rounded p-4 text-white" style="
          background: url('<?= base_url('assets/img/music.jpg') ?>') center center / cover no-repeat;
          background-blend-mode: darken;
          background-color: rgba(0, 0, 0, 0.6);">
          <h4 class="text-white">Guitar N'Cent Instrumentos Musicales</h4>
          <p><i class="fas fa-map-marker-alt me-2"></i>Calle Matheu 3302, Corrientes, Argentina</p>
          <p><i class="fas fa-envelope me-2"></i>@guitarcn.com</p>
          <p><i class="fas fa-phone me-2"></i>+54 11 5555 1234</p>
          <p><i class="fas fa-globe me-2"></i>
            <a href="https://www.guitarcn.com" class="text-white text-decoration-none" target="_blank">www.guitarcn.com</a>
          </p>
          <p><i class="fab fa-facebook-square me-2"></i>
            <a href="#" class="text-white text-decoration-none">Facebook</a>
          </p>
          <p><i class="fab fa-instagram me-2"></i>
            <a href="#" class="text-white text-decoration-none">Instagram</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Mapa -->
    <div class="mt-5">
      <h4 class="text-center mb-3"><i class="fas fa-map-marked-alt me-2"></i>Visitanos personalmente</h4>
      <div class="ratio ratio-16x9 rounded shadow overflow-hidden">
        <iframe 
          class="rounded"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13134.709607197932!2d-58.417309!3d-34.603684!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bccadc389f55e7%3A0xc9443fc88d1cbe2f!2sCalle%20del%20Rock%20123%2C%20Buenos%20Aires%2C%20Argentina!5e0!3m2!1ses-419!2sar!4v1614953890823!5m2!1ses-419!2sar" 
          allowfullscreen 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </div>
  <br>
  <br>
</section>
