<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model', '', true );
		$this->load->library ( 'form_validation' );
	}
	function regist() {
		$post = $this->input->post ();
		if (empty ( $post )) {
			$this->load->view ( 'user/regist' );
		} else {
			$this->form_validation->set_rules ( 'reg_type', 'reg_type', 'required' );
			if ($post ['reg_type'] == 1) {
				$this->form_validation->set_rules ( 'mail', 'mail', 'required' );
				$this->form_validation->set_rules ( 'm_pwd', 'm_pwd', 'required' );
				$this->form_validation->set_rules ( 'm_code', 'm_code', 'required' );
			} else if ($post ['reg_type'] == 2) {
			}
			if ($this->form_validation->run () == FALSE) {
				ss ( '参数错误' );
			}
			if ($post ['reg_type'] == 1) {
				$info = $this->user_model->registbyemail ( $post );
			} else if ($post ['reg_type'] == 2) {
				$info = $this->user_model->regist ( $post );
			}
			switch ($info ['ret']) {
				case 200 :
					ss ( '注册成功' );
				case 204 :
					ss ( '这个邮箱已经注册，请登录或者重新注册' );
					break;
				case 304 :
					ss ( '您的邀请已使用或者已过期' );
					break;
				case 205 :
					ss ( '您注册失败请重新注册' );
					break;
			}
		}
	}
	function login() {
		$post = $this->input->post ();
		if (empty ( $post )) {
			$this->load->view ( 'user/login' );
		} else {
			$this->form_validation->set_rules ( 'mail', 'mail', 'required' );
			$this->form_validation->set_rules ( 'pwd', 'pwd', 'required' );
			if ($this->form_validation->run () == FALSE) {
				ss ( '1-参数错误' );
			}
			$info = $this->user_model->login ( $post );
			switch ($info ['ret']) {
				case 200 :
					ss ( '登录成功' );
					break;
				case 204 :
					ss ( '邮箱或者密码错误，请重新输入' );
					break;
				case 400 :
					ss ( '参数错误' );
					break;
			}
		}
	}
}