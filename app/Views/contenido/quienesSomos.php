<section class="divBoxPrincipal py-5">
    <div class="container">
        <!-- Breadcrumb -->
        <nav class="d-flex justify-content-center mb-4" style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent">
                <li class="breadcrumb-item"><a class="text-secondary text-decoration-none" href="<?php echo base_url('/');?>">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quiénes Somos</li>
            </ol>
        </nav>

        <!-- Título principal -->
        <h2 class="titulo text-center mb-5">¿Quiénes Somos?</h2>

        <!-- Descripción de la empresa -->
        <p class="lead text-center mb-5">
            <strong>Guitar Cent S.A.</strong> nace en 2005 como una evolución de una familia con raíces en la industria musical. 
            Con pasión por la innovación, diseñamos y vendemos instrumentos musicales personalizados para profesionales y estudiantes. 
            Nuestra meta: llevar la calidad del sonido al siguiente nivel con actitud rockera.
        </p>

        <!-- Misión y visión -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <h2 class="fw-bold ">Misión</h2>
                <p>
                    Brindar a músicos profesionales y apasionados la más amplia selección de instrumentos musicales con calidad sonora excepcional, durabilidad garantizada y estilo. Nos comprometemos a ofrecer tecnología de vanguardia y un servicio personalizado que inspire creatividad y potencia artística.
                </p>
                <h2 class="fw-bold mt-4">Visión</h2>
                <p>
                    Ser líderes en Latinoamérica en instrumentos personalizados, consolidando una comunidad donde el arte, la tecnología y el espíritu musical se unen en una sola nota.
                </p>
            </div>
            <div class="col-md-6 text-center">
                <img class="img-fluid rounded shadow-lg" src="<?php echo base_url("../assets/img/guitar_person.jpg");?>" alt="Misión y visión">
            </div>
        </div>

        <!-- Equipo -->
        <h2 class="text-center text-warning mb-4">Nuestro Equipo</h2>
        <div class="row g-4 justify-content-center">
            <!-- Miembro 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white shadow-lg text-center h-100">
                    <img 
                        src="<?php echo base_url('../assets/img/perfil1.jpg'); ?>" 
                        class="card-img-top rounded-circle mx-auto mt-4" 
                        alt="Dave Mustaine" 
                        style="width: 150px; height: 150px; object-fit: cover;"
                    >
                    <div class="card-body">
                        <h5 class="card-title  fw-bold">Dave Centurion</h5>
                        <p class="card-text">Fundador y alma creativa. Luthier, productor y guitarrista. Visión y distorsión con propósito.</p>
                    </div>
                </div>
            </div>

            <!-- Miembro 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white shadow-lg text-center h-100">
                    <img 
                        src="<?php echo base_url('../assets/img/perfil2.jpg'); ?>" 
                        class="card-img-top rounded-circle mx-auto mt-4" 
                        alt="Jones Stheven" 
                        style="width: 150px; height: 150px; object-fit: cover;"
                    >
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Jones Noir</h5>
                        <p class="card-text">Experto en materiales y sonido. Conoce cada madera como la palma de su mano.</p>
                    </div>
                </div>
            </div>

            <!-- Miembro 3 (opcional agregado) -->
            <div class="col-md-6 col-lg-4">
                <div class="card bg-secondary text-white shadow-lg text-center h-100">
                    <img 
                        src="<?php echo base_url('../assets/img/perfil3.jpg'); ?>" 
                        class="card-img-top rounded-circle mx-auto mt-4" 
                        alt="Samantha Vega" 
                        style="width: 150px; height: 150px; object-fit: cover;"
                    >
                    <div class="card-body">
                        <h5 class="card-title  fw-bold">Samantha Vega</h5>
                        <p class="card-text">Directora de Marketing y conexión con la comunidad rockera. Voz fuerte y clara en redes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

       