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

	public function index($codigo = null)
	{
		$data['user'] = $this->ion_auth->user()->row();
		$data['nav'] = TRUE;
		$data['title'] = 'Presupuesto General';
		$data['main_content'] = 'presupuesto/presupuesto_view';

		$cod_area = 1;
		$anio = 2014;
		$cod_pryct = ( is_null($codigo) ) ? 0 : $this->my_encryption->decode($codigo);
		$name_proyct = ( is_null($codigo) ) ? 0 : 'PROYECTOS';
		if ( $cod_pryct == '00000001' ) {
			$name_proyct = 'CIE2013';
		}else{
			$name_proyct = 'CENEPSCO';
		}
		
		$data['cod_pryct'] = $cod_pryct;
		$data['name_proyct'] = $name_proyct;

		//////////////////////////////
		//Presupuesto Proyecto
		//////////////////////////////
		$data['presup'] = $this->presupuesto_model->get_pptt_proyect(1,$cod_pryct);
		
		//////////////////////////////
		//Presupuesto Proyecto Mes
		//////////////////////////////
		$data['presup_mes'] = $this->presupuesto_model->select_data_pptt( $cod_area, $cod_pryct, $anio, 'presup_proyecto_mes' );

		//////////////////////////////
		//Proyecto Actividad
		//////////////////////////////
		$data['proyect_actividad'] = $this->presupuesto_model->select_data_pptt( $cod_area, $cod_pryct, $anio, 'proyecto_actividad' );
		$data['cantidad1'] = $this->presupuesto_model->max_data_pptt( $cod_area, $cod_pryct, $anio, 'Nro_Act', 'proyecto_actividad' );
		
		//////////////////////////////
		//Proyecto Gasto
		//////////////////////////////
		$data['proyect_gasto'] = $this->presupuesto_model->select_data_pptt( $cod_area, $cod_pryct, $anio, 'proyecto_gasto' );
		$data['cantidad2'] = $this->presupuesto_model->max_data_pptt( $cod_area, $cod_pryct, $anio, 'Nro_Gasto', 'proyecto_gasto' );

		///////////////////////////////
		///////////////////////////////
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

			$ui = $this->ion_auth->user()->row()->id;
			$ip = $this->input->ip_address();
			$agent = $this->agent->agent_string();


			//////////////////////////////
			//Presupuesto Proyecto
			//////////////////////////////
			$arr_presup_proyecto['Id_Area'] = $cod_area;
			$arr_presup_proyecto['Codigo_Proyecto'] = $cod_pryct;
			$arr_presup_proyecto['user_id'] = $ui;
			$arr_presup_proyecto['last_ip'] = $ip;
			$arr_presup_proyecto['user_agent'] = $agent;

			foreach ($tbl_presup_proyecto as $key => $camp) {
				if (!in_array($camp, array('Id_Area','Codigo_Proyecto','Proyecto','Descripcion','user_id','last_ip','user_agent','created','modified'))) {
					$arr_presup_proyecto[$camp] = ( $this->input->post($camp) == '' ) ? NULL : $this->input->post($camp);
				}
			}

			$pptt_exist = $this->presupuesto_model->get_pptt_proyect($cod_area, $cod_pryct)->num_rows();

			if ($pptt_exist > 0) {
				$arr_presup_proyecto['modified'] = date('Y-m-d H:i:s');
				if ( $this->presupuesto_model->update_pptt_proyect( $cod_area, $cod_pryct, $arr_presup_proyecto ) > 0 ) {
					$flag = 1;
					$msg = 'Se ha actualizado satisfactoriamente el Presupuesto del Proyecto';
				}
			}else{
				$arr_presup_proyecto['created'] = date('Y-m-d H:i:s');
				if ( $this->presupuesto_model->insert_data_pptt( $arr_presup_proyecto, 'presup_proyecto' ) > 0 ) {
					$flag = 1;
					$msg = 'Se ha registrado satisfactoriamente el Presupuesto del Proyecto';
				 }
			}


			//////////////////////////////
			//Presupuesto Proyecto Mes
			//////////////////////////////

			$arr_presup_proyecto_mes['Id_Area'] = $cod_area;
			$arr_presup_proyecto_mes['Codigo_Proyecto'] = $cod_pryct;
			$arr_presup_proyecto_mes['user_id'] = $ui;
			$arr_presup_proyecto_mes['last_ip'] = $ip;
			$arr_presup_proyecto_mes['user_agent'] = $agent;

			$nro_meses = $this->input->post('Cantidad_Mes');
			foreach ($tbl_presup_proyecto_mes as $a => $b) {
				if (!in_array($b, array('Id_Area','Codigo_Proyecto','user_id','last_ip','user_agent','created'))) {
					$presup_proyecto_mes[$b] = ( $this->input->post($b) == '' ) ? 0 : $this->input->post($b); //asigno post a un array global
				}
			}

			$posi = $nro_meses - 1; //posicion del ultimo mes
			$max_mes = $presup_proyecto_mes['Mes'][$posi]; //numero del ultimo mes
			$mes_actual = date('n');
			$anio = ($max_mes < $mes_actual) ? date( 'Y', mktime(0,0,0, date('m'), date('d'), date('Y')+1) ) : date('Y');
			$arr_presup_proyecto_mes['Anio'] = $anio;

			$this->presupuesto_model->delete_data_pptt( $cod_area, $cod_pryct, $anio, 'presup_proyecto_mes' );

			for ($i=0; $i < $nro_meses; $i++) {
				foreach ($tbl_presup_proyecto_mes as $key => $camp) {
					if (!in_array($camp, array('Id_Area','Codigo_Proyecto','Anio','user_id','last_ip','user_agent','created'))) {
						$arr_presup_proyecto_mes[$camp] = ( !isset($presup_proyecto_mes[$camp][$i]) ) ? 0 : $presup_proyecto_mes[$camp][$i]; 
					}
				}
				$this->presupuesto_model->insert_data_pptt( $arr_presup_proyecto_mes, 'presup_proyecto_mes' );
			}


			//////////////////////////////
			//Proyecto Actividad
			//////////////////////////////

			$nro_act = $this->input->post('Nro_Actividades');

			$this->proyecto_data( $cod_area, $cod_pryct, $anio, $nro_act, $nro_meses, $tbl_proyecto_actividad, 'proyecto_actividad' );


			//////////////////////////////
			//Proyecto Gasto
			//////////////////////////////

			$nro_gasto = $this->input->post('Nro_Partidas');
			
			$this->proyecto_data( $cod_area, $cod_pryct, $anio, $nro_gasto, $nro_meses, $tbl_proyecto_gasto, 'proyecto_gasto' );


			//////////////////////////////
			//////////////////////////////
			$datos['flag'] = $flag;
			$datos['msg'] = $msg;
			$data['datos'] = $datos;
			$this->load->view('backend/json/json_view', $data);
		}
	}

	public function proyecto_data( $area, $pryct, $anio, $cantidad, $meses, $tbl_camp, $tbl_name )
	{
		$arr_proyecto['Id_Area'] = $area;
		$arr_proyecto['Codigo_Proyecto'] = $pryct;
		$arr_proyecto['Anio'] = $anio;

		$arr_proyecto['user_id'] = $this->ion_auth->user()->row()->id;
		$arr_proyecto['last_ip'] = $this->input->ip_address();
		$arr_proyecto['user_agent'] = $this->agent->agent_string();
		$arr_proyecto['created'] = date('Y-m-d H:i:s');

		foreach ($tbl_camp as $a=>$b) { 
			if (!in_array($b, array('Id_Area','Codigo_Proyecto','user_id','last_ip','user_agent','created'))) {
				$arr_global[$b] = ( $this->input->post($b) == '' ) ? 0 : $this->input->post($b); //asigno post a un array global
			}
		}

		$this->presupuesto_model->delete_data_pptt( $area, $pryct, $anio, $tbl_name );

		$x = 0; //indice para el monto
		for ($i=0; $i < $cantidad ; $i++) { 
			
			foreach ($tbl_camp as $key => $camp) {
				if (!in_array($camp, array('Id_Area','Codigo_Proyecto','Anio','Mes','Monto_Act','Monto_Gasto','user_id','last_ip','user_agent','created'))) {
					$arr_proyecto[$camp] = ( !isset($arr_global[$camp][$i]) ) ? 0 : $arr_global[$camp][$i]; //asigno nro y cod
				}
			}
			
			for ($j=0; $j < $meses ; $j++) { //recorro cantidad de meses
				foreach ($tbl_camp as $key => $camp) {
					
					if (!in_array($camp, array('Id_Area','Codigo_Proyecto','Anio','Nro_Act','Cod_Act','Monto_Act','Nro_Gasto','Cod_Gasto','Monto_Gasto','user_id','last_ip','user_agent','created'))) {
						$arr_proyecto[$camp] = ( !isset($arr_global[$camp][$j]) ) ? 0 : $arr_global[$camp][$j]; //asigno mes
					}

					if (!in_array($camp, array('Id_Area','Codigo_Proyecto','Anio','Mes','Nro_Act','Cod_Act','Nro_Gasto','Cod_Gasto','user_id','last_ip','user_agent','created'))) {
						$arr_proyecto[$camp] = ( !isset($arr_global[$camp][$x]) ) ? 0 : $arr_global[$camp][$x]; //asigno monto
					}
				}
				$this->presupuesto_model->insert_data_pptt( $arr_proyecto, $tbl_name );
				$x++;
			}
		}
	}

	public function datos_detalle()
	{
		$is_ajax = $this->input->post('ajax');
		if ($is_ajax) {
			//Obtengo column de tablas
			$tbl_actividad_gasto = $this->general_model->get_fields('actividad_gasto');
			$tbl_actividad_gasto_mes = $this->general_model->get_fields('actividad_gasto_mes');

			//General parameters
			$cod_pryct = $this->input->post('codigo_proyecto');
			$cod_area = $this->input->post('id_area');

			$nro_act = $this->input->post('Nro_Act');
			$cod_act = $this->input->post('Cod_Act');

			$anio = 2014;

			$ui = $this->ion_auth->user()->row()->id;
			$ip = $this->input->ip_address();
			$agent = $this->agent->agent_string();

			//////////////////////////////
			//Actividad Gasto
			//////////////////////////////
			$arr_actividad_gasto['Id_Area'] = $cod_area;
			$arr_actividad_gasto['Codigo_Proyecto'] = $cod_pryct;
			$arr_actividad_gasto['Anio'] = $anio;
			$arr_actividad_gasto['Nro_Act'] = $nro_act;
			$arr_actividad_gasto['Cod_Act'] = $cod_act;
			$arr_actividad_gasto['user_id'] = $ui;
			$arr_actividad_gasto['last_ip'] = $ip;
			$arr_actividad_gasto['user_agent'] = $agent;
			$arr_actividad_gasto['created'] = date('Y-m-d H:i:s');

			foreach ($tbl_actividad_gasto as $a => $b) {
				if (!in_array($b, array('Id_Area','Codigo_Proyecto', 'Anio', 'Nro_Act', 'Cod_Act', 'user_id','last_ip','user_agent','created'))) {
					$actividad_gasto[$b] = ( $this->input->post($b) == '' ) ? 0 : array_map('utf8_decode', $this->input->post($b)); //asigno post a un array global
				}
			}

			//////////////////////////////
			//Actividad Gasto Mes
			//////////////////////////////
			$arr_actividad_gasto_mes['Id_Area'] = $cod_area;
			$arr_actividad_gasto_mes['Codigo_Proyecto'] = $cod_pryct;
			$arr_actividad_gasto_mes['Anio'] = $anio;
			$arr_actividad_gasto_mes['Nro_Act'] = $nro_act;
			$arr_actividad_gasto_mes['Cod_Act'] = $cod_act;
			$arr_actividad_gasto_mes['user_id'] = $ui;
			$arr_actividad_gasto_mes['last_ip'] = $ip;
			$arr_actividad_gasto_mes['user_agent'] = $agent;
			$arr_actividad_gasto_mes['created'] = date('Y-m-d H:i:s');

			foreach ($tbl_actividad_gasto_mes as $a => $b) {
				if (!in_array($b, array('Id_Area','Codigo_Proyecto', 'Anio', 'Nro_Act', 'Cod_Act', 'Nro_Gasto', 'Cod_Gasto', 'user_id','last_ip','user_agent','created'))) {
					$actividad_gasto_mes[$b] = ( $this->input->post($b) == '' ) ? 0 : $this->input->post($b); //asigno post a un array global
				}
			}

			//////////////////////////////
			//DATA
			//////////////////////////////
			$actividad_gasto['Nro_Items'] = $this->input->post('Nro_Items');// cantidad de items por gasto

			$this->presupuesto_model->delete_data_pt_detail( $cod_area, $cod_pryct, $anio, $cod_act, 'actividad_gasto' ); //limpio tabla
			$this->presupuesto_model->delete_data_pt_detail( $cod_area, $cod_pryct, $anio, $cod_act, 'actividad_gasto_mes' );//limpio tabla
			
			$i = 0; // items
			$x = 0; // gasto
			$w = 0; // gasto meses
			foreach ($actividad_gasto['Cod_Gasto'] as &$z) {

				// asigno nro y codigo de gasto
				$arr_actividad_gasto['Cod_Gasto'] = $actividad_gasto['Cod_Gasto'][$x];
				$arr_actividad_gasto['Nro_Gasto'] = $actividad_gasto['Nro_Gasto'][$x];

				$arr_actividad_gasto_mes['Cod_Gasto'] = $actividad_gasto['Cod_Gasto'][$x];
				$arr_actividad_gasto_mes['Nro_Gasto'] = $actividad_gasto['Nro_Gasto'][$x];

				//cantidad de items por gasto
				$cnt_items = $actividad_gasto['Nro_Items'][$x];
				for ($j=0; $j <= $cnt_items-1; $j++) {

					foreach ($tbl_actividad_gasto as $key => $camp) {
						if (!in_array($camp, array('Id_Area','Codigo_Proyecto', 'Anio','Nro_Act','Cod_Act', 'Nro_Gasto', 'Cod_Gasto', 'user_id','last_ip','user_agent','created'))) {
							$arr_actividad_gasto[$camp] = ( !isset($actividad_gasto[$camp][$i]) ) ? 0 : $actividad_gasto[$camp][$i]; //asigno datos
						}
					}

					$this->presupuesto_model->insert_data_pptt( $arr_actividad_gasto, 'actividad_gasto' );

					// codigo de item
					$arr_actividad_gasto_mes['Item'] = $actividad_gasto['Item'][$i];
					$m = 0;// meses
					foreach ($actividad_gasto_mes['Mes'] as &$y) {

						// asigno codigo de mes
						$arr_actividad_gasto_mes['Mes'] = $actividad_gasto_mes['Mes'][$m];

						foreach ($tbl_actividad_gasto_mes as $key => $camp) {
							if (!in_array($camp, array('Id_Area','Codigo_Proyecto', 'Mes', 'Anio','Nro_Act','Cod_Act', 'Nro_Gasto', 'Cod_Gasto', 'Item', 'user_id','last_ip','user_agent','created'))) {
								$arr_actividad_gasto_mes[$camp] = ( !isset($actividad_gasto_mes[$camp][$w]) ) ? 0 : $actividad_gasto_mes[$camp][$w]; //asigno datos
							}
						}

						$this->presupuesto_model->insert_data_pptt( $arr_actividad_gasto_mes, 'actividad_gasto_mes' );
						$m++;
						$w++;
					}
					$i++;
				}
				$x++;
			}

			$msg = 'Se ha registrado satisfactoriamente la Actividad y Gastos';

			$datos['msg'] = $msg;
			$data['datos'] = $datos;
			$this->load->view('backend/json/json_view', $data);

		}else{
			show_404();
		}
	}

	/// GENERAL ///
	public function actividad_pptt()
	{
		$code = $this->input->get('codigo');
		$proyct = $this->input->get('proyct');
		$area = $this->input->get('area');
		$anio = $this->input->get('anio');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$datos = $this->presupuesto_model->get_actividad_pptt($code, $proyct, $area, $anio);
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	public function gasto_pptt()
	{
		$code = $this->input->get('codigo');
		$proyct = $this->input->get('proyct');
		$area = $this->input->get('area');
		$anio = $this->input->get('anio');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$datos = $this->presupuesto_model->get_partida_pptt($code, $proyct, $area, $anio);
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	public function AG_Gasto()
	{
		$code = $this->input->get('codigo');
		$proyct = $this->input->get('proyct');
		$area = $this->input->get('area');
		$anio = $this->input->get('anio');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$datos = $this->presupuesto_model->get_AG_Gasto($code, $proyct, $area, $anio);
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}	
	}

	public function AG_Gasto_2()
	{
		$actvdad = $this->input->get('actvdad');
		$proyct = $this->input->get('proyct');
		$area = $this->input->get('area');
		$anio = $this->input->get('anio');
		$prtda = $this->input->get('prtda');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$datos = $this->presupuesto_model->get_AG_Gasto_2($actvdad, $proyct, $area, $anio, $prtda);
			$this->convert_uft8_array($datos);
		}else{
			show_404();
		}
	}

	public function AGM_Gasto()
	{
		$actvdad = $this->input->get('actvdad');
		$proyct = $this->input->get('proyct');
		$area = $this->input->get('area');
		$anio = $this->input->get('anio');
		$prtda = $this->input->get('prtda');
		$is_ajax = $this->input->get('ajax');
		if($is_ajax){
			$datos = $this->presupuesto_model->get_AGM_Gasto($actvdad, $proyct, $area, $anio, $prtda);
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