<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class News extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'news_model', '', true );
		$this->load->library ( 'form_validation' );
		$ci = & get_instance ();
		$variable = array (
				'haction' => 'news' 
		);
		$ci->load->vars ( $variable );
	}
	
	// $type:1人物 2热点 3行业
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
		$config ['base_url'] = site_url ( 'news/news/show', array (
				'type' => $option ['type'] 
		) );
		$config ['total_rows'] = $this->news_model->get_count ( $option );
		$config ['per_page'] = $option ['limit'];
		$config ['cur_page'] = $option ['page'];
		$this->pagination->initialize ( $config );
		$pagination = $this->pagination->create_links ();
		$list = $this->news_model->getlist ( $option );
		$data ['list'] = $list;
		$data ['page'] = $pagination;
		$data ['type'] = $option ['type'];
		$this->load->view ( 'news/show', $data );
	}
	function info($id) {
		if (empty ( $id )) {
			ss ( '参数错误' );
		}
		$info = $this->news_model->getinfo ( $id );
		if (! empty ( $info )) {
			$data ['info'] = $info;
			$this->load->view ( 'news/info', $data );
		} else {
			ss ( '您要访问的资讯不存在' );
		}
	}
	function aboutus() {
		$this->load->view ( 'news/aboutus' );
	}
	function joinus() {
		$this->load->view ( 'news/aboutus' );
	}
	function help() {
		$this->load->view ( 'news/aboutus' );
	}
}