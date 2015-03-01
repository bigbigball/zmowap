<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Test extends CI_Controller {
	function __construct() {
		parent::__construct ();
	}
	public function do_comment() {
		$sms = new Sms ();
		$ret = $sms->sendSms ( '15901516572', '验证码:789456' );
		ss ( $ret );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */