<br>
<br>
<br>
<br>
<style>
        /* Fondo degradado para mayor profesionalismo */
        .bg-gradient-dark {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
        }
        /* Tarjeta con efecto más elegante */
        .card-custom {
            
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        /* Botón con gradiente */
        .btn-gradient {
            background: linear-gradient(90deg, #00b4db, #0083b0);
            border: none;
            color: white;
            font-weight: bold;
        }
        .btn-gradient:hover {
            background: linear-gradient(90deg, #0083b0, #005f73);
        }
    </style>
<section class="formularioAdicional text-white">

    
<div class="container my-5">
    <div class="row">
        <!-- Columna del formulario -->
        <div class="col-md-6">
            <div class="card card-custom bg-light text-dark p-4">
                <h2 class="text-center text-uppercase fw-bold">Completar Datos</h2>

                <!-- Mostrar mensaje de éxito -->
                <?php if (session()->has('success')): ?>
                    <div class="alert alert-success text-center" role="alert">
                        <?= session('success') ?>
                    </div>
                <?php endif; ?>
                <?php if(session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach(session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>


                <form action="<?= base_url('editar-datos/' . $usuario['id_usuario']) ?>" method="post" class="needs-validation" novalidate>
    <?= csrf_field() ?>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="direccion" value="<?= old('direccion', $usuario['direccion'] ?? '') ?> " required>
        </div>

        <div class="col-md-6">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="telefono" value="<?= old('telefono', $persona['telefono'] ?? '') ?>" pattern="^\d{10}$" required>
        </div>

        <div class="col-md-6">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" class="form-control" name="ciudad" value="<?= old('ciudad', $persona['ciudad'] ?? '') ?>" required>
        </div>

        <div class="col-md-6">
            <label for="pais" class="form-label">País</label>
            <input type="text" class="form-control" name="pais" value="<?= old('pais', $persona['pais'] ?? '') ?>" required>
        </div>

        <div class="col-md-6">
            <label for="dni" class="form-label">DNI</label>
            <input type="text" class="form-control" name="dni" value="<?= old('dni', $persona['dni'] ?? '') ?>" pattern="^\d{7,8}$" required>
        </div>

        <div class="col-md-6">
            <label for="codigo_postal" class="form-label">Código Postal</label>
            <input type="text" class="form-control" name="codigo_postal" value="<?= old('codigo_postal', $persona['codigo_postal'] ?? '') ?>" pattern="^\d{4,5}$" required>
        </div>

        <div class="col-md-12 text-center mt-3">
            <button type="submit" class="btn btn-primary w-50">Actualizar</button>
        </div>
    </div>
</form>


            </div>
        </div>

        <!-- Columna de Requisitos -->
        <div class="col-md-6">
            <div class="card card-custom bg-light text-dark p-4">
                <h3 class="text-center text-uppercase fw-bold">Requisitos</h3>
                <ul class="list-group">
                    <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Dirección: Debe contener calle y número.</li>
                    <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Teléfono: Solo números, 10 dígitos.</li>
                    <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Ciudad: No debe contener caracteres especiales.</li>
                    <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> País: Seleccione un país válido.</li>
                    <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> DNI: Solo números, entre 7 y 8 dígitos.</li>
                    <li class="list-group-item"><i class="bi bi-check-circle text-success"></i> Codigo Postal: Solo números, entre 4 y 5 dígitos.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
</section>

