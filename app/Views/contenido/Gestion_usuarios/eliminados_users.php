<!-- app/Views/Gestion_usuarios/Usuarios de baja Logica -->
<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<section>
<h2 class="text-center mt-3">Tabla de Usuarios dado de baja</h2>

<div class="text-center">
    <?php if (!empty($search)) : ?>
        <a href="<?= site_url('/baja_usuario') ?>" class="text-center btn btn-sm btn-success rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0 ">Volver a Eliminados</a>
    <?php endif; ?>
    <a href="<?= site_url('/usuarios') ?>" class="text-center btn btn-sm btn-success rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0 "><i class="bi bi-arrow-left-circle me-2"></i>Volver a Usuarios </a>
    </div>
</section>



<div class="container mt-5">
    <div class="table-responsive">
        <table class="table table-dark table-hover">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Perfil ID</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) : ?>
        <?php if ($user['estado'] == 0) : ?>
        <tr>
            <td><?= $user['id_usuario'] ?></td>
            <td><?= $user['nombre'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $perfilMap[$user['id_perfil']] ?? 'Sin perfil' ?></td> <!-- Obtener descripción del perfil -->
            <td><?= $user['estado'] == 1 ? 'Activo' : 'Inactivo' ?></td>
            <td>                      
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
                   
            </td>
        </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</tbody>
</table>
        <?php if (isset($paginador)) : ?>
            <div>
                <?= $paginador->simpleLinks('default', 'bootstrap') ?>
            </div>
        <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>