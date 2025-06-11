<section  class="section_login">
   
   <?php $validation = \Config\Services::validation(); ?>
   

    <?php if(session()->getFlashdata('errors') !== null) : ?>
         <div class="mensajeBad" role="alert">
            <?= session()->getFlashdata('errors'); ?>
         </div>
        
        <?php endif;?>
      
                          

             
   <form  class="form-login text-center"  method="post" action="<?php echo base_url('ingresar') ?>">

   <h6 class="text-center text-white"> Iniciar Sesion</h6>
   <div  class="input-div">
               <div class="i">
                  <i class="fas fa-user"></i>
               </div>
               <div class="div">
                  <label for="email"></label>
                  <input id="email"  class="input" name="email" placeholder="Email" value="<?= set_value('email') ?>">
                   
               </div>
            
   </div>
   <?php if($validation->getError('email')) {?>
                                 <div class="mensajeBad" role="alert">
                                 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                 <?= $error = $validation->getError('email'); ?>
                                 </div>
                                 <?php }?>
                                      
                                     
   <div  class="input-div pass">
               <div class="i">
                  <i class="fas fa-lock"></i>
               </div>
               <div class="div">
                  <label for="password"></label>
                  <input  type="password" id="input" class="input" name="password"
                  value="<?= set_value('password') ?>" placeholder="Contraseña">
                  <div class="view">
               <div class="fas fa-eye verPassword text-white" onclick="vista()" id="verPassword"></div>
            </div>
               </div>
               
            
            </div>
            <?php if($validation->getError('password')) {?>
                                 <div class="mensajeBad" role="alert">
                                 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                 <?= $error = $validation->getError('password'); ?>
                                 </div>
                                 <?php }?>
           

            <div class="text-center" style="justify-content: space-between;" > 
  
               <a  class="nav-item nav-link text-justify text-success fw-bold" href="<?php echo base_url('registro') ?>"><span class="font-italic isai5 text-white" href="">¿Aun no te has registrado? </span>Registrate aqui</a>
            </div>
       <br>
   
   <input type="submit" value="Iniciar Sesion" class="btn btn-dark" style="">
   <?php if (session()->getFlashdata('mensaje')) { ?>
            <div  class="mensajeBad" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            <?= session()->getFlashdata('mensaje');?>
            
      
            </div>
        <?php } ?>
   </form>      
</section>
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
