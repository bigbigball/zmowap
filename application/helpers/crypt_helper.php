<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	// encrypt
if (! function_exists ( 'encryptAES' )) {
	function encryptAES($key, $str) {
		include_once APPPATH . 'third_party/CryptAES.php';
		$aes = new CryptAES ();
		$aes->set_key ( $key );
		$aes->require_pkcs5 ();
		return $aes->encrypt ( $str );
	}
}

// decrypt
if (! function_exists ( 'decryptAES' )) {
	function decryptAES($key, $code) {
		include_once APPPATH . 'third_party/CryptAES.php';
		$aes = new CryptAES ();
		$aes->set_key ( $key );
		$aes->require_pkcs5 ();
		return $aes->decrypt ( $code );
	}
}

if (! function_exists ( 'hsCheck' )) {
	function hsCheck1($isLoginCheck = true) {
		$redis = redis ( 18 );
		if (! isset ( $_SESSION ['user_id'] ) && $isLoginCheck == true) {
			exit ( '{"ret":408}' );
		}
		if (isset ( $_SESSION ['status'] ) && $_SESSION ['status'] == 2) {
			$redis->select ( 17 );
			$redis->setex ( $_SESSION ['user_id'], 300, time () );
		}
	}
	function hsCheck($isLoginCheck = true) {
		$CI = & get_instance ();
		$get = $CI->input->get ();
		if (! isset ( $get ['token'] ) or $get ['token'] == '' or ! isset ( $get ['code'] ) or $get ['code'] == '') {
			exit ( '{"ret":403}' );
		}
		$redis = redis ( 18 );
		if ($redis->exists ( $get ['token'] )) {
			exit ( '{"ret":403}' );
		}
		$post = $CI->input->post ();
		$postStr = '';
		
		if (is_array ( $post ) && ! empty ( $post )) {
			foreach ( $post as $key => $value )
				$postStr .= $key . '=' . $value . '&';
			$postStr = rtrim ( $postStr, '&' );
			$postStr = md5 ( $postStr );
		}
		
		$md5 = md5 ( $postStr . HSKEY_2 . $get ['code'] );
		
		$key = substr ( $md5, 0, 16 ) . AUTHKEY_2;
		
		$str = substr ( $md5, - 16 );
		
		if (encryptAES ( $key, $str ) != $get ['token']) {
			exit ( '{"ret":403}' );
		} else {
			$redis->setex ( $get ['token'], 600, $get ['code'] );
		}
		
		if (! isset ( $_SESSION ['user_id'] ) && $isLoginCheck == true) {
			exit ( '{"ret":408}' );
		}
		if (isset ( $_SESSION ['status'] ) && $_SESSION ['status'] == 2) {
			$redis->select ( 17 );
			$redis->setex ( $_SESSION ['user_id'], 300, time () );
		}
	}
}

if (! function_exists ( 'deHsCheck' )) {
	function deHsCheck() {
		$CI = & get_instance ();
		$CI->load->helper ( 'string' );
		$code = random_string ( 'unique' );
		// $code = 'ee67d7b0fc2040ab4ca2a3caadc80023';
		$post = $CI->input->post ();
		$postStr = '';
		
		if (is_array ( $post ) && ! empty ( $post )) {
			foreach ( $post as $key => $value )
				$postStr .= $key . '=' . $value . '&';
			$postStr = rtrim ( $postStr, '&' );
			$postStr1 = $postStr;
			$postStr = md5 ( $postStr );
		}
		
		/*
		 * if(! empty($post)) $postStr = http_build_query($post);
		 */
		// $postStr = file_get_contents("php://input");
		$md5 = md5 ( $postStr . HSKEY_2 . $code );
		$key = substr ( $md5, 0, 16 ) . AUTHKEY_2;
		$str = substr ( $md5, - 16 );
		$result ['token'] = encryptAES ( $key, $str );
		$result ['code'] = $code;
		$result ['post'] = $postStr1;
		$result ['poststr'] = $postStr;
		return $result;
	}
}

if (! function_exists ( 'my_json_encode' )) {
	function my_json_encode($arr) {
		array_walk_recursive ( $arr, function (&$item, $key) {
			if (is_string ( $item ))
				$item = urlencode ( addcslashes ( $item, "\v\t\n\r\f\"\\/" ) );
		} );
		return urldecode ( json_encode ( $arr ) );
	}
}

if (! function_exists ( 'array_value_recursive' )) {
	function array_value_recursive($key, array $arr) {
		$val = array ();
		array_walk_recursive ( $arr, function ($v, $k) use($key, &$val) {
			if ($k == $key)
				array_push ( $val, $v );
		} );
		return count ( $val ) > 1 ? $val : array_pop ( $val );
	}
}

if (! function_exists ( 'bd_encrypt' )) {
	function bd_encrypt(&$gg_lat, &$gg_lon) {
		$x_pi = 3.14159265358979324 * 3000.0 / 180.0;
		$x = $gg_lon;
		$y = $gg_lat;
		$z = sqrt ( $x * $x + $y * $y ) + 0.00002 * sin ( $y * $x_pi );
		$theta = atan2 ( $y, $x ) + 0.000003 * cos ( $x * $x_pi );
		$gg_lon = $z * cos ( $theta ) + 0.0065;
		$gg_lat = $z * sin ( $theta ) + 0.006;
	}
}

if (! function_exists ( 'bd_decrypt' )) {
	function bd_decrypt(&$gg_lat, &$gg_lon) {
		$x_pi = 3.14159265358979324 * 3000.0 / 180.0;
		$x = $gg_lon - 0.0065;
		$y = $gg_lat - 0.006;
		$z = sqrt ( $x * $x + $y * $y ) - 0.00002 * sin ( $y * $x_pi );
		$theta = atan2 ( $y, $x ) - 0.000003 * cos ( $x * $x_pi );
		$gg_lon = $z * cos ( $theta );
		$gg_lat = $z * sin ( $theta );
	}
}
