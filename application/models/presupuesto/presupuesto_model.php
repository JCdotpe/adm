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

}
?>