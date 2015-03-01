<?php
class Collection_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function collect($post) {
		if (empty ( $post ['id'] ) || empty ( $post ['type'] )) {
			return array (
					'ret' => 400,
					'msg' => '参数错误' 
			);
		}
		$this->db->select ( 'id' );
		$this->db->where ( 'user_id', $_SESSION ['uid'] );
		$this->db->where ( 'relation_id', $post ['id'] );
		$this->db->where ( 'type', $post ['type'] );
		$this->db->where ( 'user_id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'collect' );
		if ($query->num_rows () > 0) {
			return array (
					'ret' => 205,
					'msg' => '您已经收藏了' 
			);
		}
		$data ['relation_id'] = $post ['id'];
		$data ['type'] = $post ['type'];
		$data ['user_id'] = $_SESSION ['uid'];
		$data ['ctime'] = time ();
		$data ['utime'] = time ();
		
		$info = $this->db->insert ( 'collect', $data );
		if ($info) {
			return array (
					'ret' => 200,
					'msg' => '您收藏成功' 
			);
		}
		return array (
				'ret' => 204,
				'msg' => '您收藏失败' 
		);
	}
	function center($post) {
		if (empty ( $post ['otype'] )) {
			return false;
		}
		$this->db->select ( 'id,relation_id,relation_title,relation_img,type,ctime' );
		$this->db->where ( 'type', $post ['otype'] );
		$this->db->where ( 'user_id', $_SESSION ['uid'] );
		$this->db->where ( 'status', '0' );
		$this->db->limit ( 10 );
		$query = $this->db->get ( 'collect' );
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			return $info;
		}
		return false;
	}
	function feedback($post) {
		if (empty ( $post )) {
			return fasle;
		}
		$data ['info'] = $post ['info'];
		$data ['mail'] = $post ['mail'];
		$data ['ctime'] = time ();
		
		if ($this->db->insert ( 'feedback', $data )) {
			return true;
		}
		return false;
	}
}