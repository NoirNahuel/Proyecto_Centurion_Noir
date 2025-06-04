<style>
    .fondo:hover {
    background-color:rgb(206, 226, 216);
    transition: background-color 0.2s ease-in-out;
}
button.btn-link {
    color: #0d6efd;
}
#verMasContainer {
    position: absolute;
  
}

</style>

 <div>
<h5 class="mb-3"><i class="bi bi-bell-fill"></i> Notificaciones recientes</h5>
<div class="list-group">
    <div class="accordion" id="accordionNotificaciones">
        <?php foreach ($logs as $index => $log): ?>
            <?= view('components/notificacion_item', ['log' => $log, 'index' => $index]) ?>
        <?php endforeach; ?>
    </div>

    
</div>
<div class="text-center mt-3" id="verMasContainer">
        <button class="btn btn-outline-dark btn-sm" id="verMasBtn" data-offset="3">Ver más</button>
</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const verMasBtn = document.getElementById('verMasBtn');
    const container = document.getElementById('accordionNotificaciones');

    // Delegación para botones toggle
    container.addEventListener('click', function (e) {
        if (e.target.closest('.toggle-btn')) {
            const btn = e.target.closest('.toggle-btn');
            const targetId = btn.getAttribute('data-target');
            const content = document.getElementById(targetId);

            document.querySelectorAll('.collapse-content').forEach(el => {
                if (el.id !== targetId) el.style.display = 'none';
            });

            content.style.display = (content.style.display === 'block') ? 'none' : 'block';
        }
    });

    // Cargar más notificaciones
    verMasBtn?.addEventListener('click', async () => {
        const offset = parseInt(verMasBtn.getAttribute('data-offset'));

        try {
            const response = await fetch(`<?= base_url('cargar') ?>?offset=${offset}`);
            const logs = await response.json();

            if (logs.length === 0) {
                verMasBtn.style.display = 'none';
                return;
            }

            logs.forEach((log, i) => {
                const index = offset + i;
                const html = `
                    <div class="card mb-2 shadow-sm border-0 fondo notificacion-item">
                        <div class="card-body d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fw-semibold">
                                    ${log.tipo_origen === 'usuario' ? log.nombre : '<i class="fas fa-user"></i> Visitante '}
                                    <span class="text-muted">realizó:</span>
                                    <span class="text-dark">${log.accion}</span>
                                </div>
                                <small class="text-muted">${log.fecha_hora}</small>
                            </div>
                            <button class="btn btn-sm btn-dark toggle-btn" data-target="detalle${index}">
                                <i class="bi bi-chevron-down"></i>
                            </button>
                        </div>
                        <div id="detalle${index}" class="collapse-content px-3 pb-3" style="display: none;">
                            <div class="text-muted border-start ps-3 mt-2 small fst-italic">
                                ${log.detalle}
                            </div>
                        </div>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', html);
            });

            // Actualiza offset para la siguiente carga
            verMasBtn.setAttribute('data-offset', offset + logs.length);
        } catch (error) {
            console.error('Error al cargar más notificaciones:', error);
        }
    });
});
</script>
