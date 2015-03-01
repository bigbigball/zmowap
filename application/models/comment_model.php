<?php
class Comment_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function do_comment($post) {
		$data = array ();
		if (empty ( $post ['id'] ) || empty ( $post ['type'] ) || empty ( $post ['comment'] )) {
			return array (
					'ret' => 400,
					'msg' => '参数错误' 
			);
		}
		$data ['cid'] = $post ['id'];
		$data ['type'] = $post ['type'];
		$data ['content'] = $post ['comment'];
		$data ['user_id'] = $_SESSION ['uid'];
		$data ['status'] = 0;
		$data ['ctime'] = time ();
		$data ['utime'] = time ();
		
		$res = $this->db->insert ( 'comment', $data );
		if ($res) {
			return array (
					'ret' => 200,
					'msg' => '评论成功' 
			);
		} else {
			return array (
					'ret' => 205,
					'msg' => '评论失败，请重新评论' 
			);
		}
	}
	function get_comment($post) {
		if (empty ( $post ['id'] ) || empty ( $post ['type'] )) {
			return array (
					'ret' => 400,
					'msg' => '参数错误' 
			);
		}
		
		$this->db->select ( 'id , cid , type , pid ,content ,user_id ,ctime' );
		$this->db->where ( 'cid', $post ['id'] );
		$this->db->where ( 'type', $post ['type'] );
		$this->db->where ( 'status', '0' );
		//$this->db->limit ( 5, $post ['page'] * 5 );
		$this->db->order_by ( 'id', 'desc' );
		$query = $this->db->get ( 'comment' );
		if ($query->num_rows () > 0) {
			$list = $query->result_array ();
			foreach ( $list as $k => $v ) {
				$uid [] = $v ['user_id'];
				$list [$k] ['ctime'] = date ( 'Y年m月d日', $v ['ctime'] );
			}
			$user_info = $this->get_user_info ( $uid );
			if (! empty ( $user_info )) {
				$data ['user_info'] = $user_info;
			}
			$data ['list'] = $list;
			return array (
					'ret' => 200,
					'info' => $data 
			);
		}
		return array (
				'ret' => 204,
				'msg' => '没有更多数据' 
		);
	}
	function get_user_info($uid) {
		if (empty ( $uid )) {
			return false;
		}
		$this->db->select ( 'id,nick_name,email,photo' );
		$this->db->where_in ( 'id', $uid );
		$query = $this->db->get ( 'user' );
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			foreach ( $info as $k => $v ) {
				$uinfo [$v ['id']] = $v;
			}
			return $uinfo;
		}
		return false;
	}
}