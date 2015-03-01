<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Comment extends CI_Controller {
	function __construct() {
		parent::__construct ();
		if (! $this->check_login ()) {
			exit ( json_encode ( array (
					'ret' => 405,
					'msg' => '您没有登录，请您先登陆' 
			) ) );
		}
		$this->load->model ( 'comment_model', '', true );
		$this->load->library ( 'form_validation' );
	}
	public function do_comment() {
		$this->form_validation->set_rules ( 'comment', 'comment', 'required' );
		$this->form_validation->set_rules ( 'id', 'id', 'required' );
		$this->form_validation->set_rules ( 'type', 'type', 'required' );
		if ($this->form_validation->run () == FALSE) {
			exit ( json_encode ( array (
					'ret' => 400,
					'msg' => '参数错误' 
			) ) );
		}
		$post = $this->input->post ();
		$info = $this->comment_model->do_comment ( $post );
		exit ( json_encode ( $info ) );
	}
	public function get_comment() {
		$this->form_validation->set_rules ( 'id', 'id', 'required' );
		$this->form_validation->set_rules ( 'type', 'type', 'required' );
		if ($this->form_validation->run () == FALSE) {
			exit ( json_encode ( array (
					'ret' => 400,
					'msg' => '参数错误' 
			) ) );
		}
		$post = $this->input->post ();
		$post ['page'] = ! empty ( $post ['page'] ) ? intval ( $post ['page'] ) : 0;
		$post = $this->comment_model->get_comment ( $post );
		exit ( json_encode ( $post ) );
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