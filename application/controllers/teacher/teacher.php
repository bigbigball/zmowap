<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Teacher extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'teacher_model', '', true );
		$this->load->library ( 'form_validation' );
		$ci = & get_instance ();
		$variable = array (
				'haction' => 'teacher' 
		);
		$ci->load->vars ( $variable );
	}
	function show() {
		$total = $this->teacher_model->get_count();
		$list = $this->teacher_model->getlist();
		if($total && $list){
			$data['status'] = 1;
			$data['total'] = $total;
			$data ['list'] = $list;
		} else {
			$data['status'] = 0;
		}
		print_r(json_encode($data));
	}
	function info($id) {
		$data = array();
		if (empty ( $id )) {
			$data ['status'] = 0;
		}
		$info = $this->teacher_model->getinfo ( $id );
		if (! empty ( $info )) {
			$data ['status'] = 1;
			$data ['is_collect'] = $this->teacher_model->check_collect ( $id );
			$data ['info'] = $info;
		} else {
			$data ['status'] = 0;
		}
		print_r(json_encode($data));
	}
}