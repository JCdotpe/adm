<?php 
class General_model extends CI_MODEL{

	function get_meses($codigo)
	{
		$this->db->where('codigo', $codigo);
		$q = $this->db->get('meses');
		return $q;
	}

	function get_actividades($codigo)
	{
		$this->db->where('codigo', $codigo);
		$this->db->where('activo', 1);
		$q = $this->db->get('actividades');
		return $q;
	}

	function get_partidas($codigo)
	{
		$this->db->where('codigo', $codigo);
		$this->db->where('activo', 1);
		$q = $this->db->get('partidas');
		return $q;
	}

}
?>