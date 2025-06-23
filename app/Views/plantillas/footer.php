    <!-- Footer para Usuario perfil 1-administrador -->
     <?php if (session()->get('id_perfil') == 1): ?> 
<footer class="degradado text-white-50 text-center py-2 mt-auto">
      <small>&copy; <?= date('Y'); ?> Guitar N' Cent - Panel Admin</small>
 </footer>
 <?php endif; ?>
 <!-- Footer para Usuario perfil 2-Cliente -->
     <?php if (session()->get('id_perfil') == 2): ?> 
<!-- Footer -->
<footer class="fs-6 text-white bg-body-tertiary text-center degradado">
  <!-- Footer content -->
  <section class="text-white pt-5">
    <div class="container text-center text-md-center">
      <div class="row text-center p-5 pb-2 text-white">
        <!-- Col 1 -->
       <!-- Columna 1: Logo y Ubicación -->
    
         <!-- Col 1 -->
         <div class="col-12 col-md-6 col-lg-3 text-center text-md-start">
          <h5><strong><img src="<?php echo base_url('../assets/img/guitarCent_logo.png'); ?>" alt="Logo de MateCamp" style="max-height: 50px;">
          Guitar N'Cent</strong></h5>
          <ul class="list-unstyled d-inline-block d-md-block text-center text-md-start">
            <li class="mb-2 d-flex align-items-center justify-content-center justify-content-md-start">
            <address class="d-flex align-items-center gap-2">
          <i class="fas fa-home"></i>
          <span>Argentina, Corrientes</span>
        </address>
            </li>
            <li class="mb-2 d-flex align-items-center justify-content-center justify-content-md-start">
            <address class="d-flex align-items-center gap-2">
          
          Siempre junto a vos.
        </address>
            </li>
            
          </ul>
        </div>

        <!-- Columna 2: Contacto -->
        <div class="col-12 col-md-6 col-lg-3 text-center text-md-start">
      <h5><strong>Contacto</strong></h5>
      <ul class="list-unstyled d-flex flex-column align-items-center align-items-md-start">
      <li class="mb-2">
            <i class="fas fa-envelope me-2"></i>
            <a href="mailto:esteban.cent95@gmail.com" class="text-white text-decoration-none">GuitarNCent@gmail.com</a>
          </li>
          <li class="mb-2">
          <i class="fab fa-facebook-f"></i>
            <a href="https://es-la.facebook.com/" class="text-white text-decoration-none">GuitarNCent</a>
          </li>
          <li class="mb-2">
          <i class="fab fa-instagram"></i>
            <a href="https://www.instagram.com/" class="text-white text-decoration-none">GuitarNCent</a>
          </li>
          <li class="mb-2">
            <i class="fas fa-phone me-2"></i>
            <a href="https://web.whatsapp.com/" class="text-white text-decoration-none">Whatsapp</a>
          </li>
      </ul>
    </div>

              <!-- Col 3 -->
        <div class="col-12 col-md-6 col-lg-3 text-center text-md-start">
          <h5><strong>Métodos de Pago</strong></h5>
          <ul class="list-unstyled d-flex flex-column align-items-center align-items-md-start">
            <li class="mb-2 d-flex align-items-center">
            <img src="<?php echo base_url('/assets/img/mediosPagos/efectivo.png'); ?>" alt="Efectivo" style="height: 20px;">
              <span>Efectivo</span>
            </li>
            <li class="mb-2 d-flex align-items-center">
            <img src="<?php echo base_url('/assets/img/mediosPagos/visa4.png'); ?>" alt="Tarjeta de Crédito" style="height: 20px;">
              <span>Tarjeta de Crédito</span>
            </li>
            <li class="mb-2 d-flex align-items-center">
            <img src="<?php echo base_url('/assets/img/mediosPagos/naranja.png'); ?>" alt="Tarjeta de Debito" style="height: 20px;">
              <span>Tarjeta de Débito</span>
            </li>
            <li class="mb-2 d-flex align-items-center">
            <img src="<?php echo base_url('/assets/img/mediosPagos/mp.png'); ?>" alt="Mercado Pago" style="height: 20px;">
              <span>Mercado Pago</span>
            </li>
          </ul>
        </div>


        <!-- Col 4 -->
        <div class="col-12 col-md-6 col-lg-3 text-center text-md-start">
          <h5><strong>Formas de Envío</strong></h5>
          <ul class="list-unstyled d-inline-block d-md-block text-center text-md-start">
            <li class="mb-2 d-flex align-items-center justify-content-center justify-content-md-start">
              <i class="fas fa-store me-2"></i> Retiro en Tienda
            </li>
            <li class="mb-2 d-flex align-items-center justify-content-center justify-content-md-start">
              <i class="fas fa-envelope me-2"></i> Correo Argentino
            </li>
            <li class="mb-2 d-flex align-items-center justify-content-center justify-content-md-start">
              <i class="fas fa-truck me-2"></i> Andreani
            </li>
            <li class="mb-2 d-flex align-items-center justify-content-center justify-content-md-start">
              <i class="fas fa-shipping-fast me-2"></i> Oca
            </li>
          </ul>
        </div>
        <!-- Información adicional -->
    <div class="col-xs-12 pt-4">
    <hr>
       <div>
      <p class="text-center text-white">
        Desarrollado por 
        <a class="text-white text-decoration-none" href="https://exa.unne.edu.ar/r/?page_id=8390">Taller de Programación (FACENA) Centurión-Noir</a>
      </p>
    </div>
    <hr>
    <div >
      <p class="text-white text-center">Copyright - All rights reserved 2025</p>
    </div>
  </div>
      </div>
  </section>
</footer>
 <?php endif; ?>

  <!-- Bootstrap JS (solo una vez) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Tu archivo JavaScript personalizado (una sola vez) -->
  <script src="<?php echo base_url('../assets/js/main2.js'); ?>"></script>




  <!-- Font Awesome (si usas íconos) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
  </body>
</html>