<?= $this->extend('layouts') ?>
<?= $this->section('contenido') ?>
  <style>


.dashboard-wrapper {
  display: flex;
  align-items: stretch;
  
}

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

    /* Contenido principal */
    .main-content {
      flex-grow: 1;
      padding: 20px;
      background-color: #f8f9fa;
      overflow-y: auto;
    }

    /* Panel derecho */
    .right-panel {
      width: 300px;
      background-color: #ffffff;
      border-left: 1px solid #dee2e6;
      padding: 20px;
      overflow-y: auto;
       display: block;   
    }

/* Panel derecho oculto en móviles */
@media (max-width: 767.98px) {
  .right-panel {
    display: none;
  }
}
  </style>
  


 
  <!-- Contenido + Panel derecho -->
  <div class="flex-grow-1 d-flex flex-column flex-md-row w-100">
    
    <!-- Contenido principal -->
    <div class="main-content flex-grow-1 p-3">
      <h2>Panel Principal</h2>
      <p>Bienvenido al sistema de gestión de instrumentos musicales.</p>
    </div>

    <!-- Panel derecho -->
    <aside class="right-panel d-none d-md-block">
      <h5>Notificaciones</h5>
      <ul class="list-group">
        <li class="list-group-item">Nuevo producto agregado</li>
        <li class="list-group-item">5 pedidos pendientes</li>
        <li class="list-group-item">Cliente nuevo registrado</li>
      </ul>
</aside>

  </div>







<?= $this->endSection() ?>
