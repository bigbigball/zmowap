<?php
class Sms {
	private $api;
	public function __construct() {
		$this->ci = &get_instance ();
		$this->api = $this->ci->config->item ( 'sms' );
	}
	/*
	 * $strRegParam = "reg=" . $strReg . "&pwd=" . $strPwd . "&uname=" . $strUname . "&mobile=" . $strMobile . "&phone=" . $strRegPhone . "&fax=" . $strFax . "&email=" . $strEmail . "&postcode=" . $strPostcode . "&company=" . $strCompany . "&address=" . $strAddress; $strBalanceParam = "reg=" . $strReg . "&pwd=" . $strPwd; $strSmsParam = "reg=" . $strReg . "&pwd=" . $strPwd . "&sourceadd=" . $strSourceAdd . "&phone=" . $strPhone . "&content=" . $strContent; $strSchSmsParam = "reg=" . $strReg . "&pwd=" . $strPwd . "&sourceadd=" . $strSourceAdd . "&tim=" . $strTim . "&phone=" . $strPhone . "&content=" . $strContent; $strStatusParam = "reg=" . $strReg . "&pwd=" . $strPwd; $strUpPwdParam = "reg=" . $strReg . "&pwd=" . $strPwd . "&newpwd=" . $strNewPwd;
	 */
	public function sendSms($phone, $conent) {
		$param = "reg=" . $this->api ['code'] . "&pwd=" . $this->api ['key'] . "&sourceadd=&phone=" . $phone . "&content=" . $conent;
		$ret = $this->postSend ( $this->api ['api'] ['sendsms'], $param );
		return $ret;
	}
	private function getSend($url, $param) {
		$ch = curl_init ( $url . "?" . $param );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_BINARYTRANSFER, true );
		$output = curl_exec ( $ch );
		return $output;
	}
	private function postSend($url, $param) {
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $param );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		$data = curl_exec ( $ch );
		curl_close ( $ch );
		return $data;
	}
	private function gbkToUtf8($str) {
		return rawurlencode ( iconv ( 'GB2312', 'UTF-8', $str ) );
	}
}
?>