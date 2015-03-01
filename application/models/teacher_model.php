<?php
class Teacher_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function getlist() {
		$data = array ();
		$this->db->select ( 'id , name , portrait,resume ,desc' );
		$this->db->where ( 'status = ', 0 );
		$this->db->order_by ( 'top', 'desc' );
		$this->db->order_by ( 'order', 'desc' );
		$this->db->order_by ( 'id', 'desc' );
		$query = $this->db->get ( 'tutor' );
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
		$this->db->select ( 'id , name , portrait , occupation , desc , resume ' );
		$this->db->from ( 'tutor' );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			$news = $this->get_totur_news ( $info ['id'] );
			if (! empty ( $news )) {
				$info ['news']['total'] = count($news);
				$info ['news']['data'] = $news;
			}
			$lesson = $this->get_totur_lesson ( $info ['id'] );
			if (! empty ( $lesson )) {
				$info ['lesson']['total'] = count($lesson);
				$info ['lesson']['data'] = $lesson;
			}
			return $info;
		}
		return false;
	}
	private function get_totur_news($tutor_id) {
		if (empty ( $tutor_id )) {
			return false;
		}
		$this->db->select ( 'id,title,desc,author,ntime,rnum' );
		$this->db->from ( 'news' );
		$this->db->where ( 'guest_id =', $tutor_id );
		$this->db->order_by ( 'order', 'desc' );
		$this->db->order_by ( 'id', 'desc' );
		$this->db->limit ( 3 );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$news = $query->result_array ();
			foreach ( $news as $k => $v ) {
				$news_info [] = $v;
			}
			return $news_info;
		}
		return false;
	}
	private function get_totur_lesson($tutor_id) {
		if (empty ( $tutor_id )) {
			return false;
		}
		$this->db->select ( 'id,title,tag_info as tag , desc , is_price , price' );
		$this->db->from ( 'lesson' );
		$this->db->where ( 'guest_id =', $tutor_id );
		$this->db->limit ( 3 );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$lesson = $query->result_array ();
			return $lesson;
		}
		return false;
	}
	function get_count() {
		$this->db->where ( 'status', 0 );
		$count = $this->db->count_all_results ( 'tutor' );
		return $count;
	}
	function check_collect($id) {
		if (empty ( $id ) || empty ( $_SESSION ['uid'] )) {
			return false;
		}
		$this->db->select ( 'id' );
		$this->db->where ( 'relation_id', $id );
		$this->db->where ( 'type', '4' );
		$this->db->where ( 'user_id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'collect' );
		if ($query->num_rows () > 0) {
			return true;
		}
		return false;
	}
	function get_home() {
		$info = array ();
		$this->db->select ( 'id,name,position,portrait,occupation as occ , desc' );
		$this->db->where ( 'status = ', 0 );
		$this->db->where ( 'position != ', 0 );
		$this->db->order_by('position');
		$this->db->limit ( 6 );
		$query = $this->db->get ( 'tutor' );
		if ($query->num_rows () > 0) {
			$info ['info'] = $query->result_array ();
		}
		return $info;
	}
}