


        <!-- Aquí se insertan las notificaciones -->
<div class="card mb-2 shadow-sm border-0 fondo notificacion-item">
    <div class="card-body d-flex justify-content-between align-items-start">
        <div>
            <div class="fw-semibold">
                <?= $log['tipo_origen'] === 'usuario' ? esc($log['nombre']) : '<i class="fas fa-user"></i> Visitante ' ?>
                <span class="text-muted">realizó:</span>
                <span class="text-dark"><?= esc($log['accion']) ?></span>
            </div>
            <small class="text-muted"><?= esc($log['fecha_hora']) ?></small>
        </div>
        <button class="btn btn-sm btn-dark toggle-btn" data-target="detalle<?= $index ?>">
            <i class="bi bi-chevron-down"></i>
        </button>
    </div>
    <div id="detalle<?= $index ?>" class="collapse-content px-3 pb-3" style="display: none;">
        <div class="text-muted border-start ps-3 mt-2 small fst-italic">
            <?= esc($log['detalle']) ?>
        </div>
    </div>
</div>

