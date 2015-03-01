<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Order extends CI_Controller {
	function __construct() {
		parent::__construct ();
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
		}
		$this->load->model ( 'order_model', '', true );
		$this->load->library ( 'form_validation' );
	}
	public function buy() {
		if (! $this->check_login ()) {
			err_msgs ( '您没有登陆，请您登陆', site_url ( 'user/user/login' ) );
		}
		
		$get = $this->input->get ();
        $oid = intval($get ['oid']);
		if (empty ( $oid )) {
			err_msgs ( '您的订单有误，请查看后，继续购买', site_url ( 'user/user/center' ) );
		}
		
		$info = $this->order_model->get_order ( $oid, $_SESSION ['uid'] );
		if ($info ['ret'] == 200) {
			if ($info ['info'] ['type'] == 2) {
				$this->load->model ( 'lesson_model', '', true );
				$goods = $this->lesson_model->getinfo ( $info ['info'] ['goods_id'] );
			} else if ($info ['info'] ['type'] == 4) {
				$this->load->model ( 'active_model', '', true );
				$goods = $this->active_model->getinfo ( $info ['info'] ['goods_id'] );
			}
			$data ['goods'] = $goods;
			$data ['order'] = $info;
			$this->load->view ( 'order/buy', $data );
		} else {
			err_msgs ( '您的想要支付的订单有误，请查证后再继续支付', site_url ( 'user/user/center' ) );
		}
	}
	public function pay() {
		$this->form_validation->set_rules ( 'oid', 'oid', 'required' );
		if ($this->form_validation->run () == FALSE) {
			err_msgs ( '参数错误', site_url ( 'order/order/buy' ) );
		}
		$post = $this->input->post ();
		$info = $this->order_model->get_order ( $post ['oid'], $_SESSION ['uid'] );
		if ($info ['ret'] == 200) {
			$data ['info'] = $info ['info'];
			if ($info ['info'] ['status'] == 0) {
			//	$post ['status'] = 1;
			//	$ou = $this->order_model->update_status ( $post );
				$data ['uinfo'] = $this->order_model->get_user_info ();
				$this->load->view ( '/order/pay', $data );
			} else {
				err_msgs ( '订单状态有误', site_url ( 'home/index' ) );
			}
		} else {
			err_msgs ( '订单有误', site_url ( 'order/order/buy' ) );
		}
	}
	function create_order() {
		$this->form_validation->set_rules ( 'oid', 'oid', 'required' );
		if ($this->form_validation->run () == FALSE) {
			err_msgs ( '参数错误', site_url ( 'user/user/center' ) );
		}
		$post = $this->input->post ();
		$info = $this->order_model->get_order ( $post ['oid'], $_SESSION ['uid'] );
		$info_goods = $this->order_model->get_order_goods ( $post ['oid'] );
		if ($info ['ret'] == 200 && $info ['info'] ['status'] < 2) {
			//$post ['status'] = 2;
			//$res = $this->order_model->update_status ( $post );
 			$res = $this->order_model->do_pay($info ['info'], $info_goods);
			if ($res ['ret'] == 200) {
				echo $res['html'];
			} else {
				err_msgs ( '订单失败，重新支付', site_url ( 'user/user/order', array (
						'action' => 'my_order_error' 
				) ) );
			}
		} else {
			err_msgs ( '您提交的订单不存在，或者状态有误' );
		}
	}
	function success() {
		$get = $this->input->get ();
		if (empty ( $get ['oid'] )) {
			err_msgs ( '参数错误', site_url ( 'user/user/center' ) );
		}

		$info = $this->order_model->get_order ( $get ['oid'] );
		$res = $this->order_model->check_pay($get, $info['info']);
		if ($res['ret'] != 200) {
			err_msgs ( '订单支付失败', site_url ( 'user/user/order') );
		}
		
		$this->order_model->update_order ( array(
				'oid' => $get['oid'], 
				'status' => 2,
				'buyer_email' => $get['buyer_email'],
				'buyer_id' => $get['buyer_id'],
				'notify_id' => $get['notify_id'],
				'trade_no' => $get['trade_no'],
		) );
		$info_goods = $this->order_model->get_order_goods ( $get ['oid'] );
		$data ['info_goods'] = $info_goods;
		$data ['info'] = $info;
		if (! empty ( $info_goods )) {
			if ($info_goods ['type'] == 2) {
				$this->load->model ( 'lesson_model', '', true );
				$goods = $this->lesson_model->getinfo ( $info ['info'] ['goods_id'] );
			} else if ($info_goods ['type'] == 4) {
				$this->load->model ( 'active_model', '', true );
				$goods = $this->active_model->getinfo ( $info ['info'] ['goods_id'] );
			}
		}
		if (! empty ( $goods )) {
			$data ['goods'] = $goods;
		}
		$this->load->view ( 'order/success', $data );
	}
	
	function notify() {
		file_put_contents('/tmp/log.zmo', print_r($_SERVER, true), FILE_APPEND);
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
