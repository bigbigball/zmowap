<?php
class Sms_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function center($post) {
		$this->db->select ( 'id , user_id , send_user_id , content , status , ctime' );
		$this->db->where ( 'type', $post ['sms_type'] );
		$this->db->where ( 'user_id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'message' );
		if ($query->num_rows () > 0) {
			$info = $query->result_array ();
			foreach ( $info as $k => $v ) {
				if ($v ['send_user_id'] == 1) {
					$info [$k] ['send_name'] = '初创团队发起人' . $v ['id'];
				} else {
					$info [$k] ['send_name'] = '有趣的人' . $v ['id'];
				}
			}
			return $info;
		}
		return false;
	}
}