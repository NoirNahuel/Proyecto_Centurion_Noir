<style>
  .section_registro {
  background-image: url('../img/fondo_login4.jpg');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 40px 15px;
}

.form-container {
  display: flex;
  flex-wrap: wrap;
  max-width: 900px;
  width: 100%;
  background-color: rgba(1, 2, 22, 0.85);
  border-radius: 20px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
  overflow: hidden;
}

.form-left,
.form-right {
  flex: 1 1 300px;
  padding: 30px;
  color: white;
}

.form-left h5 {
  font-size: 1.5rem;
  margin-bottom: 20px;
  text-align: center;
}

.form-left input.form-control {
  margin-bottom: 15px;
  background-color: #f8f9fa;
  border-radius: 10px;
}

.form-left .btn {
  width: 100%;
  border-radius: 50px;
}

.mensajeBadRegistrarse {
   background-color: rgba(250, 6, 6, 0.411);
  color:rgb(242, 236, 236);
  font-size: 0.9rem;
  margin-top: -10px;
  margin-bottom: 10px;
  padding: 6px 12px;
  border-left: 5px solid #b10000;
  border-radius: 4px;
}

.form-right {
  background-color: rgba(255, 255, 255, 0.05);
  border-left: 2px solid rgba(255, 255, 255, 0.1);
  font-size: 0.95rem;
}

@media (max-width: 768px) {
  .form-container {
    flex-direction: column;
  }
  .form-right {
    border-left: none;
    border-top: 2px solid rgba(255, 255, 255, 0.1);
  }
}
.breadcrumb-dark {
  background-color: rgba(24, 23, 23, 0.43); /* leve contraste */
  padding: 10px 20px;
  border-radius: 10px;
  color: #f1f1f1;
  font-size: 0.95rem;
}

.breadcrumb-dark .breadcrumb-item a {
  color: #90caf9; /* azul claro legible */
  text-decoration: none;
  transition: color 0.2s;
}

.breadcrumb-dark .breadcrumb-item a:hover {
  color: #ffffff;
  text-decoration: underline;
}

.breadcrumb-dark .breadcrumb-item.active,
.breadcrumb-dark .breadcrumb-item:last-child {
  color: #ffffff;
  font-weight: 500;
}

</style>

<div class="d-flex justify-content-center">
    <section  class="section_registrarse" >
            <?php $validation = \Config\Services::validation(); ?>
            
          <nav class="d-flex justify-content-center breadcrumb-dark" style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb mb-0">
    <li class="breadcrumb-item">
      <a href="<?= base_url('principal'); ?>">Inicio</a>
    </li>
    <li class="breadcrumb-item active" aria-current="page">Producto</li>
  </ol>
</nav>

       
      
            <section class="section_registro">
    <div class="form-container">
        <!-- FORMULARIO DE REGISTRO -->
        <div class="form-left">
            <h5>🚀 Registrate</h5>
            <?php if (session()->getFlashdata('mensaje')) : ?>
                <div class="alert alert-info"><?= session()->getFlashdata('mensaje'); ?></div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('validar') ?>">
                <?= csrf_field() ?>

                <!-- NOMBRE -->
                <input class="form-control" name="nombre" placeholder="Nombre" type="text" value="<?= set_value('nombre') ?>">
                <?php if ($validation->getError('nombre')) : ?>
                    <div class="mensajeBadRegistrarse"><?= $validation->getError('nombre'); ?></div>
                <?php endif; ?>

                <!-- APELLIDO -->
                <input class="form-control" name="apellido" placeholder="Apellido" type="text" value="<?= set_value('apellido') ?>">
                <?php if ($validation->getError('apellido')) : ?>
                    <div class="mensajeBadRegistrarse"><?= $validation->getError('apellido'); ?></div>
                <?php endif; ?>

                <!-- EMAIL -->
                <input class="form-control" name="email" placeholder="Correo electrónico" type="email" value="<?= set_value('email') ?>">
                <?php if ($validation->getError('email')) : ?>
                    <div class="mensajeBadRegistrarse"><?= $validation->getError('email'); ?></div>
                <?php endif; ?>

                <!-- PASSWORD -->
                <input class="form-control" name="password" placeholder="Contraseña" type="password">
                <?php if ($validation->getError('password')) : ?>
                    <div class="mensajeBadRegistrarse"><?= $validation->getError('password'); ?></div>
                <?php endif; ?>

                <!-- PASSWORD CONFIRM -->
                <input class="form-control" name="password_equal" placeholder="Confirmar Contraseña" type="password">
                <?php if ($validation->getError('password_equal')) : ?>
                    <div class="mensajeBadRegistrarse"><?= $validation->getError('password_equal'); ?></div>
                <?php endif; ?>

                <!-- BOTÓN -->
                <input type="submit" value="Registrarse" class="btn btn-success mt-3">
            </form>
        </div>

        <!-- PANEL DE AYUDA / DATOS NECESARIOS -->
        <div class="form-right">
            <h6 class="fw-bold mb-3">ℹ️ ¿Qué necesito para registrarme?</h6>
            <ul class="list-unstyled">
                <li>✔ Nombre y Apellido</li>
                <li>✔ Correo electrónico válido</li>
                <li>✔ Contraseña de mínimo 4 caracteres</li>
                <li>✔ Confirmación de contraseña</li>
            </ul>
            <p class="mt-3 small text-success">💡 Tus datos estarán protegidos según nuestra política de privacidad.</p>
        </div>
    </div>
</section>


          
        </section>  
        </div>

