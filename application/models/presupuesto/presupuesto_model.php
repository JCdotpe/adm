<?php 
class Presupuesto_model extends CI_MODEL{

	function get_pptt_proyect( $area, $codigo )
	{
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $codigo);
		$q = $this->db->get('presup_proyecto');
		return $q;
	}

	function max_data_pptt( $area, $codigo, $anio, $camp, $tbl )
	{
		$this->db->select_max( $camp, 'Nro_Max');
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $codigo);
		$this->db->where('ANIO', $anio);
		$q = $this->db->get($tbl);
		if ($q->num_rows() > 0) $row = $q->row();
		return $row->Nro_Max;
	}

	function update_pptt_proyect( $area, $codigo, $data )
	{
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $codigo);
		$this->db->update('presup_proyecto', $data);
		return $this->db->affected_rows() > 0;
	}

	function insert_data_pptt( $data, $tbl )
	{
		$this->db->insert($tbl, $data);
		return $this->db->affected_rows() > 0;
	}

	function delete_data_pptt( $area, $codigo, $anio, $tbl )
	{
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $codigo);
		$this->db->where('ANIO', $anio);
		$this->db->delete($tbl);
		return $this->db->affected_rows() > 0;	
	}

	function select_data_pptt( $area, $codigo, $anio, $tbl )
	{
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $codigo);
		$this->db->where('ANIO', $anio);
		$q = $this->db->get($tbl);
		return $q;	
	}

	function delete_data_pt_detail( $area, $codigo, $anio, $cod_act, $tbl )
	{
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $codigo);
		$this->db->where('ANIO', $anio);
		$this->db->where('COD_ACT', $cod_act);
		$this->db->delete($tbl);
		return $this->db->affected_rows() > 0;
	}


	function get_actividad_pptt($codigo, $proyct, $area, $anio)
	{
		$q=$this->db->query("PT_DT_Actividad ?, ?, ?, ?", array($codigo, $proyct, $area, $anio));
		return $q;
	}

	function get_partida_pptt($codigo, $proyct, $area, $anio)
	{
		$this->db->select_sum('pg.Monto_Gasto');
		$this->db->select('pg.Nro_Gasto, pg.Cod_Gasto, a.Descripcion');
		$this->db->where('pg.Cod_Gasto', $codigo);
		$this->db->where('Codigo_Proyecto', $proyct);
		$this->db->where('Id_Area', $area);
		$this->db->where('Anio', $anio);
		$this->db->from('proyecto_gasto pg');
		$this->db->join('gasto a', 'pg.Cod_Gasto = a.Cod_Gasto');
		$this->db->group_by(array('pg.Nro_Gasto', 'pg.Cod_Gasto', 'a.Descripcion'));
		$q = $this->db->get();
		return $q;
	}

	function get_AG_Gasto($codigo, $proyct, $area, $anio)
	{
		$this->db->distinct();
		$this->db->select('Cod_Gasto');
		$this->db->select_max('Item');
		$this->db->where('Cod_Act', $codigo);
		$this->db->where('Codigo_Proyecto', $proyct);
		$this->db->where('Id_Area', $area);
		$this->db->where('Anio', $anio);
		$this->db->group_by('Cod_Gasto');
		$q = $this->db->get('actividad_gasto');
		return $q;	
	}

	function get_AG_Gasto_2($act, $proyct, $area, $anio, $codigo)
	{
		$this->db->where('Cod_Act', $act);
		$this->db->where('Codigo_Proyecto', $proyct);
		$this->db->where('Id_Area', $area);
		$this->db->where('Anio', $anio);
		$this->db->where('Cod_Gasto', $codigo);
		$q = $this->db->get('actividad_gasto');
		return $q;	
	}

	function get_AGM_Gasto($act, $proyct, $area, $anio, $codigo)
	{
		$this->db->where('Cod_Act', $act);
		$this->db->where('Codigo_Proyecto', $proyct);
		$this->db->where('Id_Area', $area);
		$this->db->where('Anio', $anio);
		$this->db->where('Cod_Gasto', $codigo);
		$q = $this->db->get('actividad_gasto_mes');
		return $q;	
	}

	function get_data_pa( $area, $proyct, $anio )
	{
		$this->db->select('pa.Mes, pa.Nro_Act, pa.Cod_Act, a.Descripcion, pa.Monto_Act');
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $proyct);
		$this->db->where('ANIO', $anio);
		$this->db->from('proyecto_actividad pa');
		$this->db->join('actividad a', 'pa.Cod_Act = a.Cod_Act','left');
		$q = $this->db->get();
		return $q;
	}

// 	select pa.Mes, pa.Nro_Act, pa.Cod_Act, a.Descripcion, pa.Monto_Act 
// from proyecto_actividad pa
// left join actividad a on pa.Cod_Act = a.Cod_Act

}
?>