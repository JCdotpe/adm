<?php 
if(isset($fluid)) {
?>
	<div class="row-fluid breadcrumbs">
<?php 
}else{ 
?>
	<div class="row breadcrumbs">
<?php 
} 
?>
		<div class="span6">
			<?php 
				if($this->ion_auth->logged_in()){
			?>
			<p class="navbar-text pull-right">Bienvenido <b><?php echo $user->username; ?></b> |  <?php echo anchor('auth/logout', 'Salir'); ?></p>
			<?php 
				}
			?>
		</div>
	</div>
	
</div><!-- cierra etiqueta del nav -->