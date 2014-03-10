<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Matricula extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->lang->load('auth');
		$this->load->model('general/general_model');
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

	public function datos_generales()
	{
		$is_ajax = $this->input->post('ajax');
		if ($is_ajax) {
			
			//Obtengo column de tablas
			$tbl_proyecto = $this->general_model->get_fields('presup_proyecto');
			$tbl_proyecto_mes = $this->general_model->get_fields('presup_proyecto_mes');

			// $cod_pryct = $this->input->post('codigo_proyecto');
			$cod_pryct = '00000001';
			$anio = date('Y');
			$cod_area = $this->input->post('Id_Area');

			$ui = $this->ion_auth->user()->row()->id;
			$ip = $this->input->ip_address();
			$agent = $this->agent->agent_string();

			//////////////////////////////
			//Presupuesto Proyecto
			//////////////////////////////

			$arr_proyecto['Codigo_Proyecto'] = $cod_pryct;
			$arr_proyecto['Id_Area'] = $cod_area;
			$arr_proyecto['Anio'] = $anio;

			foreach ($tbl_proyecto as $key => $camp) {
				if (!in_array($camp, array('Codigo_Proyecto','Id_Area','Anio','user_id','last_ip','user_agent','created','modified'))) {
					$arr_proyecto[$camp] = ( $this->input->post($camp) == '' ) ? NULL : $this->input->post($camp);
				}
			}

			$where_array = array('ID_AREA' => $cod_area, 'CODIGO_PROYECTO' => $cod_pryct);
			$presup_exist = $this->general_model->select_data($where_array, 'presup_proyecto')->num_rows();

			if ($presup_exist > 0) {
				$arr_proyecto['modified'] = date('Y-m-d H:i:s');
				if ( $this->general_model->update_data( $where_array, $arr_proyecto, 'presup_proyecto' ) > 0 ) {
					$flag = 1;
					$msg = 'Se ha actualizado satisfactoriamente el Presupuesto del Proyecto';
				}
			}else{
				$arr_proyecto['created'] = date('Y-m-d H:i:s');
				if ( $this->general_model->insert_data( $arr_proyecto, 'presup_proyecto' ) > 0 ){
					$flag = 1;
					$msg = 'Se ha registrado satisfactoriamente el Presupuesto del Proyecto';
				}
			}

			//////////////////////////////
			//////////////////////////////
			$datos['flag'] = $flag;
			$datos['msg'] = $msg;
			$data['datos'] = $datos;
			$this->load->view('backend/json/json_view', $data);

		}else{
			show_404();
		}
	}

}

?>