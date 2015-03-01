<?php
if (! function_exists ( 'ss' )) {
	function ss($data) {
		header ( "Content-type:text/html;charset=utf-8" );
		echo '<pre>';
		var_dump ( $data );
		echo '</pre>';
		exit ();
	}
}

if (! function_exists ( 'get_upload_file_dir' )) {
	function get_upload_file_dir() {
		$base_dir = dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/zmo/upload/';
		$time = date ( 'Y-m-d-H', time () );
		$time_dir = explode ( '-', $time );
		$dir = $base_dir;
		if (! empty ( $time_dir )) {
			foreach ( $time_dir as $k => $v ) {
				$dir = str_replace ( '\\', '/', $dir . $v . '/' );
				if (! file_exists ( $dir )) {
					mkdir ( $dir );
				}
			}
		}
		return $dir;
	}
}

if (! function_exists ( 'get_base_dir' )) {
	function get_base_dir() {
		$base_dir = str_replace ( '\\', '/', dirname ( dirname ( dirname ( __FILE__ ) ) ) );
		return $base_dir;
	}
}