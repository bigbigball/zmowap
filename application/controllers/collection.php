<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Collection extends CI_Controller {
	function __construct() {
		parent::__construct ();
		if (! $this->check_login ()) {
			exit ( json_encode ( array (
					'ret' => 405,
					'msg' => '您没有登录，请您先登陆' 
			) ) );
		}
		$this->load->model ( 'collection_model', '', true );
		$this->load->library ( 'form_validation' );
	}
	public function collect() {
		$this->form_validation->set_rules ( 'id', 'id', 'required' );
		$this->form_validation->set_rules ( 'type', 'type', 'required' );
		if ($this->form_validation->run () == FALSE) {
			exit ( json_encode ( array (
					'ret' => 400,
					'msg' => '参数错误' 
			) ) );
		}
		$post = $this->input->post ();
		$info = $this->collection_model->collect ( $post );
		exit ( json_encode ( $info ) );
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