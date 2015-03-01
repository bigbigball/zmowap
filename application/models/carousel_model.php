<?php
class Carousel_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function get_home() {
		$this->db->select ( '*' );
		$this->db->where ( 'status = ', 0 );
		$this->db->where ( 'position != ', 0 );
		$this->db->order_by('position');
		$this->db->limit ( 4 );
		$data = array ();
		$query = $this->db->get ( 'carousel' );
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			$data ['info'] = $info;
		}
		return $data;
	}
}