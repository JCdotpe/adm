<nav id="nav-primary" class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="<?php echo base_url('index.php'); ?>">CIE2013</a>
		</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
			<?php
				if($this->ion_auth->logged_in()){
					$roles = $this->ion_auth->get_roles();
					if(!empty($roles)){
			?>
					<?php
						$i = 1;
						foreach ($roles as $role){
							$c = "";
							$uri = "index.php/".$this->uri->segment(1);
							if($uri == $role->url){
								$c = ' class="active"';
							}
					?>
							<li <?php echo $c; ?>>
								<?php echo anchor(base_url().strtolower($role->url),utf8_encode($role->role_name)); ?>
							</li>
					<?php
						}
					}
				}else{
			?>
					<li>
						<a href="<?php echo base_url('index.php/auth/login'); ?>">Login</a>
					</li>
			<?php 
				}
			?>

			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="glass dropdown">
					<a id="nav-user" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Proyectos  <b class="caret"></b></a>
					<ul id="ltproyectos" class="dropdown-menu">
						<?php $ref = ( $this->uri->segment(1) != '' ) ? site_url().'/'.$this->uri->segment(1).'/index/00000001' : ''; ?>
						<li><a href="<?php echo $ref; ?>"><i class="fa fa-gear"></i> Proyecto 1</a></li>
						<li><a href="<?php echo $ref; ?>"><i class="fa fa-key"></i> Proyecto 2</a></li>
					</ul>
				</li>
			</ul>
			
			<?php 
				if($this->ion_auth->logged_in()){
			?>
			<ul class="nav navbar-nav navbar-right">
				<li class="glass dropdown">
					<a id="nav-user" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>  <?php echo $user->username; ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="fa fa-gear"></i> Configurar</a></li>
						<li><a href="#"><i class="fa fa-key"></i> Cambiar contraseña</a></li>
						<li class="divider"></li>
						<li> <?php echo anchor('auth/logout', 'Salir'); ?></li>
					</ul>
				</li>
			</ul>
			<?php 
				}
			?>

		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>


<?php 
	if(isset($fluid)){ 
?>
	<div class="container-fluid main-content">
<?php 
	}else{ 
?>
	<div class="container-fluid main-content">
<?php 
	} 
	
?>