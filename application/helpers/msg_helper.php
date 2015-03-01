<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
if (! function_exists ( 'trie_filter' )) {
	function trie_filter($msg) {
		$trie = trie_filter_load ( APPPATH . 'files/filter.dic' );
		$result = trie_filter_search ( $trie, $msg );
		if (! empty ( $result )) {
			return false;
		}
		return true;
	}
}
if (! function_exists ( 'ss' )) {
	function ss($str) {
		header ( "Content-type:text/html;charset=utf-8" );
		echo '<pre>';
		print_r ( $str );
		exit ();
	}
}
if (! function_exists ( 'msgs' )) {
	function msgs($msg, $url) {
		$CI = & get_instance ();
		$msg = ! empty ( $msg ) ? $msg : '您不该来到此处哈~';
		$url = ! empty ( $url ) ? $url : site_url ( 'home/index' );
		$data ['msg'] = $msg;
		$data ['url'] = $url;
		$CI->load->view ( 'msg/msg', $data );
	}
}

if (! function_exists ( 'err_msgs' )) {
	function err_msgs($msg, $url) {
		$CI = & get_instance ();
		$msg = ! empty ( $msg ) ? $msg : '您不该来到此处哈~';
		$url = ! empty ( $url ) ? $url : site_url ( 'home/index' );
		$data ['msg'] = $msg;
		$data ['url'] = $url;
		$CI->load->view ( 'msg/err_msg', $data );
	}
}

