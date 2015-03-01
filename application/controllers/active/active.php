<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Active extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'active_model', '', true );
		$this->load->library ( 'form_validation' );
		$ci = & get_instance ();
		$variable = array (
				'haction' => 'active' 
		);
		$ci->load->vars ( $variable );
	}
	// $type=1分享 $type=2沙龙
	function show() {
		$get = $this->input->get ();
		$option ['type'] = empty ( $get ['type'] ) ? 0 : $get ['type'];
		
		// 分页
		$option ['limit'] = 3;
		$option ['page'] = empty ( $get ['page'] ) ? 1 : $get ['page'];
		$this->load->library ( 'pagination' );
		$config ['num_links'] = 5;
		$config ['use_page_numbers'] = TRUE;
		$config ['page_query_string'] = TRUE;
		$config ['base_url'] = site_url ( 'active/active/show', array (
				'type' => $option ['type'] 
		) );
		$config ['total_rows'] = $this->active_model->get_count ( $option );
		$config ['per_page'] = $option ['limit'];
		$config ['cur_page'] = $option ['page'];
		$this->pagination->initialize ( $config );
		$pagination = $this->pagination->create_links ();
		
		$info = $this->active_model->getlist ( $option );
		$data ['info'] = $info;
		$data ['type'] = $option ['type'];
		$data ['page'] = $pagination;
		print_r(json_encode($data));
		//$this->load->view ( 'active/show', $data );
	}
	function info($id) {
		if (empty ( $id )) {
			msgs ( '参数错误', site_url ( 'active/active/show' ) );
		}
		$info = $this->active_model->getinfo ( $id );
		if (! empty ( $info )) {
			$is_join = $this->active_model->check_join ( $id );
			$data ['info'] = $info;
			$data ['is_collect'] = $this->active_model->check_collect ( $id );
			$data ['is_join'] = $is_join;
			$this->load->view ( 'active/info', $data );
		} else {
			msgs ( '您要访问的活动不存在', site_url ( 'active/active/show' ) );
		}
	}
}