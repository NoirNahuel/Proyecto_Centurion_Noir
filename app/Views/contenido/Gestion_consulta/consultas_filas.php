<?php $hayConsultas = false; ?>

<?php foreach ($consultas as $consulta) : ?>
    <?php if ($consulta['fecha_respuesta'] !== null) : ?>
        <?php $hayConsultas = true; ?>
        <tr>
            <td><?= esc($consulta['id_consulta']) ?></td>
            <td><?= esc($consulta['nombre']) ?></td>
            <td><?= esc($consulta['email']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($consulta['fecha_consulta'])) ?></td>
             <td><?= $consulta['respuesta'] == null ? 'No'  : 'Si' ?>
            <td>
                <form action="<?= base_url('respuestas/' . $consulta['id_consulta']) ?>" method="post" style="display: inline;">
                 
<div class="btn-group d-flex justify-content-center flex-wrap small-btn-group" role="group" aria-label="Acciones de consulta">

  <!-- Botón Ver Consulta -->
  <button type="submit" class="btn  btn-icon view" data-bs-toggle="tooltip"
          data-bs-custom-class="custom-tooltip" data-bs-title="Ver consulta" data-bs-placement="top">
    <!-- icon -->
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
         d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z" />
      <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
    </svg>
  </button> 


  <!-- Botón Leída / Marcar como Leída -->
  <?php if ($consulta['leida'] == 1): ?>
    <button type="button" class="btn btn-icon read" data-bs-toggle="tooltip" title="Leída">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
           viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
      </svg>
    </button>
  <?php else: ?>
   <!-- Botón Marcar como Leída -->
<button type="button" class="btn btn-icon marcar-leida" data-id="<?= $consulta['id_consulta'] ?>"
        data-bs-toggle="tooltip" data-bs-title="Marcar como leído" data-bs-placement="top">
  <span class="icon-wrapper">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
         viewBox="0 0 24 24">
      <path d="M9 12l2 2l4 -4" />
      <path d="M5 4h14v16H5z" />
    </svg>
  </span>
  <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
</button>

  <?php endif; ?>
  
</div>

</div> <!-- <button type="submit" class="btn btn-sm btn-dark"><i class="bi bi-eye"></i>Ver consulta</button> -->
                </form>
            </td>
        </tr>
    <?php endif; ?>
<?php endforeach; ?>

<?php if (!$hayConsultas) : ?>
    <tr>
        <td colspan="6" class="text-center text-muted">No se encontraron consultas.</td>
    </tr>
<?php endif; ?>
<!-- Modal de éxito -->
<div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="modalExitoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-success">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="modalExitoLabel">Consulta actualizada</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        La consulta ha sido marcada como <strong>leída</strong> correctamente.
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchInput');
    input.addEventListener('keyup', function () {
        const search = this.value;

        fetch("<?= base_url('buscar_consulta') ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "search=" + encodeURIComponent(search)
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById('consultaTableBody').innerHTML = data;
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