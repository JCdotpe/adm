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

	// List
	public function area_usuaria()
	{
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$datos = $this->general_model->get_data('area_usuaria');
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	public function actividades()
	{
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$datos = $this->general_model->get_data('actividad');
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	//Search
	public function meses_by()
	{
		$code = $this->input->get('codigo');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$where_array = array('MES' => $code);
			$data['datos'] = $this->general_model->select_data($where_array,'mes')->result();
			$this->load->view('backend/json/json_view', $data);		
		}else{
			show_404();
		}
	}

	public function actividades_by()
	{
		$code = $this->input->get('codigo');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$where_array = array('COD_ACT' => $code);
			$datos = $this->general_model->select_data($where_array,'actividad');
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	public function partidas_by()
	{
		$code = $this->input->get('codigo');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$where_array = array('COD_GASTO' => $code);
			$datos = $this->general_model->select_data($where_array,'gasto');
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	public function unidad_medida_by()
	{
		$code = $this->input->get('codigo');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$where_array = array('Cod_UM' => $code);
			$datos = $this->general_model->select_data($where_array,'unidad_medida');
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	// convert utf8
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