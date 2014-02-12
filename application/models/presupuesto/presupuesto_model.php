<?php 
class Presupuesto_model extends CI_MODEL{

	function get_pptt_proyect( $area, $codigo )
	{
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $codigo);
		$q = $this->db->get('presup_proyecto');
		return $q;
	}

	function update_pptt_proyect( $area, $codigo, $data )
	{
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $codigo);
		$this->db->update('presup_proyecto', $data);
		return $this->db->affected_rows() > 0;
	}

	function insert_pptt_proyect_mes( $data )
	{
		$this->db->insert('presup_proyecto_mes', $data);
		return $this->db->affected_rows() > 0;
	}

	function delete_pptt_proyect_mes( $area, $codigo, $anio )
	{
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $codigo);
		$this->db->where('ANIO', $anio);
		$this->db->delete('presup_proyecto_mes');
		return $this->db->affected_rows() > 0;	
	}

	function insert_pryct_actvdd( $data )
	{
		$this->db->insert('proyecto_actividad', $data);
		return $this->db->affected_rows() > 0;
	}

	function delete_pryct_actvdd( $area, $codigo, $anio )
	{
		$this->db->where('ID_AREA', $area);
		$this->db->where('CODIGO_PROYECTO', $codigo);
		$this->db->where('ANIO', $anio);
		$this->db->delete('proyecto_actividad');
		return $this->db->affected_rows() > 0;	
	}

}
?>