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
			$tbl_presup_proyecto_mes = $this->general_model->get_fields('presup_proyecto_mes');
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


			//////////////////////////////
			//Presupuesto Proyecto Mes
			//////////////////////////////

			$arr_presup_proyecto_mes['Id_Area'] = $cod_area;
			$arr_presup_proyecto_mes['Codigo_Proyecto'] = $cod_pryct;

			$nro_meses = $this->input->post('Cantidad_Mes');
			foreach ($tbl_presup_proyecto_mes as $a => $b) {
				if (!in_array($b, array('Id_Area','Codigo_Proyecto'))) {
					$presup_proyecto_mes[$b] = ( $this->input->post($b) == '' ) ? 0 : $this->input->post($b); //asigno post a un array global
				}
			}

			$posi = $nro_meses - 1; //posicion del ultimo mes
			$max_mes = $presup_proyecto_mes['Mes'][$posi]; //numero del ultimo mes
			$mes_actual = date('n');
			$anio = ($max_mes < $mes_actual) ? date( 'Y', mktime(0,0,0, date('m'), date('d'), date('Y')+1) ) : date('Y');
			$arr_presup_proyecto_mes['Anio'] = $anio;

			$this->presupuesto_model->delete_pptt_proyect_mes( $cod_area, $cod_pryct, $anio );
			for ($i=0; $i < $nro_meses; $i++) {
				foreach ($tbl_presup_proyecto_mes as $key => $camp) {
					if (!in_array($camp, array('Id_Area','Codigo_Proyecto','Anio'))) {
						$arr_presup_proyecto_mes[$camp] = ( !isset($presup_proyecto_mes[$camp][$i]) ) ? 0 : $presup_proyecto_mes[$camp][$i]; 
					}
				}
				$this->presupuesto_model->insert_pptt_proyect_mes($arr_presup_proyecto_mes);
			}


			//////////////////////////////
			//Proyecto Actividad
			//////////////////////////////

			$arr_proyecto_actividad['Id_Area'] = $cod_area;
			$arr_proyecto_actividad['Codigo_Proyecto'] = $cod_pryct;
			$arr_proyecto_actividad['Anio'] = $anio;

			$nro_act = $this->input->post('Nro_Actividades');

			foreach ($tbl_proyecto_actividad as $a=>$b) { 
				if (!in_array($b, array('Id_Area','Codigo_Proyecto'))) {
					$proyecto_actividad[$b] = ( $this->input->post($b) == '' ) ? 0 : $this->input->post($b); //asigno post a un array global
				}
			}

			$this->presupuesto_model->delete_pryct_actvdd( $cod_area, $cod_pryct, $anio );

			$x = 0; //indice para el monto_act
			for ($i=0; $i < $nro_act ; $i++) { 
				
				foreach ($tbl_proyecto_actividad as $key => $camp) {
					if (!in_array($camp, array('Id_Area','Codigo_Proyecto','Anio','Mes','Monto_Act'))) {
						$arr_proyecto_actividad[$camp] = ( !isset($proyecto_actividad[$camp][$i]) ) ? 0 : $proyecto_actividad[$camp][$i]; //asigno nro_act y cod_act
					}
				}
				
				for ($j=0; $j < $nro_meses ; $j++) { //recorro cantidad de meses
					foreach ($tbl_proyecto_actividad as $key => $camp) {
						
						if (!in_array($camp, array('Id_Area','Codigo_Proyecto','Anio','Nro_Act','Cod_Act','Monto_Act'))) {
							$arr_proyecto_actividad[$camp] = ( !isset($proyecto_actividad[$camp][$j]) ) ? 0 : $proyecto_actividad[$camp][$j]; //asigno mes
						}

						if (!in_array($camp, array('Id_Area','Codigo_Proyecto','Anio','Nro_Act','Cod_Act','Mes'))) {
							$arr_proyecto_actividad[$camp] = ( !isset($proyecto_actividad[$camp][$x]) ) ? 0 : $proyecto_actividad[$camp][$x]; //asigno monto_act
						}
					}
					$this->presupuesto_model->insert_pryct_actvdd($arr_proyecto_actividad);
					$x++;
				}
			}

			$datos['flag'] = $flag;
			$datos['msg'] = $msg;
			$data['datos'] = $datos;
			$this->load->view('backend/json/json_view', $data);
		}
	}
}

?>