<?php
class News_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	public function get_home() {
		$this->db->select ( 'id , title , desc , author , ntime , rnum,ctime ,img' );
		$this->db->where ( 'status = ', 0 );
		$this->db->where ( 'position != ', 0 );
		$this->db->order_by('position');
		$this->db->limit ( 3 );
		$data = array ();
		$query = $this->db->get ( 'news' );
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			foreach ( $info as $k => $v ) {
				$nid [] = $v ['id'];
			}
			$data ['info'] = $info;
		}
		return $data;
	}
	function getlist($post) {
		$data = array ();
		$this->db->select ( 'id , title , desc , author , utime , rnum,img' );
		if ($post ['type'] > 0) {
			$this->db->where ( 'type =', $post ['type'] );
		}
		$this->db->where ( 'status = ', 0 );
		$this->db->order_by ( 'order', 'desc' );
		$this->db->order_by ( 'id', 'desc' );
		$this->db->limit ( $post ['limit'], (($post ['page'] - 1) * $post ['limit']) );
		$query = $this->db->get ( 'news' );
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			foreach ( $info as $k => $v ) {
				$nid [] = $v ['id'];
			}
			$data ['info'] = $info;
		}
		return $data;
	}
	function getlistimg($list) {
		if (empty ( $list ) || ! is_array ( $list )) {
			return false;
		}
		$this->db->select ( 'relation_id , path' );
		$this->db->from ( 'file' );
		$this->db->where_in ( 'relation_id', $list );
		$this->db->where ( 'relation_type =', '4' );
		$this->db->where ( 'type =', '1' );
		$query = $this->db->get ();
		$data = array ();
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			foreach ( $info as $k => $v ) {
				$data [$v ['relation_id']] = $v ['path'];
			}
		}
		return $data;
	}
	function getinfo($id) {
		if (empty ( $id )) {
			return false;
		}
		$this->db->select ( 'id , title , img, content , ntime , author,ctime' );
		$this->db->from ( 'news' );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			$this->db->select ( 'path' );
			$this->db->from ( 'file' );
			$this->db->where ( 'relation_id =', $id );
			$this->db->where ( 'relation_type =', '4' );
			$this->db->where ( 'type =', '2' );
			$query = $this->db->get ();
			if ($query->num_rows () > 0) {
				$img = $query->row_array ();
				$info ['img'] = $img ['path'];
			}
			return $info;
		}
		return false;
	}
	function get_count($option) {
		if ($option ['type'] > 0) {
			$this->db->where ( 'type', $option ['type'] );
		}
		$this->db->where ( 'status', 0 );
		$count = $this->db->count_all_results ( 'news' );
		return $count;
	}
}