<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Pf extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->library ( 'form_validation' );
		$this->load->model ( 'pf_model', '', true );
	}
	public function send_phone_code() {
		$this->form_validation->set_rules ( 'phone', 'phone', 'required' );
		if ($this->form_validation->run () == FALSE) {
			exit ( json_encode ( array (
					'ret' => 400,
					'msg' => '参数错误' 
			) ) );
		}
		$post = $this->input->post ();
		$info = $this->pf_model->send_phone_rand_code ( $post );
		if ($info) {
			exit ( json_encode ( array (
					'ret' => 200 
			) ) );
		}
		exit ( json_encode ( array (
				'ret' => 500 
		) ) );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */