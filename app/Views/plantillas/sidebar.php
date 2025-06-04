 <!-- Sidebar -->
    <style>
 /* Sidebar */
#sidebar {
  width: 20%;
  background-color: #343a40;
  color: white;
  display: flex;
  flex-direction: column;
  height: 100vh; /*  altura de la pantalla solamente */
  position: sticky; /* o fixed si querés que no se mueva nunca */
  top: 0;
  
  /* ✅ Nueva mejora visual */
  border-right: 1px solid #495057; /* Línea de separación sutil */
  box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2); /* Sombra leve */
 /*  z-index: 1030; Encima del contenido si hace falta */
   display: flex;
  flex-direction: column;
  justify-content: space-between; /* Asegura separación entre lista y logout */
}


#sidebar.collapsed {
  width: 70px;
  border-right: 1px solid #495057; /* conservar contorno al colapsar */
}

.logout-section {
  margin-top: auto;

}

#sidebar .nav-link {
  color: white;
}

#sidebar .nav-link:hover {
  color: #adb5bd; /* opcional: gris claro para efecto hover */
}

.sidebar-text {
  display: inline;
}

#sidebar.collapsed .sidebar-text {
  display: none;
}

   .sidebar-toggle-btn {
  position: absolute;
  top: 10px;
  right: 10px;
  left: 10px;
  color: rgb(255, 255, 255);
  background: none;
  border: none;
  outline: none;
  box-shadow: none;
  padding: 0;
  margin: 0;
  font-size: 1.2rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.sidebar-toggle-btn:focus,
.sidebar-toggle-btn:active,
.sidebar-toggle-btn:focus-visible {
  outline: none !important;
  box-shadow: none !important;
  border: none !important;
}

.sidebar-toggle-btn:hover {
  color: rgb(168, 161, 161);
  background: none;
}
 /* Fin sidebar e iconos del sidebar */

    

/* Panel derecho oculto en móviles */
@media (max-width: 767.98px) {
  .right-panel {
    display: none;
  }
}
  </style>
  <div id="sidebar" class="degradado collapsed">
    
  <a id="toggleSidebar" class="btn btn-sm  sidebar-toggle-btn">
  <i id="sidebarIcon" class="bi bi-chevron-double-right"></i>
</a>


    <ul class="nav flex-column mt-5 px-2">
      <li class="nav-item mb-3">
        <a  href="<?php echo base_url('/');?>" class="nav-link"  data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
        data-bs-title="Inicio"  data-bs-placement="right">
          <i class="bi bi-house-door-fill fs-5"></i>
          <span class="sidebar-text ms-2" class="fs-6 fs-md-5 fs-lg-4" >Inicio</span>
        </a>
      </li>
     
      <li class="nav-item mb-3">
        <a href="Gestion_Producto" class="nav-link" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
        data-bs-title="Productos"  data-bs-placement="right">
        <i class="bi bi-box-seam fs-5"></i>
        <span class="sidebar-text ms-2" >Crud Productos</span>
        </a>

      </li>
      <li class="nav-item mb-3">
         <a href="usuarios" class="nav-link" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
        data-bs-title="Usuarios"  data-bs-placement="right" >
          <i class="bi bi-people-fill fs-5"></i>
          <span class="sidebar-text ms-2">Crud Usuarios</span>
        </a>
      </li>
       <li class="nav-item mb-3">
          <a href="consultas" class="nav-link" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
        data-bs-title="Consultas"  data-bs-placement="right" >
            <i class="bi bi-question-circle-fill fs-5"></i>
            
            <span class="sidebar-text ms-2">Consultas</span>
        </a>
        </li>
        <li class="nav-item mb-3">
        <a href="#" class="nav-link" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
        data-bs-title="Ventas"  data-bs-placement="right">
            <i class="bi bi-cash-coin  fs-5"></i>
            <span class="sidebar-text ms-2">Ventas</span>
        </a>
        </li>

      <li class="nav-item mb-3" >
        <a href="#" class="nav-link" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
        data-bs-title="Reportes"  data-bs-placement="right">
          <i class="bi bi-bar-chart-line-fill fs-5"></i>
          <span class="sidebar-text ms-2">Reportes</span>
        </a>
      </li>
 
    </ul>
      <div  class="nav flex-column mt-5 px-2">
               <!-- Ícono de Cerrar sesión al fondo -->
    <li class="logout-section mt-auto nav-item mb-3">
      <a href="#" class="nav-link" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip"
        data-bs-title="Cerrar"  data-bs-placement="right">
        <i class="bi bi-box-arrow-right fs-5"></i>
        <span class="sidebar-text ms-2">Cerrar sesión</span>
      </a>
</li>

</div>
  </div>
 <script>
  const toggleBtn = document.getElementById('toggleSidebar');
  const sidebarIcon = document.getElementById('sidebarIcon');
  const sidebar = document.getElementById('sidebar');

  let tooltipInstances = [];

  // Función para inicializar tooltips
  function initTooltips() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(function (el) {
      const tooltip = new bootstrap.Tooltip(el, {
        trigger: 'hover' //  Solo mostrar mientras el cursor está encima
      });
      tooltipInstances.push(tooltip);
    });
  }

  // Función para destruir tooltips
  function destroyTooltips() {
    tooltipInstances.forEach(function (tooltip) {
      tooltip.dispose();
    });
    tooltipInstances = [];
  }

  // Manejo del botón toggle
  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');

    if (sidebar.classList.contains('collapsed')) {
      sidebarIcon.classList.remove('bi-chevron-double-left');
      sidebarIcon.classList.add('bi-chevron-double-right');
      initTooltips(); // Activar tooltips
    } else {
      sidebarIcon.classList.remove('bi-chevron-double-right');
      sidebarIcon.classList.add('bi-chevron-double-left');
      destroyTooltips(); // Desactivar tooltips
    }
  });


  // Cuando el DOM está listo
  document.addEventListener('DOMContentLoaded', function () {
    // Si el sidebar ya está colapsado al cargar, inicializar tooltips
    if (sidebar.classList.contains('collapsed')) {
      initTooltips();
    }
  });
  
</script>
