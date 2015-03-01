<?php
class Video_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function get_home() {
		$this->db->select ( 'id , title , img , content , vid , tag,ctime' );
		$this->db->where ( 'status = ', 0 );
		$this->db->order_by ( 'order', 'desc' );
		$this->db->order_by ( 'id', 'desc' );
		$this->db->limit ( 3 );
		$data = array ();
		$query = $this->db->get ( 'video' );
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			$data ['info'] = $info;
		}
		return $data;
	}
	function getlist($post) {
		$data = array ();
		$this->db->select ( 'id , title , img , content , vid , tag,ctime' );
		if ($post ['type'] > 0) {
			$this->db->where ( 'type =', $post ['type'] );
		}
		$this->db->where ( 'status = ', 0 );
		$this->db->order_by ( 'order', 'desc' );
		$this->db->order_by ( 'id', 'desc' );
		$this->db->limit ( $post ['limit'], (($post ['page'] - 1) * $post ['limit']) );
		$query = $this->db->get ( 'video' );
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			$data ['info'] = $info;
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
	function get_info($id) {
		if (empty ( $id )) {
			return false;
		}
		$this->db->select ( 'id , vid , title , tag , content , ctime' );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ( 'video' );
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			$config = $this->config->item ( 'ccvideo' );
			$video_uri = $config ['api'] ['video'];
			$play_uri = $config ['api'] ['playcode'];
			
			$vqs ['format'] = 'json';
			$vqs ['userid'] = $config ['uid'];
			$vqs ['videoid'] = $info ['vid'];
			$vquery_string = $this->get_query_string ( $vqs, $config ['key'] );
			$video_info = json_decode ( vpost ( $video_uri . '?' . $vquery_string, 'get' ), true );
			
			$vqs ['format'] = 'json';
			$vqs ['userid'] = $config ['uid'];
			$vqs ['videoid'] = $info ['vid'];
			$vqs ['playerid'] = $config ['playerid'];
			$vqs ['player_width'] = '890';
			$vqs ['player_height'] = '320px';
			$pquery_string = $this->get_query_string ( $vqs, $config ['key'] );
			$play_info = json_decode ( vpost ( $play_uri . '?' . $pquery_string, 'get' ), true );
			$info ['video_info'] = $video_info;
			$info ['play_info'] = $play_info;
			return $info;
		}
		return false;
	}
	function get_count($option) {
		$this->db->where ( 'status', 0 );
		if ($option ['type'] > 0) {
			$this->db->where ( 'type =', $option ['type'] );
		}
		$count = $this->db->count_all_results ( 'video' );
		return $count;
	}
	private function get_query_string($post, $key) {
		if (! empty ( $post ) && is_array ( $post )) {
			ksort ( $post );
			$query_string = '';
			foreach ( $post as $k => $v ) {
				$query_string .= '&' . $k . '=' . $v;
			}
			$query_string = trim ( $query_string, '&' );
			$t = time ();
			$hash = md5 ( $query_string . '&time=' . $t . '&salt=' . $key );
			$query_string = $query_string . '&time=' . $t . '&hash=' . $hash;
			return $query_string;
		}
	}
}