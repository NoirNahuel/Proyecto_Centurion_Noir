<?php $hayUsuarios = false; ?>
<?php foreach ($users as $user) : ?>
      <?php if ($user['fecha_modificacion'] !== null) : ?>
        <?php $hayUsuarios = true; ?>
                        <tr>
                            <td class="resaltado"><?= $user['id_usuario'] ?></td>
                            <td><?= $user['nombre'] ?></td>
                            <td><?= $user['apellido'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $perfilMap[$user['id_perfil']] ?? 'Sin perfil' ?></td> <!-- Obtener descripción del perfil -->
                            <td><?= $user['estado'] == 1 ? 'Activo' : 'Inactivo' ?></td>
                            <td><?= $user['fecha_modificacion'] ?></td>
                           

                            <td>
                             <div class="btn-group d-flex justify-content-center flex-wrap small-btn-group" role="group" aria-label="Acciones de usuarios">

  <!-- Editar Usuario -->
 <a  
  class="btn btn-sm btn-warning editar-btn" 
  data-bs-toggle="modal"
  data-bs-target="#modalEditarUsuario"
  data-bs-id="<?= $user['id_usuario'] ?>"
  data-bs-nombre="<?= esc($user['nombre']) ?>"
  data-bs-apellido="<?= esc($user['apellido']) ?>"
  data-bs-email="<?= esc($user['email']) ?>"
  data-bs-placement="top"
  title="Editar Usuario">
  <i class="bi bi-pencil-square"></i>
</a>



  <!-- Activar/Desactivar Usuario -->
  <?php if ($user['estado'] == 1): ?>
    <a href="<?= base_url('Baja-user/' . $user['id_usuario']); ?>" 
       class="btn btn-sm btn-danger" 
       data-bs-toggle="tooltip" 
       data-bs-title="Desactivar Usuario" 
       data-bs-placement="top">
      <i class="bi bi-person-dash"></i>
    </a>
  <?php else: ?>
    <a  href="<?= base_url('Baja-user/' . $user['id_usuario']); ?>"
       class="btn btn-sm btn-success" 
       data-bs-toggle="tooltip" 
       data-bs-title="Activar Usuario" 
       data-bs-placement="top">
      <i class="bi bi-person-check"></i>
    </a>
  <?php endif; ?>

  <!-- Enviar activación / Reestablecer contraseña 
  <a href="<?= base_url('user/reset_password/' . $user["id_usuario"]); ?>" 
     class="btn btn-sm btn-info" 
     data-bs-toggle="tooltip" 
     data-bs-title="Reestablecer Contraseña" 
     data-bs-placement="top">
    <i class="bi bi-key"></i>
  </a>

</div>-->

                
                            </td>
                        </tr>
                        <?php endif; ?>
<?php endforeach; ?>
                    <?php if (!$hayUsuarios) : ?>
    <tr>
        <td colspan="6" class="text-center text-muted">No se encontraron usuarios.</td>
    </tr>
<?php endif; ?>

<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form id="formEditarUsuario" method="post">
        <div class="modal-body bg-light">
          <input type="hidden" name="id_usuario" id="modal_id_usuario">

          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre" id="modal_nombre" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" class="form-control" name="apellido" id="modal_apellido" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="modal_email" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" name="password" placeholder="Dejar en blanco si no se modifica">
          </div>
        </div>

        <div class="modal-footer bg-light">
          <button type="submit" class="btn btn-success">Guardar Cambios</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
document.querySelectorAll('.editar-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.bsId;
        const nombre = this.dataset.bsNombre;
        const apellido = this.dataset.bsApellido;
        const email = this.dataset.bsEmail;

        // Completar el formulario dentro del modal
        document.getElementById('modal_id_usuario').value = id;
        document.getElementById('modal_nombre').value = nombre;
        document.getElementById('modal_apellido').value = apellido;
        document.getElementById('modal_email').value = email;

        // Cambiar acción del formulario
        document.getElementById('formEditarUsuario').action = `<?= base_url('user/editar/') ?>${id}`;
    });
});

</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchInput');
    input.addEventListener('keyup', function () {
        const search = this.value;

        fetch("<?= base_url('buscar_usuario') ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "search=" + encodeURIComponent(search)
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('usuarioTableBody').innerHTML = data;
        });
    });
});
</script>
<script>
  const baseUrl = "<?= base_url() ?>"; // debe devolver: http://localhost/Proyecto_Centurion_Noir/
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.marcar-leida').forEach(boton => {
    boton.addEventListener('click', function () {
      const id = this.getAttribute('data-id');
      const formData = new FormData();
      formData.append('id_consulta', id);

      fetch('<?= base_url('marcar') ?>', {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Reemplazar botón actual con uno nuevo (marcado como leído)
          const nuevoBoton = document.createElement('button');
          nuevoBoton.className = 'btn btn-outline-success btn-icon read marcado';
          nuevoBoton.title = 'Ya marcada como leída';
          nuevoBoton.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                 stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
          `;
          this.replaceWith(nuevoBoton);

          // Mostrar modal de éxito
          const modal = new bootstrap.Modal(document.getElementById('modalExito'));
          modal.show();
        } else {
          alert('Error al marcar como leída');
        }
      })
      .catch(err => {
        console.error('Error en la petición AJAX:', err);
        alert('Error en la conexión.');
      });
    });
  });
});
</script>

<script>
  document.querySelectorAll('.marcar-leida').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      e.stopPropagation(); // Previene bubbling a los otros botones del btn-group

      const id = this.dataset.id;
      const button = this;

      // Mostrar loader
      button.classList.add('loading');

      // Simular AJAX (reemplazá por fetch/post real si querés)
      setTimeout(() => {
        button.classList.remove('loading');

        // Reemplazar contenido por ícono de "leída"
        button.innerHTML = `
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
               stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
          </svg>
        `;

        // Cambiar clases y tooltip
        button.classList.remove('marcar-leida');
        button.classList.add('read');
        button.setAttribute('title', 'Leída');
        button.setAttribute('data-bs-title', 'Leída');
        button.setAttribute('disabled', 'disabled');

        // Reactivar tooltip (porque a veces se rompe en botones dinámicos)
        const tooltip = bootstrap.Tooltip.getInstance(button);
        if (tooltip) tooltip.dispose();
        new bootstrap.Tooltip(button);
      }, 1500);
    });
  });
</script>









