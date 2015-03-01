<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Buy extends CI_Controller {
	function __construct() {
		parent::__construct ();
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
		}
		$this->load->model ( 'buy_model', '', true );
		$this->load->library ( 'form_validation' );
	}
	function sign_up() {
		$this->form_validation->set_rules ( 'id', 'id', 'required' );
		$this->form_validation->set_rules ( 'type', 'type', 'required' );
		if ($this->form_validation->run () == FALSE) {
			err_msgs ( '参数错误', site_url ( 'home/index' ) );
		}
		$post = $this->input->post ();
		$info = $this->buy_model->sign_up ( $post );
		switch ($info ['ret']) {
			case 200 :
				msgs ( '您报名成功', site_url ( 'order/order/buy', array('oid' => $info['oid']) ) );
				break;
			case 204 :
				if ($post ['type'] == 2) {
					$action = 'lesson';
				}
				err_msgs ( '报名的项目不存在', site_url ( $action . '/' . $action . 'show' ) );
				;
				break;
			case 205 :
				if ($post ['type'] == 2) {
					$action = 'lesson';
				}
				err_msgs ( '报名失败，请重新报名', site_url ( $action . '/' . $action . 'info', array (
						'id' => $post ['id'] 
				) ) );
				break;
		}
	}
	private function check_login() {
		if (! empty ( $_SESSION ['uid'] )) {
			return true;
		}
		return false;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */