<?php if (session()->getFlashdata('errorFilter')): ?>
<style>
  /* Estilos personalizados para un modal oscuro, elegante y moderno */
  .custom-modal-content {
    background-color: #1e1e2f;
    color: #f0f0f0;
    border-radius: 1rem;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.6);
    border: none;
    transition: all 0.3s ease-in-out;
  }

  .custom-modal-header {
    background: linear-gradient(to right, #2c2c3e, #1e1e2f);
    border-bottom: none;
    padding: 1.5rem;
    border-top-left-radius: 1rem;
    border-top-right-radius: 1rem;
  }

  .custom-modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    color: #ff6b6b;
  }

  .custom-modal-title i {
    margin-right: 0.5rem;
    font-size: 1.5rem;
  }

  .custom-modal-body {
    padding: 1.5rem;
    font-size: 0.95rem;
    color: #d6d6d6;
  }

  .custom-modal-footer {
    padding: 1rem 1.5rem 1.5rem;
    border-top: none;
    display: flex;
    justify-content: flex-end;
  }

  .btn-custom-close {
    background-color: transparent;
    color: #aaa;
    border: 1px solid #444;
    border-radius: 2rem;
    padding: 0.5rem 1.2rem;
    transition: all 0.2s ease;
  }

  .btn-custom-close:hover {
    background-color: #2a2a3c;
    color: #fff;
    border-color: #666;
  }

  .btn-close-white {
    filter: invert(1);
  }
</style>

<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content custom-modal-content">
      <div class="modal-header custom-modal-header">
        <h5 class="modal-title custom-modal-title" id="errorModalLabel">
          <i class="bi bi-exclamation-circle-fill"></i> Advertencia
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body custom-modal-body">
        <?= session()->getFlashdata('errorFilter') ?>
      </div>
      <div class="modal-footer custom-modal-footer">
        <button type="button" class="btn btn-custom-close" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    errorModal.show();
  });
</script>


  <!-- Verificamos si hay flash de error -->
<?php if(session()->getFlashdata('error')): ?>
  <!-- Modal -->
  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="errorModalLabel">Advertencia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          <?= session()->getFlashdata('error'); ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Script para mostrar el modal automáticamente -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
      errorModal.show();
    });
  </script>
<?php endif; ?>

<section class="banner">
  <div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 g-12 ">
  <div class="info content-banner col w-100 mx-auto  ">
  
   <h3 >Instrumentos de primera calidad</h3>
    <div >
    <a type="button"  class="btn btn-outline-light btn-sm" href="<?php echo base_url('productos');?>">Comprar ahora</a>
    </div>
  </div>
  <br>
  
</section> 

<section id="clients" class="container my-5">
  <div class="row align-items-center">
    
    <!-- Texto -->
    <div class="col-12 col-md-6 mb-4 mb-md-0">
      <div class="section-heading">
        <h3 class="text-secondary">Instrumentos Musicales</h3>
        <h2 class="section-title">Descubrí las marcas más confiables del mundo musical.</h2>
        <p class="section-subtitle">
          Trabajamos con fabricantes líderes que garantizan calidad, innovación y sonido profesional. Desde guitarras legendarias hasta equipos de audio de alta gama, elegimos solo lo mejor para vos.
        </p>
      </div>
    </div>

    <!-- Imagen -->
    <div class="col-12 col-md-6 d-flex justify-content-center">
      <div class="brand-image-wrapper">
        <img src="assets/img/marcas.jpg" alt="Fender logo" class="img-fluid rounded shadow brand-img">
      </div>
    </div>

  </div>
</section>




