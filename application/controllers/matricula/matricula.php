<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Matricula extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->lang->load('auth');
		// $this->load->model('general/general_model');
		// $this->load->model('presupuesto/presupuesto_model');

		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$roles = $this->ion_auth->get_roles();
		$flag = FALSE;
		foreach ($roles as $role) {
			if ($role->id == 7) {
				$flag = TRUE;
				break;
			}
		}

		if (!$flag) {
			show_404();
			die();
		}
	}

	public function index($codigo = null)
	{
		$data['user'] = $this->ion_auth->user()->row();
		$data['nav'] = TRUE;
		$data['title'] = 'Matricula de Proyecto';
		$data['main_content'] = 'matricula/matricula_view';

		///////////////////////////////
		///////////////////////////////
		$this->load->view('backend/includes/template', $data);
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