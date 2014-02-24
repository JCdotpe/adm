<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->lang->load('auth');
		$this->load->model('general/general_model');

		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}
	}

	public function index()
	{
		show_404();
	}

	public function meses()
	{
		$code = $this->input->get('codigo');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$data['datos'] = $this->general_model->get_meses($code)->result();
			$this->load->view('backend/json/json_view', $data);		
		}else{
			show_404();
		}
	}

	public function actividades()
	{
		$code = $this->input->get('codigo');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$datos = $this->general_model->get_actividades($code);
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	public function partidas()
	{
		$code = $this->input->get('codigo');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$datos = $this->general_model->get_partidas($code);
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	public function unidad_medida()
	{
		$code = $this->input->get('codigo');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$datos = $this->general_model->get_unidad_medida($code);
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	
	function convert_uft8_array($datos)
	{
		$data['datos'] = array();
		foreach ($datos->result_array() as $row) {
			array_push($data['datos'], array_map('utf8_encode', $row));
		}
		$this->load->view('backend/json/json_view', $data);
	}
}

?>