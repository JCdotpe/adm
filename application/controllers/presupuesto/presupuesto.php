<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuesto extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->lang->load('auth');
		$this->load->model('general/general_model');
		$this->load->model('presupuesto/presupuesto_model');

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

	public function datos_generales()
	{
		$is_ajax = $this->input->post('ajax');
		if ($is_ajax) {
			
			//Obtengo column de tablas
			$tbl_presup_proyecto = $this->general_model->get_fields('presup_proyecto');
			$tbl_proyecto_actividad = $this->general_model->get_fields('proyecto_actividad');
			$tbl_proyecto_gasto = $this->general_model->get_fields('proyecto_gasto');

			//General parameters
			$cod_pryct = $this->input->post('codigo_proyecto');
			$cod_area = $this->input->post('id_area');

			//////////////////////////////
			//Presupuesto Proyecto
			//////////////////////////////
			$arr_presup_proyecto['Id_Area'] = $cod_area;
			$arr_presup_proyecto['Codigo_Proyecto'] = $cod_pryct;

			foreach ($tbl_presup_proyecto as $key => $camp) {
				if (!in_array($camp, array('Id_Area','Codigo_Proyecto','Proyecto','Descripcion'))) {
					$arr_presup_proyecto[$camp] = ( $this->input->post($camp) == '' ) ? NULL : $this->input->post($camp);
				}
			}

			$pptt_exist = $this->presupuesto_model->get_pptt_proyect($cod_area, $cod_pryct)->num_rows();

			if ($pptt_exist > 0) {
				if ( $this->presupuesto_model->update_pptt_proyect( $cod_area,$cod_pryct,$arr_presup_proyecto ) > 0 ) {
					$flag = 1;
					$msg = 'Se ha actualizado satisfactoriamente el Presupuesto del Proyecto';
				}
			}else{
				$flag = 1;
				$msg = 'Se ha registrado satisfactoriamente el Presupuesto del Proyecto';
			}

			$datos['flag'] = $flag;
			$datos['msg'] = $msg;
			$data['datos'] = $datos;
			$this->load->view('backend/json/json_view', $data);
		}
	}
}

?>