<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

if (! function_exists ( 'get_url' )) {
	function get_url($url = '') {
		if ($url == '')
			return $url;
		$temp = '';
		for($i = 0; $i <= 4; $i ++) {
			$temp .= $url {$i} . '/';
		}
		return $temp . $url;
	}
}

