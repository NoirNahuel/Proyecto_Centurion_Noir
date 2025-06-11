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
        <button class="btn btn-outline-dark btn-sm" id="verMasBtn" data-offset="<?= count($logs) ?>">Ver más</button>
    </div>
</div>

</div>

<script>
const verMasBtn = document.getElementById('verMasBtn');
const container = document.getElementById('accordionNotificaciones');

verMasBtn.addEventListener('click', async () => {
    verMasBtn.disabled = true;
    verMasBtn.textContent = 'Cargando...';

    const offset = parseInt(verMasBtn.getAttribute('data-offset'), 10);
    const url = '<?= base_url('cargarMas') ?>?offset=' + offset;

    try {
        const data = await fetch(url).then(res => res.json());

        // Si no hay más logs
        if (!data.html || data.count === 0) {
            verMasBtn.textContent = 'No hay más notificaciones';
            verMasBtn.disabled = false;
            return;
        }

        // Insertar el HTML devuelto directamente en el contenedor
        container.insertAdjacentHTML('beforeend', data.html);

        verMasBtn.setAttribute('data-offset', offset + data.count);
        verMasBtn.disabled = true;
        verMasBtn.textContent = 'Ver más';

    } catch (error) {
        console.error('Error al cargar más notificaciones:', error);
        verMasBtn.textContent = 'Error';
    }
});


    // Delegación para mostrar detalles
    container.addEventListener('click', (e) => {
        const btn = e.target.closest('.toggle-btn');
        if (!btn) return;
        const targetId = btn.getAttribute('data-target');
        const content = document.getElementById(targetId);

        if (content) {
            const isVisible = content.style.display === 'block';
            document.querySelectorAll('.collapse-content').forEach(el => el.style.display = 'none');
            content.style.display = isVisible ? 'none' : 'block';

            const icon = btn.querySelector('i');
            if (icon) {
                icon.classList.toggle('bi-chevron-down', isVisible);
                icon.classList.toggle('bi-chevron-up', !isVisible);
            }
        }
    });

</script>
