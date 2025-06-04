<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<style>
.dashboard-card {
  background: #ffffff;
  border-radius: 1.2rem;
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
  transition: transform 0.2s ease, box-shadow 0.3s ease;
  padding: 2rem 1.5rem;
  color: #333;
  border: 1px solid #e5e7eb;
}

.dashboard-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 28px rgba(0, 0, 0, 0.1);
}

.dashboard-icon {
  font-size: 3.5rem;
  margin-bottom: 1rem;
  color: #6366f1; /* Indigo estilo Tailwind */
}

.dashboard-title {
  font-weight: 600;
  font-size: 1.2rem;
  margin-bottom: 0.75rem;
  color: #1f2937;
}

/* Botón moderno, rectangular */
.dashboard-btn {
  display: inline-block;
  padding: 0.5rem 1.25rem;
  font-weight: 500;
  font-size: 0.9rem;
  border-radius: 0.5rem;
  border: 2px solid transparent;
  transition: all 0.2s ease-in-out;
  text-decoration: none;
}

.dashboard-btn:hover {
  transform: scale(1.05);
}

/* Colores personalizados para cada botón */
.btn-usuarios {
  background-color: #6366f1;
  color: white;
}

.btn-usuarios:hover {
  background-color: #4f46e5;
}

.btn-productos {
  background-color: #10b981;
  color: white;
}

.btn-productos:hover {
  background-color: #059669;
}

.btn-ventas {
  background-color: #ef4444;
  color: white;
}

.btn-ventas:hover {
  background-color: #dc2626;
}

.btn-consultas {
  background-color: #f59e0b;
  color: white;
}

.btn-consultas:hover {
  background-color: #d97706;
}
.dashboard-btn:hover {
  box-shadow: 0 0 0 3px rgba(0,0,0,0.1);
}


</style>
<!-- Sección de Bienvenida -->
<section class="bg-light py-2">
<div class="container">
    <div class="promo_card p-3 bg-white shadow-sm rounded">
        <h2 class=" text-dark mb-3">Bienvenido</h2>
        <p class="fs-6 text-dark mb-1">Usuario: <?= session('nombre'); ?> <?= session('apellido'); ?></p>
        <p class="fs-7 text-muted">Correo: <?= session('email'); ?></p>
        <!-- Funcionalidades de usuario administrador -->
        <?php if (session()->get('id_perfil') == 1): ?>
            <div class="text-center mt-3">
                <p class="mb-0 text-muted small">
                    <i class="bi bi-gear-fill me-1"></i> 
                    Administra tus productos, usuarios y ventas desde tu panel.
                </p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Sección de Administración -->
<section class="container my-5">
    <h2 class="text-center fw-bold text-secondary mb-5">Administración</h2>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <!-- Usuarios -->
        <div class="col">
            <div class="dashboard-card text-center">
                <i class="bi bi-people-fill dashboard-icon"></i>
                <h5 class="dashboard-title">Usuarios</h5>
                <a href="<?= base_url('usuarios') ?>" class="dashboard-btn btn-usuarios">Ver</a>
            </div>
        </div>
        <!-- Productos -->
        <div class="col">
            <div class="dashboard-card text-center">
                <i class="bi bi-box-seam dashboard-icon"></i>
                <h5 class="dashboard-title">Productos</h5>
                <a href="<?= base_url('productosadmin') ?>" class="dashboard-btn btn-productos">Ver</a>
            </div>
        </div>
        <!-- Ventas -->
        <div class="col">
            <div class="dashboard-card text-center">
                <i class="bi bi-cash-coin dashboard-icon"></i>
                <h5 class="dashboard-title">Ventas</h5>
                <a href="<?= base_url('ventas') ?>" class="dashboard-btn btn-ventas">Ver</a>
            </div>
        </div>
        <!-- Consultas -->
        <div class="col">
            <div class="dashboard-card text-center">
                <i class="bi bi-chat-dots-fill dashboard-icon"></i>
                <h5 class="dashboard-title">Consultas</h5>
                <a href="<?= base_url('Gestion_consultas/consultas') ?>" class="dashboard-btn btn-consultas">Ver</a>
            </div>
        </div>
    </div>
</section>


</section>

<?= $this->endSection() ?>