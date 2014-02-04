<?php if(isset($fluid)){ ?>

      <div class="row-fluid breadcrumbs">

<?php }else{ ?>

      <div class="row breadcrumbs">

<?php } ?>

        <div class="span6 navbar-text">

          <!--<?php echo set_breadcrumb(); ?>-->

        </div>

           <div class="span6">

            <?php if($this->tank_auth->is_logged_in()){ ?>

            <p class="navbar-text pull-right">Bienvenido <b><?php echo $this->tank_auth->get_username() ?></b> |  <?php echo anchor('auth/logout', 'Salir'); ?></p>

              <?php }?>

            </div>

    </div>