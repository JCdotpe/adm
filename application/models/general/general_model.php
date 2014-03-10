<?php 
class General_model extends CI_MODEL{

	// fields
	function get_fields($c){
		$q = $this->db->list_fields($c);
		return $q;
	}

	//list
	function get_data($tbl)
	{
		$q =  $this->db->get($tbl);
		return $q;
	}

	// mdl
	function insert_data( $data, $tbl )
	{
		$this->db->insert($tbl, $data);
		return $this->db->affected_rows() > 0;
	}

	function update_data( $array, $data, $tbl )
	{
		$this->db->where( $array );
		$this->db->update($tbl, $data);
		return $this->db->affected_rows() > 0;
	}


	//search
	function select_data( $array, $tbl )
	{
		$this->db->where( $array );
		$q = $this->db->get($tbl);
		return $q;
	}	

}
?>