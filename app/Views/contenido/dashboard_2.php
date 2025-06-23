<style>
.card-custom {
  background:rgb(208, 235, 158);
  border: 1px solidrgb(169, 192, 223);
  border-radius: 12px;
  padding: 1.5rem;
  transition: all 0.3s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-height: 160px;
}

.card-custom:hover {
  box-shadow: 0 4px 12px rgba(0,0,0,0.08);
  transform: translateY(-2px);
}

.card-title {
  font-size: 0.95rem;
  font-weight: 600;
  color: #24292e;
  margin-bottom: 0.75rem;
}

.card-value {
  font-size: 1.4rem;
  font-weight: 700;
  color: #2c974b;
}

.card-custom p {
  font-size: 0.9rem;
  margin-bottom: 0.4rem;
}

@media (max-width: 576px) {
  .card-custom {
    min-height: auto;
    padding: 1rem;
  }
}

</style>
<!-- Panel de Cliente-->
<!-- Modal de Éxito -->
<div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="modalExitoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-sm">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalExitoLabel">¡Éxito!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <?= session('success') ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<?php if (session('success')): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const modal = new bootstrap.Modal(document.getElementById('modalExito'));
      modal.show();
    });
  </script>
<?php endif; ?>
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
                        <a href="<?= base_url('userCliente/editar_user/'.esc(session('id_usuario')));?>" class="btn btn-dark btn-sm">
                            <i class="bi bi-pencil-square"></i> Editar perfil
                        </a>
                        <?php if (empty($persona)) : ?>
                        <a href="<?= base_url('completar-datos');?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Datos adicionales
                        </a>
                        
                           <?php else: ?>
                         <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarDatos">
                        <i class="bi bi-pencil-square me-1"></i> Editar Datos de Envío
                        </button>
                         <div class="modal fade" id="modalEditarDatos" tabindex="-1" aria-labelledby="editarLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                              <div class="modal-content shadow">
                              <form action="<?= base_url('editar-datos/' . $persona['id_domicilio']) ?>" method="post" novalidate>
                              <?= csrf_field() ?>
                              
                                  <div class="modal-header bg-dark text-white">
                                    <h5 class="modal-title" id="editarLabel">Editar Datos de Envío</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row g-3">

                                      <div class="col-md-6">
                                        <label class="form-label">Dirección</label>
                                        <input type="text" name="direccion" class="form-control <?= session('errors.direccion') ? 'is-invalid' : '' ?>" value="<?= old('direccion', $persona['direccion']) ?>" required>
                                        <div class="invalid-feedback"><?= session('errors.direccion') ?? '' ?></div>
                                      </div>

                                      <div class="col-md-6">
                                        <label class="form-label">Teléfono</label>
                                        <input type="text" name="telefono" class="form-control <?= session('errors.telefono') ? 'is-invalid' : '' ?>" value="<?= old('telefono', $persona['telefono']) ?>" required>
                                        <div class="invalid-feedback"><?= session('errors.telefono') ?? '' ?></div>
                                      </div>

                                      <div class="col-md-6">
                                        <label class="form-label">Ciudad</label>
                                        <input type="text" name="ciudad" class="form-control <?= session('errors.ciudad') ? 'is-invalid' : '' ?>" value="<?= old('ciudad', $persona['ciudad']) ?>" required>
                                        <div class="invalid-feedback"><?= session('errors.ciudad') ?? '' ?></div>
                                      </div>

                                      <div class="col-md-6">
                                        <label class="form-label">País</label>
                                        <input type="text" name="pais" class="form-control <?= session('errors.pais') ? 'is-invalid' : '' ?>" value="<?= old('pais', $persona['pais']) ?>" required>
                                        <div class="invalid-feedback"><?= session('errors.pais') ?? '' ?></div>
                                      </div>

                                      <div class="col-md-6">
                                        <label class="form-label">DNI</label>
                                        <input type="text" name="dni" class="form-control <?= session('errors.dni') ? 'is-invalid' : '' ?>" value="<?= old('dni', $persona['dni']) ?>" required>
                                        <div class="invalid-feedback"><?= session('errors.dni') ?? '' ?></div>
                                      </div>

                                      <div class="col-md-6">
                                        <label class="form-label">Código Postal</label>
                                        <input type="text" name="codigo_postal" class="form-control <?= session('errors.codigo_postal') ? 'is-invalid' : '' ?>" value="<?= old('codigo_postal', $persona['codigo_postal']) ?>" required>
                                        <div class="invalid-feedback"><?= session('errors.codigo_postal') ?? '' ?></div>
                                      </div>

                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                         <?php endif; ?>
                        
<?php if (session('errors')): ?>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      new bootstrap.Modal(document.getElementById('modalEditarDatos')).show();
    });
  </script>
<?php endif; ?>
                        <!-- Botón Cerrar sesión con icono -->
                        <a href="<?= base_url('Cerrar-Sesion') ?>" class="btn btn-danger btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Cerrar sesión
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<section class="container my-5">
  <h3 class="text-center fw-bold text-secondary mb-4">Resumen de Actividad</h3>
  <div class="row g-4">

    <!-- Card: Total Gastado -->
    <aside class="col-12 col-md-4 col-xl-3">
      <div class="card-custom shadow-sm">
        <h4 class="card-title">Total Gastado</h4>
        <h6 class="card-value text-dark">$<?= number_format($total_gastado, 2); ?></h6>
      </div>
    </aside>

    <!-- Card: Mis Compras -->
    <aside class="col-12 col-md-4 col-xl-3">
      <div class="card-custom shadow-sm">
        <h6 class="card-title">Mis Compras</h6>
        <div class="table-responsive small">
          <table class="table table-sm table-borderless table-hover mb-0">
            <thead>
              <tr><th>Producto</th></tr>
            </thead>
            <tbody>
              <?php foreach ($productos_comprados as $producto): ?>
                <tr><td><?= $producto['nombre_producto']; ?></td></tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </aside>

    <!-- Card: Últimas Compras -->
    <aside class="col-12 col-md-4 col-xl-3">
      <div class="card-custom shadow-sm">
        <h6 class="card-title">Últimas Compras</h6>
        <?php if (!empty($ultimas_compras)): ?>
          <?php foreach(array_slice($ultimas_compras, 0, 3) as $producto): ?>
            <p class="text-muted mb-1">🛍️ <?= esc($producto['nombre_producto']) ?></p>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-muted">No hay compras recientes.</p>
        <?php endif; ?>
      </div>
    </aside>

  </div>
</section>


<?php if (session('errors')): ?>
<script>
  const modal = new bootstrap.Modal(document.getElementById('modalEditarDatos'));
  modal.show();
</script>
<?php endif; ?>
