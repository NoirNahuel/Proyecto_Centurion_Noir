<?php $hayProductos = false; ?>
 <?php foreach ($producto as $producto) : ?>
      <?php if ($producto['fecha_modificacion'] !== null) : ?>
        <?php $hayProductos = true; ?>
                      
                    <tr>
                        <td class="resaltado"><?= $producto['idProducto'] ?></td>
                        <td><?= $producto['nombre_producto'] ?></td>
                        <td><?= $categoriaMap[$producto['id_categoria']] ?? 'Sin categoria' ?></td>
                        <td>
                            <a class="pop" data-bs-toggle="modal">
                                <img 
                                    src="<?= base_url() ?>/assets/uploads/<?= $producto['imagen'] ?>"
                                    alt="Imagen del producto" class="img-fluid" style="max-width: 80px; max-height: 80px;">
                            </a>
                        </td>
                        <td><?= $producto['precio'] ?></td>
                        <td><?= $producto['descripcion_producto'] ?></td>
                        <td class="<?= ($producto['stock'] == 0) ? 'text-danger fw-bold' : ''; ?>">
                            <?= $producto['stock'] ?>
                        </td>

                        <td><?= $producto['fecha_modificacion'] ?></td>
                        <td>
                            <?= $producto['estado'] == 1 
                                ? '<span class="badge bg-success text-dark">Activo</span>' 
                                : '<span class="badge bg-danger text-white">Inactivo</span>' ?>
                        </td>

                        <td>
                            <div class="btn-group d-flex justify-content-center flex-wrap small-btn-group" role="group" aria-label="Acciones de usuarios">
                            <!-- Editar Producto -->
                            <a href="<?= base_url('product/editar_producto/' . $producto["idProducto"]); ?>" 
                                class="btn btn-sm btn-warning" 
                                data-bs-toggle="tooltip" 
                                data-bs-title="Editar Usuario" 
                                data-bs-placement="top">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                              
                            <!-- Activar/Desactivar Producto -->
                            <?php if ($producto['estado'] == 1): ?>
                                <a href="<?= base_url('Baja-Producto/' . $producto['idProducto']); ?>" 
                                class="btn btn-sm btn-danger" 
                                data-bs-toggle="tooltip" 
                                data-bs-title="Desactivar producto" 
                                data-bs-placement="top">
                                <i class="fas fa-check-circle text-dark ms-1"></i>
                                </a>
                            <?php else: ?>
                                <a  href="<?= base_url('Baja-Producto/' . $producto['idProducto']); ?>"
                                class="btn btn-sm btn-success" 
                                data-bs-toggle="tooltip" 
                                data-bs-title="Activar Producto" 
                                data-bs-placement="top">
                                
                                <i class="fas fa-check-circle text-dark ms-1"></i>

                                </a>
                            <?php endif; ?>
                            </div>
                        </td>
                    </tr>
              
                
                            </td>
                        </tr>
                        <?php endif; ?>
<?php endforeach; ?>
                    <?php if (!$hayProductos) : ?>
    <tr>
        <td colspan="6" class="text-center text-muted">No se encontraron usuarios.</td>
    </tr>
<?php endif; ?>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('searchInput');
    input.addEventListener('keyup', function () {
        const search = this.value;

        fetch("<?= base_url('buscar_producto') ?>", {
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









