<?php
class Lesson_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function get_home() {
		$this->db->select ( 'id , sequence,title , desc , guest_id , is_price , price, ,tag_info as tag , type , top,img,thumb' );
		$this->db->where ( 'status = ', 0 );
		$this->db->where ( 'position != ', 0 );
		$this->db->order_by('position');
		$this->db->limit ( 5 );
		$data = array ();
		$query = $this->db->get ( 'lesson' );
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
	function getlist($post) {
		$data = array ();
		$this->db->select ( 'id , title , desc , guest_id , is_price , price, ,tag_info as tag , type , top,img ,thumb' );
		$this->db->where ( 'status = ', 0 );
		if ($post ['type'] > 0) {
			$this->db->where ( 'type =', $post ['type'] );
		}
		$this->db->where ( 'status = ', 0 );
		$this->db->order_by ( 'order', 'desc' );
		$this->db->order_by ( 'id', 'desc' );
		$this->db->limit ( $post ['limit'], (($post ['page'] - 1) * $post ['limit']) );
		$query = $this->db->get ( 'lesson' );
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
		$this->db->select ( 'id , content,title,guest_id ,stime,etime ,address, guest_id ,img, is_price , price,tag_info as tag,address,desc,content' );
		$this->db->from ( 'lesson' );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			$this->db->select ( 'id,name,portrait,occupation,desc,resume' );
			$this->db->where ( 'id =', $info ['guest_id'] );
			$query = $this->db->get ( 'tutor' );
			if ($query->num_rows > 0) {
				$teacher = $query->row_array ();
				$info ['tutor'] = $teacher;
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
		$count = $this->db->count_all_results ( 'lesson' );
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
		$this->db->where ( 'type', '2' );
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
		$this->db->where ( 'type', '2' );
		$this->db->where ( 'user_id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'collect' );
		if ($query->num_rows () > 0) {
			return true;
		}
		return false;
	}
}