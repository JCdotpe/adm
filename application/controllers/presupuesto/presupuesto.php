<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuesto extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->lang->load('auth');

		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login');
		}

		$roles = $this->ion_auth->get_roles();
		$flag = FALSE;
		foreach ($roles as $role) {
			if ($role->id == 6) {
				$flag = TRUE;
				break;
			}
		}

		if (!$flag) {
			show_404();
			die();
		}
	}

	public function index()
	{
		$data['user'] = $this->ion_auth->user()->row();
		$data['nav'] = TRUE;
		$data['title'] = 'Presupuesto General';
		$data['main_content'] = 'presupuesto/presupuesto_view';
		$this->load->view('backend/includes/template', $data);
	}
}

?>