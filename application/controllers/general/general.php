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
			$data['datos'] = $this->general_model->get_actividades($code)->result();
			$this->load->view('backend/json/json_view', $data);		
		}else{
			show_404();
		}
	}
}

?>