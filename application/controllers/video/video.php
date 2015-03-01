<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Video extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'video_model', '', true );
		$this->load->library ( 'form_validation' );
		$ci = & get_instance ();
		$variable = array (
				'haction' => 'video' 
		);
		$ci->load->vars ( $variable );
	}
	function show() {
		$get = $this->input->get ();
		$option ['type'] = empty ( $get ['type'] ) ? 0 : $get ['type'];
		
		// 分页
		$option ['limit'] = 9;
		$option ['page'] = empty ( $get ['page'] ) ? 1 : $get ['page'];
		$this->load->library ( 'pagination' );
		$config ['num_links'] = 1;
		$config ['use_page_numbers'] = TRUE;
		$config ['page_query_string'] = TRUE;
		$config ['base_url'] = site_url ( 'video/video/show', array (
				'type' => $option ['type'] 
		) );
		$config ['total_rows'] = $this->video_model->get_count ( $option );
		$config ['per_page'] = $option ['limit'];
		$config ['cur_page'] = $option ['page'];
		
		$this->pagination->initialize ( $config );
		$pagination = $this->pagination->create_links ();
		$list = $this->video_model->getlist ( $option );
		if (! empty ( $list ['info'] )) {
			$data ['list'] = array_chunk ( $list ['info'], 3 );
		}
		$data ['type'] = $get ['type'];
		$data ['page'] = $pagination;
		$this->load->view ( 'video/show', $data );
	}
	function info() {
		$get = $this->input->get ();
		if (! isset ( $get ['id'] ) || empty ( $get ['id'] )) {
			err_msg ( '参数错误', site_url ( 'video/video/show' ) );
		}
		$info = $this->video_model->get_info ( $get ['id'] );
		if (! empty ( $info )) {
			$data ['info'] = $info;
			$this->load->view ( 'video/info', $data );
		} else {
			err_msgs ( '您要看的视频已被删除或不存在', site_url ( 'video/video/show' ) );
		}
	}
}