
<?php
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : 'todas';
?><style>
  .card-img-top {
    height: 200px;
    object-fit: contain;
    padding: 1rem;
    background-color: #f8f9fa;
  }
</style>


<section class=" divBoxPrincipal">
<br>
  <nav class="d-flex justify-content-center" style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item "><a class="text-secondary text-decoration-none" href="<?php echo base_url('/');?>">Inicio</a></li>
      <li class="breadcrumb-item navbar-brand" aria-current="page">Catalogo</li>
    </ol>
  </nav>

  <h2 class="text-center mb-4">Nuestros Productos</h2>
  <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container">
    <a class="navbar-brand" href="<?= base_url('productos') ?>">Instrumentos</a>
    
    <!-- Botón hamburguesa -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCategorias" aria-controls="navbarCategorias" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menú colapsable -->
    <div class="collapse navbar-collapse" id="navbarCategorias">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('productos') ?>">Todos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('productos?categoria=guitarras') ?>">Guitarras</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('productos?categoria=bajos') ?>">Bajos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('productos?categoria=baterias') ?>">Baterías</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= base_url('productos?categoria=componentes') ?>">Componentes</a>
        </li>
      </ul>
    </div>
  </div>
</nav>



  <!-- Guitarras -->
   <div class="categoria guitarras" style="<?= ($categoria !== 'todas' && $categoria !== 'guitarras') ? 'display:none;' : '' ?>">
  <h3 class="text-center mb-4">Guitarras</h3>
  <p class="card-text text-center">Amplia variedad de guitarras clásicas, eléctricas y acústicas.</p>
  <div class="row justify-content-center mb-5">
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/guitarelectroacustic.png" class="card-img-top" alt="Guitarra">
        <div class="card-body">
          <h5 class="card-title">Guitarra Electroacústica</h5>
          <p class="card-text">Excelente para tocar en vivo con sonido acústico y posibilidad de amplificación.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/guitarIbanez.png" class="card-img-top" alt="Guitarra">
        <div class="card-body">
          <h5 class="card-title">Guitarra Ibanez</h5>
          <p class="card-text">Versátil y liviana, ideal para principiantes o guitarristas intermedios.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/guitarfender.png" class="card-img-top" alt="Guitarra">
        <div class="card-body">
          <h5 class="card-title">Guitarra Fender</h5>
          <p class="card-text">Diseñada para músicos avanzados que buscan un sonido profesional y clásico.</p>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Bajos -->
  <div class="categoria bajos" style="<?= ($categoria !== 'todas' && $categoria !== 'bajos') ? 'display:none;' : '' ?>">
  <h3 class="text-center mb-4">Bajos</h3>
  <p class="card-text text-center">Explora nuestros bajos de 4 y 5 cuerdas para todos los niveles.</p>
  <div class="row justify-content-center mb-5">
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/guitarbass4.png" class="card-img-top" alt="Bajo">
        <div class="card-body">
          <h5 class="card-title">Bajo Eléctrico 4 Cuerdas</h5>
          <p class="card-text">Sonido profundo y definido, ideal para rock, funk y jazz.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/guitarbass2.png" class="card-img-top" alt="Bajo">
        <div class="card-body">
          <h5 class="card-title">Bajo Eléctrico Vintage</h5>
          <p class="card-text">Estilo retro con tecnología moderna, perfecto para bajistas clásicos.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/guitarbass1.png" class="card-img-top" alt="Bajo">
        <div class="card-body">
          <h5 class="card-title">Bajo Eléctrico Activo</h5>
          <p class="card-text">Electrónica activa para mayor potencia y control del tono.</p>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Baterías -->
  <div class="categoria baterias" style="<?= ($categoria !== 'todas' && $categoria !== 'baterias') ? 'display:none;' : '' ?>">
  <h3 class="text-center mb-4">Baterías</h3>
  <p class="card-text text-center">Baterías acústicas y electrónicas ideales para estudio o escenario.</p>
  <div class="row justify-content-center mb-5">
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/drums2yamaha.png" class="card-img-top" alt="Batería">
        <div class="card-body">
          <h5 class="card-title">Batería Yamaha Studio</h5>
          <p class="card-text">Sonido definido y compacto, ideal para sesiones de grabación.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/drums3pearl.png" class="card-img-top" alt="Batería">
        <div class="card-body">
          <h5 class="card-title">Batería Pearl Export</h5>
          <p class="card-text">Una de las líneas más vendidas, robusta y de gran respuesta sonora.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/drums1.png" class="card-img-top" alt="Batería">
        <div class="card-body">
          <h5 class="card-title">Batería Yamaha Rock</h5>
          <p class="card-text">Configuración ideal para tocar en vivo con presencia y potencia.</p>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- Componentes -->
  <div class="categoria componentes" style="<?= ($categoria !== 'todas' && $categoria !== 'componentes') ? 'display:none;' : '' ?>">
  <h3 class="text-center mb-4">Componentes</h3>
  <p class="card-text text-center">Accesorios, micrófonos, palillos, pedales y más para tu setup.</p>
  <div class="row justify-content-center mb-5">
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/microphone1.png" class="card-img-top" alt="Micrófono">
        <div class="card-body">
          <h5 class="card-title">Micrófono Profesional</h5>
          <p class="card-text">Respuesta clara y precisa, ideal para vocalistas y locutores.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/microphone2.png" class="card-img-top" alt="Micrófono Studio">
        <div class="card-body">
          <h5 class="card-title">Micrófono Studio Condensador</h5>
          <p class="card-text">Alta sensibilidad para grabaciones profesionales en estudio.</p>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-lg-4">
      <div class="card h-100 shadow-sm border-0 text-center">
        <img src="assets/img/Instrumentos/palillo.png" class="card-img-top" alt="Palillos">
        <div class="card-body">
          <h5 class="card-title">Palillos para Batería</h5>
          <p class="card-text">Palillos de madera balanceados para prácticas y presentaciones.</p>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>