<section class="py-5">
  <div class="container">
    <h2 class="text-center fw-bold mb-4">Bandas que rugieron en Guitar N'Cent</h2>

    <div class="row g-4">
      <!-- Banda 1 -->
      <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card bg-black border-0 shadow-lg h-100 d-flex flex-column">
          <div class="d-flex justify-content-center align-items-center" style="height: 200px; overflow: hidden;">
            <img src="assets/img/rollingstones.png" alt="Pink Floyd" class="img-fluid" style="max-height: 100%; object-fit: cover;">
          </div>
          <div class="card-body text-center">
            <h5 class="card-title text-warning">Rolling Stones</h5>
            <p class="card-text text-white">Pasaron por nuestra tienda en su gira mundial 2015. ¡Se llevaron 5 guitarras custom!</p>
          </div>
        </div>
      </div>

      <!-- Banda 2 -->
      <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card bg-black border-0 shadow-lg h-100 d-flex flex-column">
          <div class="d-flex justify-content-center align-items-center" style="height: 200px; overflow: hidden;">
            <img src="assets/img/foofighters.png" alt="Foo Fighters" class="img-fluid" style="max-height: 100%; object-fit: cover;">
          </div>
          <div class="card-body text-center">
            <h5 class="card-title text-warning">Foo Fighters</h5>
            <p class="card-text text-white">Amantes de los pedales análogos, nos visitaron para grabar su último disco.</p>
          </div>
        </div>
      </div>
      
      <!-- Banda 2 -->
      <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card bg-black border-0 shadow-lg h-100 d-flex flex-column">
          <div class="d-flex justify-content-center align-items-center" style="height: 200px; overflow: hidden;">
            <img src="assets/img/oasis.png" alt="Foo Fighters" class="img-fluid" style="max-height: 100%; object-fit: cover;">
          </div>
          <div class="card-body text-center">
            <h5 class="card-title text-warning">Oasis</h5>
            <p class="card-text text-white">Nos visitaron para grabar su último disco desde su regreso en 2024.</p>
          </div>
        </div>
      </div>

      <!-- Banda 4 -->
      <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card bg-black border-0 shadow-lg h-100 d-flex flex-column">
          <div class="d-flex justify-content-center align-items-center" style="height: 200px; overflow: hidden;">
            <img src="assets/img/gunsandroses.png" alt="Guns and Roses" class="img-fluid" style="max-height: 100%; object-fit: cover;">
          </div>
          <div class="card-body text-center">
            <h5 class="card-title text-warning">Guns and Roses</h5>
            <p class="card-text text-white">Nos eligieron para equipar todo su estudio para gira en Argentina. ¡Orgullo nacional!</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



  <section>
  
  <div class="container text-center">
  <h2 class="heading-1">Encontra el instrumento que estas buscando</h2>
    <div class="row">
      <div class="col-sm-12">
        <div id="carouselExampleIndicators" class="carousel slide carousel-item active" class="carousel slide d-none d-lg-block" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="<?php echo base_url("../assets/img/banner_4.jpg");?>"  class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="<?php echo base_url("../assets/img/banner-5.jpg");?>" class="d-block w-100 " alt="...">
            </div>
            
            <div class="carousel-item">
              <img src="<?php echo base_url("../assets/img/guitar2_banner.jpg");?>" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="<?php echo base_url("../assets/img/fender-banner.webp");?>" class="d-block w-100" alt="...">
            </div>
            
            
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</section> 
<!-- Seccion de categoria primera parte- sin traer categorias de la base de datos
<section class="container top-categorias ">
      <h1 class="heading-1">Categorias</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 " class="container-categorias">
    <div class="col ">
      <div class="container-fluid card-category category-guitarra ">
        <p>Guitarras</p>
       <a class="text-decoration-none" href="productos?categoria=guitarras"><span >Ver mas</span></a>

      </div>
      </div>
      <div class="col">
      <div class="container-fluid card-category category-bajo">
        <p>Bajos</p>
        <a class="text-decoration-none" href="productos?categoria=bajos"><span >Ver mas</span></a>
      </div>
      </div>
      <div class="col">
      <div class="container-fluid card-category category-bateria">
        <p>Baterias</p>
        <a class="text-decoration-none" href="productos?categoria=baterias"><span >Ver mas</span></a>>
      </div>
      </div>
      <div class="col">
      <div class="container-fluid card-category category-componente">
        <p>Componentes</p>
        <a class="text-decoration-none" href="productos?categoria=componentes"><span >Ver mas</span></a>>
      </div>
      </div>
    </div>
  </section>
  -->
  <!-- Seccion CATEGORIA 2da entrega modificado para trabajar con base de datos -->
<section class="container top-categorias" style="max-width: 80%;">
  <h2 class="heading-1 text-center mb-4">Categorías</h2>
  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4">
    <?php foreach ($categorias as $categoria): ?>
      <div class="col">
        <form action="<?= base_url('productos') ?>" method="post">       
          <div class="container-fluid card-category <?= 
            $categoria['id_categoria'] == 1 ? 'category-guitarra' :
            ($categoria['id_categoria'] == 2 ? 'category-bajo' :
            ($categoria['id_categoria'] == 3 ? 'category-bateria' :
            ($categoria['id_categoria'] == 4 ? 'category-componente' : '')))
          ?>">
            <h4 class="text-white"><?= esc($categoria['descripcion']) ?></h4>
            <select hidden name="id_categoria">   
              <option value="<?= $categoria['id_categoria'] ?>"></option>
            </select>
            <button class="btn btn-dark btn-sm mt-1">Ver más</button>
          </div>
        </form>
      </div>
    <?php endforeach; ?>
  </div>
</section>
<section>
    <h2 class="text-center"><a href="<?php echo base_url('registro');?>"><i class="fa-solid fa-right-to-bracket"></i></a> Registrate aqui</h3>
   <p class="text-center">Crear cuenta y empeza a navegar </p>

  </section>
<!-- Modal -->
<div class="modal fade" id="modalDesarrollo" tabindex="-1" aria-labelledby="modalDesarrolloLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-center text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title w-100 text-white" id="modalDesarrolloLabel">🔧 En Desarrollo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <p style="color:rgb(19, 96, 99); font-size: 1.1rem;">
          Esta funcionalidad aún no está disponible.<br>
          ¡Estamos afinando los últimos detalles! 🎸
        </p>
      </div>
      <div class="modal-footer border-0 justify-content-center">
        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>





