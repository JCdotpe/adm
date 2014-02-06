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
			<a class="navbar-brand" href="#">INEI</a>
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
							if($this->uri->segment(1) == $role->url){
								$c = ' class="active"';
							}
					?>
							<li <?php echo $c; ?>>
								<?php echo anchor(base_url().strtolower($role->url),$i++ .'. '.utf8_encode($role->role_name)); ?>
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
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>


<?php 
	if(isset($fluid)){ 
?>
	<div class="container-fluid front">
<?php 
	}else{ 
?>
	<div class="container front">
<?php 
	} 
	$this->load->view('backend/includes/breadcrumb');
?>