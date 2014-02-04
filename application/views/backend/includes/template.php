<?php $this->load->view('backend/includes/header'); ?>
<?php 
if(isset($nav)){
		$this->load->view('backend/includes/nav'); 
}else{
		echo '<div class="container-fluid">';
} 
?>
<?php $this->load->view($main_content); ?>
<?php 
if(!isset($static)){
	if(isset($sidebar)){
		$this->load->view('backend/includes/sidebar'); 
	}else{
		
	}
}
?>
<?php $this->load->view('backend/includes/footer'); ?>