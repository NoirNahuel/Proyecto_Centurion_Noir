<br>
<br>
<br>
<hr>
   <nav  class="d-flex justify-content-center" style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item "><a class="text-secondary text-decoration-none" href="<?php echo base_url('principal');?>">Inicio</a></li>
    <li class="breadcrumb-item navbar-brand" aria-current="page">Producto</li>
  </ol>
</nav>
<div class="d-flex justify-content-center">
    <section  class="section_registrarse" >
            <?php $validation = \Config\Services::validation(); ?>
            
          
       
      
            <form method="post" action="<?php echo base_url('validar') ?>">
                 
                      <!--  <form class="form-registro text-center" action="" method="POST"> -->
                     
                     
                        <div >
                     
                            <div class="form-login">
                            <h5 class="text-center text-white"> Registrate</h5>
                            <?php if (session()->getFlashdata('mensaje')) { ?>
    <div class="alert alert-dismissible fade show" style="background-color: #d0ebff; color: #000; position: relative; padding: 15px; border: 1px solid #bee3f8; border-radius: 5px;">
        <i class="fa-solid fa-circle-check fa-xl" style="color: #007bff; margin-right: 10px;"></i>
        <?= session()->getFlashdata('mensaje'); ?>
        <a data-bs-dismiss="alert" aria-label="Close" style="position: absolute; right: 15px; top: 15px; color: #000; cursor: pointer;">
            <i class="fa-solid fa-xmark fa-xl"></i>
        </a>
    </div>
<?php } ?>

                                
                                      
                               
                        <div class="text-center" class="mb-3" class="div">
                                <label for="nombre" class="form-label text-white"></label>
                                <input class="form-control" name="nombre" placeholder="Nombre"  type="text" id="usuario" value="<?= set_value('nombre') ?>">

                                  <?php if($validation->getError('nombre')) {?>
                                 <div class="mensajeBad" role="alert">
                                 <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                 <?= $error = $validation->getError('nombre'); ?>
                                 </div>
                                 <?php }?>
                                
                                 </div>
                                  <div class="text-center" class="mb-3" class="div">
                                    
                                  <label for="apellido" class="form-label text-white" ></label>
                                  <input class="form-control" name="apellido" placeholder="Apellido" type="text" id="apellido" value="<?= set_value('apellido') ?>">
                                  <?php if($validation->getError('apellido')) {?>
                                  <div class="mensajeBad" role="alert">
                                  <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                  <?= $error = $validation->getError('apellido'); ?>
                                  </div>
                                  <?php }?>
                                     </div>

                                     <div class="text-center text-white" class="mb-3" class="div">
                                     <label for="email"></label>
                                     <input class="form-control" name="email"  id="email" placeholder="correo@example.com" value="<?= set_value('email') ?>">
                                     <?php if($validation->getError('email')) {?>
                                    <div  class="mensajeBad" role="alert">
                                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    <?= $error = $validation->getError('email'); ?>
                                      </div>
                                    <?php }?>
                                     
                                </div>
                             
                                
                                <div class="text-center" class="mb-3" class="div">

                                   
                                      <label for="password" class="text-white"></label>
                                      <input class="form-control" name="password" type="password" placeholder="Contraseña" id="password">
                                      <?php if($validation->getError('password')) {?>
                                      <div  class="mensajeBad" role="alert">
                                      <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                      <?= $error = $validation->getError('password'); ?>
                                      </div>
                                      <?php }?>
                                      </div>

                                    <div class="text-center" class="mb-3" class="div">

                                   
                                    <label for="password_equal" class="text-white"></label>
                                    <input class="form-control" name="password_equal" type="password" placeholder="Confirmar Contraseña" id="password_equal">
                                    <?php if($validation->getError('password_equal')) {?>
                                   <div  class="mensajeBad" role="alert">
                                     <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                     <?= $error = $validation->getError('password_equal'); ?>
                                  </div>
                                   <?php }?>
                                    </div>

                                   
                        
                            <div class="text-center" class="div">
                           <br>
                           <input type="submit" value="Registrarse" class="btn btn-success" style="">
                           </div>
                          
                        
                         <br>
                         <br>
                        </div>
                        
                       
         </form>

          
        </section>  
        </div>

