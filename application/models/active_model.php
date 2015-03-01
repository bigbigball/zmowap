<?php
class Active_model extends CI_Model {
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
		$query = $this->db->get ( 'active' );
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			$data ['info'] = $info;
		}
		return $data;
	}
	
	function getlist($post) {
		$data = array ();
		$this->db->select ( 'id , title , desc , guest_id , is_price , price,quota ,tag,sign_num , type,img' );
		if ($post ['type'] > 0) {
			$this->db->where ( 'type =', $post ['type'] );
		}
		$this->db->where ( 'status = ', 0 );
		$this->db->order_by ( 'order', 'desc' );
		$this->db->order_by ( 'id', 'desc' );
		$this->db->limit ( $post ['limit'], (($post ['page'] - 1) * $post ['limit']) );
		$query = $this->db->get ( 'active' );
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			foreach ( $info as $k => $v ) {
				$nid [] = $v ['id'];
				$gid [] = $v ['guest_id'];
			}
			$data ['info'] = $info;
			$tutor = $this->get_list_tutor ( $gid );
			if (! empty ( $tutor )) {
				$data ['tutor'] = $tutor;
			}
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
		$this->db->where ( 'relation_type =', '3' );
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
	function get_list_tutor($list) {
		if (empty ( $list ) || ! is_array ( $list )) {
			return false;
		}
		$this->db->select ( 'id , name' );
		$this->db->from ( 'tutor' );
		$this->db->where_in ( 'id', $list );
		$query = $this->db->get ();
		$data = array ();
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			foreach ( $info as $k => $v ) {
				$data [$v ['id']] = $v ['name'];
			}
		}
		return $data;
	}
	function getinfo($id) {
		if (empty ( $id )) {
			return false;
		}
		$this->db->select ( 'id , theme,address,title , content , guest_id , is_price , price,quota ,tag,sign_num,desc,img ' );
		$this->db->from ( 'active' );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			$this->db->select ( 'path' );
			$this->db->from ( 'file' );
			$this->db->where ( 'relation_id =', $id );
			$this->db->where ( 'relation_type =', '3' );
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
		$count = $this->db->count_all_results ( 'active' );
		return $count;
	}
	function check_join($id) {
		if (empty ( $id )) {
			return false;
		}
		if (empty ( $_SESSION ['uid'] )) {
			return false;
		}
		$this->db->select ( 'id' );
		$this->db->where ( 'goods_id', $id );
		$this->db->where ( 'type', '4' );
		$this->db->where ( 'user_id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'order_goods' );
		if ($query->num_rows () > 0) {
			return true;
		}
	}
	function check_collect($id) {
		if (empty ( $id ) || empty ( $_SESSION ['uid'] )) {
			return false;
		}
		$this->db->select ( 'id' );
		$this->db->where ( 'relation_id', $id );
		$this->db->where ( 'type', '3' );
		$this->db->where ( 'user_id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'collect' );
		if ($query->num_rows () > 0) {
			return true;
		}
		return false;
	}
}