<?php 
class General_model extends CI_MODEL{

	function get_fields($c){
		$q = $this->db->list_fields($c);
		return $q;
	}

	function get_meses($codigo)
	{
		$this->db->where('MES', $codigo);
		$q = $this->db->get('mes');
		return $q;
	}

	function get_actividades($codigo)
	{
		$this->db->where('COD_ACT', $codigo);
		$q = $this->db->get('actividad');
		return $q;
	}

	function get_partidas($codigo)
	{
		$this->db->where('COD_GASTO', $codigo);
		$q = $this->db->get('gasto');
		return $q;
	}

	function get_actividad_pptt($codigo, $proyct, $area, $anio)
	{
		$this->db->select_sum('pa.Monto_Act');
		$this->db->select('pa.Nro_Act, pa.Cod_Act, a.Descripcion');
		$this->db->where('pa.Cod_Act', $codigo);
		$this->db->where('Codigo_Proyecto', $proyct);
		$this->db->where('Id_Area', $area);
		$this->db->where('Anio', $anio);
		$this->db->from('proyecto_actividad pa');
		$this->db->join('actividad a', 'pa.Cod_Act = a.Cod_Act');
		$this->db->group_by(array('pa.Nro_Act', 'pa.Cod_Act', 'a.Descripcion'));
		$q = $this->db->get();
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

	function get_unidad_medida($codigo)
	{
		$this->db->where('Cod_UM', $codigo);
		$q = $this->db->get('unidad_medida');
		return $q;
	}

}
?>