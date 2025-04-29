<section class="banner">
  <div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 g-12 ">
  <div class="info content-banner col w-100 mx-auto  ">
  
   <h3 >Instrumentos de primera calidad</h3>
    <div class="comprar">
    <button type="button"  class="btn btn-outline-light btn-sm" data-bs-toggle="modal" data-bs-target="#modalDesarrollo">Comprar Ahora</button>
    </div>
  </div>
  <br>
  
</section> 

<section class="py-5 ">
  <div class="container">
    <h2 class="text-center fw-bold">Bandas que rugieron en Guitar N'Cent</h2>
    
    <div class="row g-4">
      <!-- Banda 1 -->
      <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card bg-black border-0 shadow-lg h-100">
        <img src="assets/img/pinkfloid.jpg" class="img-fluid w-100" style="height: 200px; object-fit: cover;" alt="Banda 1">

          <div class="card-body text-center">
            <h5 class="card-title text-warning">Pink Floid</h5>
            <p class="card-text">Pasaron por nuestra tienda en su gira mundial 2022. ¡Se llevaron 5 guitarras custom!</p>
          </div>
        </div>
      </div>

      <!-- Banda 2 -->
      <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card bg-black border-0 shadow-lg h-100">
          <img src="assets/img/foofighters.jpg" class="img-fluid w-100" style="height: 200px; object-fit: cover;" alt="Banda 2">
          <div class="card-body text-center">
            <h5 class="card-title text-warning">Foo Fighters</h5>
            <p class="card-text">Amantes de los pedales análogos, nos visitaron para grabar su último disco.</p>
          </div>
        </div>
      </div>

      <!-- Banda 3 -->
      <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="card bg-black border-0 shadow-lg h-100">
          <img src="assets/img/gunsandroses.jpg" class="img-fluid w-100" style="height: 200px; object-fit: cover;" alt="Banda 3">
          <div class="card-body text-center">
            <h5 class="card-title text-warning">Guns and Roses</h5>
            <p class="card-text">Nos eligieron para equipar todo su estudio para gira en Argentina. ¡Orgullo nacional!</p>
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
<section class="container top-categorias ">
      <h1 class="heading-1">Categorias</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 " class="container-categorias">
    <div class="col ">
      <div class="container-fluid card-category category-guitarra ">
        <p>Guitarras</p>
       <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalDesarrollo"><span >Ver mas</span></a>

      </div>
      </div>
      <div class="col">
      <div class="container-fluid card-category category-bajo">
        <p>Bajos</p>
        <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalDesarrollo"><span >Ver mas</span></a>
      </div>
      </div>
      <div class="col">
      <div class="container-fluid card-category category-bateria">
        <p>Baterias</p>
        <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalDesarrollo"><span >Ver mas</span></a>>
      </div>
      </div>
      <div class="col">
      <div class="container-fluid card-category category-componente">
        <p>Componentes</p>
        <a class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modalDesarrollo"><span >Ver mas</span></a>>
      </div>
      </div>
    </div>
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





