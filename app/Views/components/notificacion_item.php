
<div class="notification-item card border-0 shadow-sm mb-2 <?= $log['tipo_origen'] === 'usuario' ? 'bg-light border-start border-success' : 'bg-white border-start border-warning' ?>">
    <div class="card-body d-flex justify-content-between align-items-start">
        <div>
            <div class="fw-semibold mb-1">
                <?= $log['tipo_origen'] === 'usuario' && isset($log['nombre']) ? '<i class="fas fa-user-circle me-1 text-success"></i> <strong>' . esc($log['nombre']) . '</strong>' : '<i class="fas fa-user me-1 text-warning"></i> <strong>'  ?>
                <span class="text-muted">realizó:</span>
                <span class="text-dark"><?= esc($log['accion']) ?></span>
            </div>
            <small class="text-muted"><?= esc($log['fecha_hora']) ?></small>
        </div>
        <button class="btn btn-sm btn-outline-secondary toggle-btn" data-target="detalle<?= $index ?>">
            <i class="bi bi-chevron-down"></i>
        </button>
    </div>

    <div id="detalle<?= $index ?>" class="collapse-content px-3 pb-3" style="display: none;">
        <div class="text-muted border-start ps-3 mt-2 small fst-italic">
            💬 <?= esc(($log['detalle'])) ?>
        </div>
    </div>
</div>

