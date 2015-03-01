<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Lesson extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'lesson_model', '', true );
		$this->load->library ( 'form_validation' );
		$ci = & get_instance ();
		$variable = array (
				'haction' => 'lesson' 
		);
		$ci->load->vars ( $variable );
	}
	
	// type=1:视频课程type=2:线下课程
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
		$config ['base_url'] = site_url ( 'lesson/lesson/show', array (
				'type' => $option ['type'] 
		) );
		$config ['total_rows'] = $this->lesson_model->get_count ( $option );
		$config ['per_page'] = $option ['limit'];
		$config ['cur_page'] = $option ['page'];
		
		$this->pagination->initialize ( $config );
		$pagination = $this->pagination->create_links ();
		$list = $this->lesson_model->getlist ( $option );
		$data ['list'] = $list;
		$data ['type'] = $option ['type'];
		$data ['page'] = $pagination;
		$this->load->view ( 'lesson/show', $data );
	}
	function info($id) {
		if (empty ( $id )) {
			err_msgs ( '参数错误', site_url ( 'lesson/lesson/show' ) );
		}
		$info = $this->lesson_model->getinfo ( $id );
		if (! empty ( $info )) {
			$is_join = $this->lesson_model->check_join ( $id );
			$data ['info'] = $info;
			$data ['is_collect'] = $this->lesson_model->check_collect ( $id );
			$data ['is_join'] = $is_join;
			$this->load->view ( 'lesson/info', $data );
		} else {
			err_msgs ( '您要访问的资讯不存在', site_url ( 'lesson/lesson/show' ) );
		}
	}
}