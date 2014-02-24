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

	function get_unidad_medida($codigo)
	{
		$this->db->where('Cod_UM', $codigo);
		$q = $this->db->get('unidad_medida');
		return $q;
	}

}
?>