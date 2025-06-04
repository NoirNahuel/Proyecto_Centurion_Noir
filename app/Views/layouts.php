
 <?= $this->include('plantillas/head') ?>
    <?= $this->include('plantillas/nav') ?>
<style>
    .dashboard-wrapper {
  min-height: 100vh;
}


/* Contenido principal */
.main-content {
  background-color: #f8f9fa;

}

/* Panel derecho */
.right-panel {
  width: 300px;
  background-color: #fff;
  border-left: 1px solid #dee2e6;
  padding: 20px;
  overflow-y: auto;
  height: calc(100vh - 60px); /* Altura ajustable según tu layout */
}

/* Área scrolleable de notificaciones */
.notificaciones-scroll {
  overflow-y: auto;
  padding: 20px;
  max-height: calc(100vh - 60px); /* Resta el alto del botón aprox. */
}

/* Botón fijo al fondo del panel */
.right-panel > .text-center {
  padding: 10px 0;
  border-top: 1px solid #dee2e6;
  background-color: #fff;
}

.fixed-ver-mas {
  position: absolute;
  bottom: 10px;
  right: 20px; /* Ajustalo si es necesario según el ancho del panel */
  z-index: 100;
}


/* Responsivo: ocultar aside derecho en pantallas chicas */
@media (max-width: 767.98px) {
  .right-panel {
    display: none;
  }

  #sidebar {
    width: 100px;
  }
}/* Puedes colocarlo en tu hoja de estilos principal */
.dashboard-wrapper,
.main-content,
.flex-grow-1 {
  min-width: 0;
}

.table-responsive {
  overflow-x: auto;
}
.position-relative {
  position: relative;
}
   /* Estilo oscuro tipo React UI para modal */
                    .dark-modal {
                    background-color: #1e1e2f;
                    color: #e5e5e5;
                    border-radius: 1rem;
                    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
                    border: 1px solid #2c2f40;
                    }
                    .dark-modal .modal-body {
                    background-color: #1e1e2f;
                    color: #e5e5e5;
                    }



                    .modal-text-content {
                    overflow-y: auto;
                    max-height: 60vh;
                    font-size: 1rem;
                    line-height: 1.6;
                    text-align: justify;
                    white-space: pre-wrap;
                    padding-right: 5px;
                    padding: 1rem;
                    background-color: #252536; /* Añade fondo oscuro */
                    color: #e5e5e5;            /* Asegura contraste */
                    border-radius: 0.5rem;
                    }


                    /* Botón cerrar con hover moderno */
                    .dark-modal .btn-close-white {
                    filter: brightness(0.8);
                    transition: transform 0.2s ease;
                    }
                    .dark-modal .btn-close-white:hover {
                    transform: scale(1.2);
                    filter: brightness(1);
                    }

                    /* Estilo para el botón Cerrar */
                    .dark-modal .btn-outline-light {
                    transition: background-color 0.2s, color 0.2s;
                    }
                    .dark-modal .btn-outline-light:hover {
                    background-color: #343a40;
                    color: #ffffff;
                    border-color: #343a40;
                    }
                    /* Agrupar botones más pequeños con mejor separación */


/* Botón icónico estilo moderno */
.btn-icon {
  width: 36px;
  height: 36px;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  border-radius: 0.15rem; /* Más cuadrado */
  transition: all 0.15s ease-in-out;
  border: 1px solid transparent;
}

/* SVG centrado y de tamaño adecuado */
.btn-icon svg {
  width: 18px;
  height: 18px;
}

/* Efecto hover moderno */
.btn-icon:hover {
  transform: scale(1.1);
  box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
  cursor: pointer;
}

/* Botón Ver (azul intenso) */
.btn-icon.view {
  background-color: #1976d2;
  color: white;
  border-color: #1565c0;
}
.btn-icon.view:hover {
  background-color: #1565c0;
  border-color: #0d47a1;
}

/* Botón Leída (verde fuerte) */
.btn-icon.read {
  background-color: #43a047;
  color: white;
  border-color: #388e3c;
}
.btn-icon.read:hover {
  background-color: #388e3c;
  border-color: #2e7d32;
}

/* Botón Marcar como leída (naranja vivo) */
.btn-icon.marcar-leida {
  background-color: #f9a825;
  color: white;
  border-color: #f57f17;
}
.btn-icon.marcar-leida:hover {
  background-color: #f57f17;
  border-color: #ef6c00;
}
/* Tooltip personalizado */
.tooltip-custom {
  position: relative;
}

.tooltip-custom::after {
  content: attr(data-tooltip);
  position: absolute;
  bottom: 120%; /* Arriba del botón */
  left: 50%;
  transform: translateX(-50%);
  background-color: #212529;
  color: #fff;
  padding: 6px 10px;
  border-radius: 4px;
  font-size: 0.75rem;
  white-space: nowrap;
  opacity: 0;
  pointer-events: none;
  transition: opacity 0.2s ease-in-out;
  z-index: 999;
  box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
}

.tooltip-custom:hover::after {
  opacity: 1;
}
/* Spinner oculto por defecto */
.marcar-leida.loading .icon-wrapper {
  display: none;
}

.marcar-leida.loading .spinner-border {
  display: inline-block;
}

/* Tooltip visible aunque el botón esté disabled */
button[disabled][data-bs-toggle="tooltip"] {
  pointer-events: auto;
}


</style>
  <!-- Layout general del dashboard -->
<div class="dashboard-wrapper d-flex flex-column">



  <!-- Cuerpo del dashboard (Sidebar + Contenido + Aside) -->
  <div class="d-flex flex-grow-1">

    <!-- Sidebar izquierdo -->
    <?= $this->include('plantillas/sidebar') ?>

    <!-- Contenedor central (contenido + aside) -->
    <div class="flex-grow-1 d-flex flex-column flex-md-row">
      
      <!-- Contenido principal -->
      <main class="main-content flex-grow-1 p-3">
        <?= $this->renderSection('contenido') ?>
      </main>

      <!-- Panel derecho -->
    <aside class="right-panel d-none d-md-block position-relative">
      <div id="notificacionesWrapper" class="notificaciones-wrapper">
        <div id="accordionNotificaciones">         
        <?= view_cell(\App\Cells\Notificaciones::class . '::render') ?>
        </div>
        
        </div>
    </aside>

    </div>
  </div>
</div>
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

    <?= $this->include('plantillas/footer') ?>
