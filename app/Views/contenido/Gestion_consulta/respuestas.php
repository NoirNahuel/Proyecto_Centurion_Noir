<!-- app/Views/consultas.php -->
<?= $this->extend('layouts') ?>

   
<?= $this->section('contenido') ?>
<section class="py-2 bg-light" >
    <div class="container mt-4 text-center">
     <a href="<?= site_url('/consultas') ?>" class=" custom-btn btn btn-sm btn-success rounded-pill px-4 shadow-sm ms-lg-3 mt-2 mt-lg-0"><i class="bi bi-question-circle"></i>
    </i>Consultas </a></div><br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="card border-secondary shadow-sm">
                    <div class="card-header bg-dark text-white text-center py-2">
                        <h5 class="mb-0">Detalles de la Consulta</h5>
                    </div>
                    <div class="card-body p-3">
                        <p class="card-title text-success text-center mb-2 small">
                            ID de consulta: <?= $consulta['id_consulta'] ?>
                        </p>
                        <p class="mb-2 small">
                            <strong class="text-dark">Correo electrónico:</strong> 
                            <span class="text-secondary"><?= $consulta['email'] ?></span>
                        </p>
                        <div class="bg-light p-2 rounded border" style="max-height: 150px; overflow-y: auto;">
                            <p class="card-text mb-0 text-muted small"><?= $consulta['mensaje'] ?></p>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center py-2 small">
                        Fecha de consulta: <span class="text-dark"><?= $consulta['fecha_consulta'] ?></span>
                    </div>
                    <div class="card-body p-3">
                        <form action="<?= base_url('respuesta/' . $consulta['id_consulta']) ?>" method="post">
                            <input type="hidden" name="id" value="<?= $consulta['id_consulta'] ?>">
                            <input type="hidden" name="email" value="<?= $consulta['email'] ?>">
                            <input type="hidden" name="mensaje" value="<?= $consulta['mensaje'] ?>">

                            <div class="mb-3">
                                <label for="respuesta" class="form-label text-dark small">Escribe tu respuesta</label>
                                <textarea class="form-control form-control-sm border-secondary" id="respuesta" name="respuesta" rows="5" placeholder="Escribe tu respuesta aquí..." required></textarea>
                            </div>
                            
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-success px-3">
                                    <i class="fas fa-paper-plane"></i> Enviar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>