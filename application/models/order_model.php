<?php
class Order_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function get_order($oid, $user_id = 0) {
		$this->db->select ( '*' );
		$this->db->where ( 'id', $oid );
		if ($user_id != 0) {
			$this->db->where ( 'user_id', $user_id);
		}
		$query = $this->db->get ( 'order' );
		if ($query->num_rows () > 0) {
			$oinfo = $query->row_array ();
			$this->db->select ( 'goods_id,price,type' );
			$this->db->where ( 'order_id', $oid );
			$query = $this->db->get ( 'order_goods' );
			if ($query->num_rows () > 0) {
				$info = $query->row_array ();
				$data ['ret'] = 200;
				$info ['oid'] = $oid;
				$info ['oprice'] = $oinfo ['price'];
				$info ['status'] = $oinfo ['status'];
				$info ['order_sn'] = $oinfo ['order_sn'];
				$info ['ctime'] = $oinfo ['ctime'];
				$data ['info'] = $info;
				return $data;
			}
			return array (
					'ret' => 205 
			);
		}
		return array (
				'ret' => 204 
		);
	}
	function get_user_info() {
		$this->db->select ( 'id,nick_name ,email,mobile' );
		$this->db->where ( 'id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'user' );
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			$data ['ret'] = 200;
			$data ['info'] = $info;
			return $data;
		}
		return false;
	}
	function update_order($post) {
		if (! empty ( $post ['oid'] )) {
			$this->db->select ( 'id,status' );
			$this->db->where ( 'id', $post ['oid'] );
			$query = $this->db->get ( 'order' );
			if ($query->num_rows () > 0) {
				$info = $query->row_array ();
				if ($info ['status'] < $post ['status']) {
					$data = array();
					foreach (array('status','buyer_email','buyer_id','notify_id','trade_no') as $key) {
						if (isset($post[$key])) {
							$data[$key] = $post[$key];
						}
					}
					$this->db->where ( 'id', $info ['id'] )->update ( 'order', $data );
					return array (
							'ret' => 200 
					);
				}
				return array (
						'ret' => 205 
				);
			}
			return array (
					'ret' => 204 
			);
		} else {
			return array (
					'ret' => 400 
			);
		}
	}
	function do_pay($post, $info_goods) {
		require_once ( APPPATH.'third_party/Pay/alipay.config.php');
		require_once ( APPPATH.'third_party/Pay/lib/alipay_submit.class.php');
		
		// 支付类型
		$payment_type = "1";
		// 必填，不能修改
		// 服务器异步通知页面路径
		$notify_url = site_url ( 'order/order/notify') ; 
		// 需http://格式的完整路径，不能加?id=123这类自定义参数 //页面跳转同步通知页面路径
		$return_url = site_url ( 'order/order/success', array ('oid' => $post ['oid']) ) ; 
		
		// 需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

		//卖家支付宝帐户
		$seller_email = 'zhangll@bdhe.cn';
		// 必填 //商户订单号
		$out_trade_no = sprintf("%016d%016d", $post['ctime'], $post['order_sn']);
		// 商户网站订单系统中唯一订单号，必填 //订单名称
		$subject = $info_goods['goods_title'];
		// 必填 //付款金额
		$total_fee = $post['price'];
		// 必填 //订单描述 $body = $_POST['WIDbody'];
		// 商品展示地址
		if ($post ['type'] == 2) {
			$show_url = site_url ( "lesson/lesson/info/{$info_goods['goods_id']}" );
		} else if ($post ['type'] == 4) {
			$show_url = site_url ( "active/active/info/{$info_goods['goods_id']}" );
		}
		// 需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html //防钓鱼时间戳
		$anti_phishing_key = "";
		// 若要使用请调用类文件submit中的query_timestamp函数 //客户端的IP地址
		$exter_invoke_ip = "";
		// 非局域网的外网IP地址，如：221.0.0.1
		
		/**
		 * *********************************************************
		 */
		
		// 构造要请求的参数数组，无需改动
		$parameter = array (
				"service" => "create_direct_pay_by_user",
				"partner" => trim ( $alipay_config ['partner'] ),
				"payment_type" => $payment_type,
				"notify_url" => $notify_url,
				"return_url" => $return_url,
				"seller_email" => $seller_email,
				"out_trade_no" => $out_trade_no,
				"subject" => $subject,
				"total_fee" => $total_fee,
				"body" => $info_goods['goods_title'],
				"show_url" => $show_url,
				"anti_phishing_key" => $anti_phishing_key,
				"exter_invoke_ip" => $exter_invoke_ip,
				"_input_charset" => trim ( strtolower ( $alipay_config ['input_charset'] ) )
		);
		
		// 建立请求
		$alipaySubmit = new AlipaySubmit ( $alipay_config );
		$html_text = $alipaySubmit->buildRequestForm ( $parameter, "get", "确认" );
		
		return array(
			'ret' => 200,
			'html' => $html_text,
		);
	}
	
	function check_pay($post, $info) {
		$out_trade_no = sprintf("%016d%016d", $info['ctime'], $info['order_sn']);
		if ($out_trade_no != $post['out_trade_no']) {
			return array('ret' => 400);
		}
		
		$sign = $post['sign'];
		$sign_type = $post['sign_type'];
		unset($post['sign']); unset($post['sign_type']);
		ksort($post, SORT_STRING);
		unset($post['oid']);
		
		$sign_str = '';
		require_once ( APPPATH.'third_party/Pay/alipay.config.php');
		foreach ($post as $k => $v) {
			$sign_str .= $k . '=' . $v . '&';
		}
		$sign_str = rtrim($sign_str, '&');
		$sign_str .= $alipay_config ['key'];

		$md5str = md5($sign_str);
		if ($sign == $md5str) {
			return array('ret' => 200);
		}
		
		return array('ret' => 400);
	}
	
	function center($post) {
		$this->db->select ( 'id , price , ctime , status,order_sn' );
		if (isset( $post ['otype'] )) {
			$this->db->where ( 'status', $post ['otype'] );
		}
		$this->db->where ( 'user_id', $_SESSION ['uid'] );
		$this->db->order_by ( 'id', 'desc' );
		$query = $this->db->get ( 'order' );
		if ($query->num_rows () > 0) {
			$order = $query->result_array ();
			foreach ( $order as $k => $v ) {
				$oid [] = $v ['id'];
			}
			$this->db->select ( 'id ,order_id, goods_id , goods_title,goods_img' );
			$this->db->where_in ( 'order_id', $oid );
			$this->db->limit ( 10 );
			$query = $this->db->get ( 'order_goods' );
			// ss($query);
			if ($query->num_rows () > 0) {
				$order_goods = $query->result_array ();
				foreach ( $order_goods as $k => $v ) {
					$ogid [] = $v ['goods_id'];
					$order_goods_info [$v ['order_id']] = $v;
				}
			}
			$data ['order'] = $order;
			$data ['order_goods'] = $order_goods_info;
			// ss($data);
			return $data;
		}
		return false;
	}
	function get_order_goods($oid) {
		if (empty ( $oid )) {
			return false;
		}
		$this->db->select ( '*' );
		$this->db->where ( 'order_id', $oid );
		$query = $this->db->get ( 'order_goods' );
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			return $info;
		} else {
			return false;
		}
	}
}
