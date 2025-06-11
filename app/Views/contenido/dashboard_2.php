<!-- Panel de Cliente-->

<!-- Sección de Bienvenida -->
<section class="bg-light py-3">
  <div class="container text-center">
    <div class="promo_card p-3 bg-white shadow-sm rounded">
      <h2 class="fw-bold text-dark mb-2">Instrumentos Musicales</h2>
      <p class="fs-6 text-dark m-0">Usuario: <strong><?= esc(session('apellido')); ?> <?= esc(session('nombre')); ?></strong></p>
      
    </div>
  </div>
</section>
<div>
<?php if(session("mensaje")):?>
   <div class="container alert alert-success text-center" style="width: 30%;">
      <?php echo session("mensaje"); ?>
      <i class="bi bi-check-lg text-success"></i>
      </div>
      <?php endif?>
      </div>
      <section>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white text-center">
                        <h4>Perfil del Usuario</h4>
                    </div>
                    <div class="card-body">
                        <!-- Información de usuario -->
                        <div class="row mb-3">
                            <div class="col-3 text-center">
                                <i class="fa-solid fa-user-circle fa-3x text-dark"></i>
                            </div>
                            <div class="col-9">
                                <h5><?= esc($usuario['apellido']); ?> <?= esc($usuario['nombre']); ?> </h5>
                                <p class="text-muted mb-0">Usuario registrado</p>
                            </div>
                        </div>
                        <hr>
                        <!-- Información de cuenta -->
                        <div class="mb-3">
                            <h6 class="text-muted">Información de la cuenta</h6>
                            <p><i class="fa-solid fa-envelope me-2"></i>Email: <span class="text-dark"><?= esc($usuario['email']); ?> </span></p>
                        </div>

                        <!-- Información adicional -->
                        <div class="mb-3">
                            <h6 class="text-muted">Información adicional</h6>
                            <?php if ($persona): ?>
                                <p><i class="fa-solid fa-map-marker-alt me-2"></i>Dirección: <span class="text-dark"><?= esc($persona['direccion']); ?></span></p>
                                <p><i class="fa-solid fa-phone me-2"></i>Teléfono: <span class="text-dark"><?= esc($persona['telefono']); ?></span></p>
                                <p><i class="fa-solid fa-city me-2"></i>Ciudad: <span class="text-dark"><?= esc($persona['ciudad']); ?></span></p>
                                <p><i class="fa-solid fa-globe me-2"></i>País: <span class="text-dark"><?= esc($persona['pais']); ?></span></p>
                                <p><i class="fa-solid fa-id-card me-2"></i>DNI: <span class="text-dark"><?= esc($persona['dni']); ?></span></p>
                                <p><i class="fa-solid fa-mail-bulk me-2"></i>Código Postal: <span class="text-dark"><?= esc($persona['codigo_postal']); ?></span></p>
                            <?php else: ?>
                                <p class="text-muted">No hay datos adicionales registrados.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <!-- Botón Editar perfil con icono -->
                        <a href="<?= base_url('userCliente/editar_user/'.esc(session('id_usuario')));?>" class="btn btn-outline-dark btn-sm">
                            <i class="bi bi-pencil-square"></i> Editar perfil
                        </a>
                        <a href="<?= base_url('completar-datos');?>" class="btn btn-outline-dark btn-sm">
                            <i class="bi bi-pencil-square"></i> Datos adicionales
                        </a>

                        <!-- Botón Cerrar sesión con icono -->
                        <a href="<?= base_url('Cerrar-Sesion') ?>" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>