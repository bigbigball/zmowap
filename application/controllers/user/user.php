<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->load->model ( 'user_model', '', true );
		$this->load->model ( 'lesson_model', '', true );
		$this->load->model ( 'active_model', '', true );
		$this->load->model ( 'teacher_model', '', true );
		$this->load->library ( 'form_validation' );
	}
	function regist() {
		if ($this->check_login ()) {
			err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
		}
		$post = $this->input->post ();
		if (empty ( $post )) {
			$this->load->view ( 'user/regist' );
		} else {
			$this->form_validation->set_rules ( 'mail', 'mail', 'required' );
			$this->form_validation->set_rules ( 'm_pwd', 'm_pwd', 'required' );
			$this->form_validation->set_rules ( 'm_code', 'm_code', 'required' );
			if ($this->form_validation->run () == FALSE) {
				err_msgs ( '参数错误', site_url ( 'user/user/regist' ) );
			}
			$info = $this->user_model->registbyemail ( $post );
			switch ($info ['ret']) {
				case 200 :
					msgs ( '注册成功', site_url ( 'user/user/login' ) );
					break;
				case 204 :
					err_msgs ( '这个邮箱已经注册，请登录或者重新注册', site_url ( 'user/user/regist' ) );
					break;
				case 304 :
					err_msgs ( '您的邀请已使用或者已过期', site_url ( 'user/user/regist' ) );
					break;
				case 205 :
					err_msgs ( '您注册失败请重新注册', site_url ( 'user/user/regist' ) );
					break;
			}
		}
	}
	function phone_regist() {
		if ($this->check_login ()) {
			err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
		}
		$this->form_validation->set_rules ( 'p_phone', 'p_phone', 'required' );
		$this->form_validation->set_rules ( 'p_pwd', 'p_pwd', 'required' );
		$this->form_validation->set_rules ( 'p_code', 'p_code', 'required' );
		$this->form_validation->set_rules ( 'p_dy_code', 'p_dy_code', 'required' );
		if ($this->form_validation->run () == FALSE) {
			err_msgs ( '参数错误', site_url ( 'user/user/regist' ) );
		}
		$post = $this->input->post ();
		$info = $this->user_model->registbyphone ( $post );
		switch ($info ['ret']) {
			case 200 :
				msgs ( '注册成功', site_url ( 'user/user/login' ) );
				break;
			case 204 :
				err_msgs ( '这个邮箱已经注册，请登录或者重新注册', site_url ( 'user/user/regist' ) );
				break;
			case 304 :
				err_msgs ( '您的邀码请已使用或者已过期', site_url ( 'user/user/regist' ) );
				break;
			case 305 :
				err_msgs ( '您的手机验证码输入错误或已失效', site_url ( 'user/user/regist' ) );
				break;
			case 205 :
				err_msgs ( '该手机号已经注册过，请您登录', site_url ( 'user/user/login' ) );
				break;
		}
	}
	function login() {
		if ($this->check_login ()) {
			err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
		}
		$post = $this->input->post ();
		if (empty ( $post )) {
			$config ['bd'] = $this->config->item ( 'bd' );
			$config ['qq'] = $this->config->item ( 'qq' );
			$config ['wx'] = $this->config->item ( 'wx' );
			$data ['config'] = $config;
			$this->load->view ( 'user/login', $data );
		} else {
			$this->form_validation->set_rules ( 'mail', 'mail', 'required' );
			$this->form_validation->set_rules ( 'pwd', 'pwd', 'required' );
			if ($this->form_validation->run () == FALSE) {
				err_msgs ( '参数错误', site_url ( 'user/user/login' ) );
			}
			$info = $this->user_model->login ( $post );
			switch ($info ['ret']) {
				case 200 :
					msgs ( '登陆成功', site_url ( 'user/user/center' ) );
					break;
				case 204 :
					err_msgs ( '邮箱或者密码错误，请重新输入', site_url ( 'user/user/login' ) );
					break;
				case 400 :
					err_msgs ( '参数错误', site_url ( 'user/user/login' ) );
					break;
			}
		}
	}
	function ajax_login() {
		if ($this->check_login ()) {
			err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
		}
		$post = $this->input->post ();
		if (empty ( $post )) {
			$config ['bd'] = $this->config->item ( 'bd' );
			$config ['qq'] = $this->config->item ( 'qq' );
			$config ['wx'] = $this->config->item ( 'wx' );
			$data ['config'] = $config;
			$this->load->view ( 'user/login', $data );
		} else {
			$this->form_validation->set_rules ( 'mail', 'mail', 'required' );
			$this->form_validation->set_rules ( 'pwd', 'pwd', 'required' );
			if ($this->form_validation->run () == FALSE) {
				echo json_encode ( array (
						'ret' => 400,
						'message' => '参数错误' 
				) );
				exit ();
			}
			$info = $this->user_model->login ( $post );
			switch ($info ['ret']) {
				case 200 :
					echo json_encode ( array (
							'ret' => 200,
							'message' => '登陆成功' 
					) );
					exit ();
					break;
				case 204 :
					echo json_encode ( array (
							'ret' => 204,
							'message' => '邮箱或者密码错误，请重新输入' 
					) );
					exit ();
					break;
				case 400 :
					echo json_encode ( array (
							'ret' => 400,
							'message' => '参数错误' 
					) );
					exit ();
					break;
			}
		}
	}
	function center() {
		/*
		 * $user_info = $this->user_model->get_user_info(); $data['user_info'] = $user_info; $this->load->view('user/center' , $data);
		 */
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
			return ;
		}
		$this->order ();
	}
	function order() {
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
			return ;
		}
		
		$get = $this->input->get ();
		$action = ! empty ( $get ['action'] ) ? $get ['action'] : 'my_order_pay';
		$otype = 0;
		switch ($action) {
			case 'my_order_pay' :
				$otype = 2;
				break;
			case 'my_order_nopay' :
				$otype = 0;
				break;
			case 'my_order_error' :
				$otype = 3;
				break;
			default :
				$otype = 1;
		}
		$post ['otype'] = $otype;
		$this->load->model ( 'order_model', '', true );
		$order = $this->order_model->center ( $post );
		$user_info = $this->user_model->get_user_info ();
		$data ['order'] = $order;
		$data ['user_info'] = $user_info;
		$data ['action'] = 'order';
		$this->load->view ( 'user/order', $data );
	}
	function collect() {
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
			return ;
		}
		
		$get = $this->input->get ();
		$action = ! empty ( $get ['action'] ) ? $get ['action'] : 'my_order_pay';
		$otype = 0;
		switch ($action) {
			case 'collect_lesson' :
				$otype = 2;
				break;
			case 'collect_active' :
				$otype = 3;
				break;
			case 'collect_tutor' :
				$otype = 4;
				break;
			default :
				$otype = 1;
		}
		$post ['otype'] = $otype;
		$this->load->model ( 'collection_model', '', true );
		$collects = $this->collection_model->center ( $post );
		$infos = array();
		if ($otype == 2) {
			if(!empty($collects)){
				foreach($collects as $collect){
					$relation_id = $collect['relation_id'];
					$infos[] = $this->lesson_model->getinfo($relation_id);
				}
			}
		} else if ($otype == 3) {
			if(!empty($collects)){
				foreach($collects as $collect){
					$relation_id = $collect['relation_id'];
					$infos[] = $this->active_model->getinfo($relation_id);
				}
			}
		} else if ($otype == 4) {
			if(!empty($collects)){
				foreach($collects as $collect){
					$relation_id = $collect['relation_id'];
					$infos[] = $this->teacher_model->getinfo($relation_id);
				}
			}
		}
		
		$user_info = $this->user_model->get_user_info ();
		$data ['user_info'] = $user_info;
		$data ['action'] = 'collect';
		$data ['infos'] = $infos;
		$data ['otype'] = $otype;
		
		$this->load->view ( 'user/collect', $data );
	}
	function sms() {
		$get = $this->input->get ();
		$action = ! empty ( $get ['action'] ) ? $get ['action'] : 'sms_contacts';
		$sms_type = 1;
		switch ($action) {
			case 'sms_contacts' :
				$data ['file'] = 'sms_contacts';
				$sms_type = 1;
				break;
			case 'sms_order' :
				$data ['file'] = 'sms_order';
				$sms_type = 2;
				break;
			case 'sms_push' :
				$data ['file'] = 'sms_push';
				$sms_type = 3;
				break;
		}
		
		$post ['sms_type'] = $sms_type;
		$this->load->model ( 'sms_model', '', true );
		$sms = $this->sms_model->center ( $post );
		
		$user_info = $this->user_model->get_user_info ();
		$data ['user_info'] = $user_info;
		$data ['sms'] = $sms;
		$data ['action'] = 'sms';
		$this->load->view ( 'user/sms', $data );
	}
	function other() {
		$get = $this->input->get ();
		$action = ! empty ( $get ['action'] ) ? $get ['action'] : 'bind_phone';
		switch ($action) {
			case 'bind_phone' :
				$data ['file'] = 'bind_phone';
				break;
			case 'verify_mail' :
				$data ['file'] = 'verify_mail';
				break;
			case 'passwd_manage' :
				$data ['file'] = 'passwd_manage';
				break;
		}
		$user_info = $this->user_model->get_user_info ();
		$data ['user_info'] = $user_info;
		$data ['action'] = 'other';
		$this->load->view ( 'user/other', $data );
	}
	function change_password() {
		$post = $this->input->post ();
		$data ['file'] = 'second_step';
		$data ['action'] = 'other';
		$this->load->view ( 'user/other', $data );
	}
	function do_update_pwd() {
		$this->form_validation->set_rules ( 'pwd', 'pwd', 'required' );
		$this->form_validation->set_rules ( 'ver_pwd', 'ver_pwd', 'required' );
		if ($this->form_validation->run () == FALSE) {
			err_msgs ( '参数错误', site_url ( 'user/user/regist' ) );
		}
		$post = $this->input->post ();
		if ($post ['pwd'] != $post ['ver_pwd']) {
			err_msgs ( '您输入的两次密码不一致，请重新输入', site_url ( 'user/user/other', array (
					'action' => 'passwd_manage' 
			) ) );
		}
		$info = $this->user_model->update_pwd ( $post );
		$data ['action'] = 'other';
		$data ['url'] = site_url ( 'user/user/other', array (
				'action' => 'passwd_manage' 
		) );
		if ($info) {
			$data ['msg'] = '修改成功';
			$data ['file'] = 'success';
			$this->load->view ( 'user/center', $data );
		} else {
			$data ['msg'] = '操作失败';
			$data ['file'] = 'error';
			$this->load->view ( 'user/center', $data );
		}
	}
	function loginout() {
		if ($this->check_login ()) {
			if (! empty ( $_COOKIE )) {
				foreach ( $_COOKIE as $k => $v ) {
					setcookie ( $k, $v, time () - 3600 );
					// session_destroy();
					unset ( $_SESSION ['uid'] );
					unset ( $_SESSION ['name'] );
				}
			}
			msgs ( '您成功退出登陆', site_url ( 'home/index' ) );
		} else {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
		}
	}
	function bdlogin() {
		$get = $this->input->get ();
		$api = $this->config->item ( 'bd' );
		$status = 0;
		if (! empty ( $_SESSION ['third'] ) && ! empty ( $_SESSION ['atoken'] ) && ! empty ( $_SESSION ['rtoken'] )) {
			$post ['refresh_token'] = $_SESSION ['rtoken'];
			$post ['access_token'] = $_SESSION ['atoken'];
			$status = $this->user_model->bdlogin ( $post );
		} else {
			$post ['code'] = $get ['code'];
			$post ['client_id'] = $api ['key'];
			$post ['client_secret'] = $api ['skey'];
			$post ['redirect_uri'] = $api ['rurl'];
			$post ['grant_type'] = 'authorization_code';
			$info = callHttpGet ( $api ['token'], $post );
			if (! isset ( $info ['error'] )) {
				$post ['expires_in'] = $info ['expires_in'];
				$post ['refresh_token'] = $info ['refresh_token'];
				$post ['access_token'] = $info ['access_token'];
				$post ['session_secret'] = $info ['session_secret'];
				$post ['session_key'] = $info ['session_key'];
				$post ['scope'] = $info ['scope'];
				$_SESSION ['third'] = 1;
				$_SESSION ['atoken'] = $info ['access_token'];
				$_SESSION ['rtoken'] = $info ['refresh_token'];
				$status = $this->user_model->bdlogin ( $post );
			}
		}
		if ($status) {
			msgs ( '登入成功', site_url ( 'home/index' ) );
		}
	}
	function qq_login() {
		include_once APPPATH . 'third_party/qq/qqConnectAPI.php';
		$qc = new QC ();
		$qc->qq_login ();
	}
	function is_login() {
		if (! empty ( $_SESSION ['uid'] )) {
			exit ( json_encode ( array (
					'ret' => 200,
					'msg' => '您已经登陆' 
			) ) );
		}
		exit ( json_encode ( array (
				'ret' => 204,
				'msg' => '您还没有登陆' 
		) ) );
	}
	function get_phone_number() {
		$info = $this->user_model->get_phone_number ();
		$data ['ret'] = 204;
		if ($info) {
			$data ['ret'] = 200;
			$data ['info'] = $info;
		}
		exit ( json_encode ( $data ) );
	}
	function get_mail() {
		$info = $this->user_model->get_mail ();
		$data ['ret'] = 204;
		if ($info) {
			$data ['ret'] = 200;
			$data ['info'] = $info;
		}
		exit ( json_encode ( $data ) );
	}
	private function check_login() {
		if (! empty ( $_SESSION ['uid'] )) {
			return true;
		}
		return false;
	}

	function find_pwd() {
        if ($this->check_login ()) {
            err_msgs ( '您已经登陆', site_url ( 'user/user/center' ) );
        }

        $post = $this->input->post ();
        if (empty ( $post )) {
            $this->load->view ( 'user/find_pwd' );
        } else {
            $this->form_validation->set_rules ( 'p_phone', 'p_phone', 'required' );
            $this->form_validation->set_rules ( 'p_pwd', 'p_pwd', 'required' );
            $this->form_validation->set_rules ( 'p_dy_code', 'p_dy_code', 'required' );
            if ($this->form_validation->run () == FALSE) {
                err_msgs ( '参数错误', site_url ( 'user/user/find_pwd' ) );
            }

            $info = $this->user_model->find_pwd ( $post );
            switch ($info ['ret']) {
                case 200 :
                    msgs ( '修改成功', site_url ( 'user/user/login' ) );
                    break;
                case 305 :
                    err_msgs ( '您的手机验证码输入错误或已失效', site_url ( 'user/user/find_pwd' ) );
                    break;
                case 205 :
                    err_msgs ( '您的手机号还没有注册，请注册', site_url ( 'user/user/regist' ) );
                    break;
            }
        }
    }
}
