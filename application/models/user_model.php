<?php
class User_model extends CI_Model {
	function __construct() {
		parent::__construct ();
	}
	function registbyemail($parmes) {
		$data ['ret'] = '200';
		$code_info = '';
		$code_info = $this->check_code ( $parmes ['m_code'] );
		if ($code_info == 200) {
			$this->db->select ( 'id' );
			$this->db->from ( 'user' );
			$this->db->where ( 'email =', $parmes ['mail'] );
			$query = $this->db->get ();
			if ($query->num_rows () > 0) {
				$data ['ret'] = 204;
			} else {
				$insert_data ['email'] = $parmes ['mail'];
				$insert_data ['passwd'] = md5 ( $parmes ['m_pwd'] );
				$insert_data ['status'] = 0;
				$insert_data ['type'] = 1;
				$insert_data ['ctime'] = time ();
				$insert_data ['utime'] = time ();
				
				$reg = $this->db->insert ( 'user', $insert_data );
				if ($reg) {
					$id = $this->db->insert_id ();
					$update_data ['user_id'] = $id;
					$update_data ['reg_type'] = 1;
					$update_data ['status'] = 1;
					$update_data ['utime'] = time ();
					
					$this->db->where ( 'code' , $parmes ['m_code'] )->update ( 'code', $update_data );
					$_SESSION ['uid'] = $id;
					$_SESSION ['uname'] = substr ( $parmes ['mail'], 0, strpos ( $parmes ['mail'], '@' ) );
					return array (
							'ret' => '200' 
					);
					$data ['ret'] = 200;
				} else {
					$data ['ret'] = 205;
				}
			}
		} else {
			$data ['ret'] = 304;
		}
		
		return $data;
	}
	public function registbyphone($post) {
		// ss($post);
		$this->db->select ( 'id,code' );
		$this->db->where ( 'expire >', time () );
		$this->db->where ( 'type', 0 );
		$this->db->where ( 'phone', $post ['p_phone'] );
		$this->db->where ( 'code', $post ['p_dy_code'] );
		$this->db->order_by ( 'expire', 'desc' );
		$this->db->order_by ( 'id', 'desc' );
		$this->db->limit ( 1 );
		$query = $this->db->get ( 'vcode' );
		if ($query->num_rows () <= 0) {
			return array (
					'ret' => '305' 
			);
		} else {
			$vcode = $query->row_array ();
		}
		$this->db->select ( 'id' );
		//$this->db->where ( 'stype', '1' );
		$this->db->where ( 'code', $post ['p_code'] );
		//$this->db->where ( 'expire >', time () );
		$this->db->where ( "(expire>=" .time(). " or expire=0)" );

		$query = $this->db->get ( 'code' );
		if ($query->num_rows () <= 0) {
			return array (
					'ret' => '304' 
			);
		} else {
			$code = $query->row_array ();
		}
		
		$this->db->select ( 'id' );
		$this->db->where ( 'mobile', $post ['p_phone'] );
		$query = $this->db->get ( 'user' );
		if ($query->num_rows () > 0) {
			return array (
					'ret' => '205' 
			);
		}
		$t = time ();
		$data ['mobile'] = $post ['p_phone'];
		$data ['passwd'] = md5 ( $post ['p_pwd'] );
		$data ['type'] = 2;
		$data ['ctime'] = $t;
		$data ['utime'] = $t;
		if ($this->db->insert ( 'user', $data )) {
			$id = $this->db->insert_id ();
			$this->db->where ( 'id', $vcode ['id'] )->update ( 'vcode', array (
					'status' => 1 
			) );
			$this->db->where ( 'id', $code ['id'] )->update ( 'code', array (
					'user_id' => $id,
					'utime' => $t 
			) );
			
			$_SESSION ['uid'] = $id;
			$_SESSION ['uname'] = substr ( $post ['p_phone'], 0, 4 );
			return array (
					'ret' => '200' 
			);
		} else {
			return array (
					'ret' => '204' 
			);
		}
	}
	public function login($parmes) {
		if (empty ( $parmes ['mail'] ) || empty ( $parmes ['pwd'] )) {
			$data ['ret'] = 400;
		} else {
			$this->db->select ( 'id , nick_name , email , mobile ,status ,type' );
			$this->db->from ( 'user' );
			$this->db->where ( "(email='{$parmes['mail']}' or mobile='{$parmes['mail']}')" );
			$this->db->where ( 'passwd =', md5 ( $parmes ['pwd'] ) );
			$this->db->limit ( 1 );
			$query = $this->db->get ();
			
			if ($query->num_rows () > 0) {
				$info = $query->row_array ();
				$_SESSION ['uid'] = $info ['id'];
				if (! empty ( $info ['nick_name'] )) {
					$_SESSION ['uname'] = $info ['nick_name'];
				} else
					$_SESSION ['uname'] = ! empty ( $info ['nick_name'] ) ? $info ['nick_name'] : ! empty ( $info ['email'] ) ? substr ( $info ['email'], 0, strpos ( $info ['email'], '@' ) ) : substr ( $info ['mobile'], 0, 4 );
				$data ['ret'] = 200;
			} else {
				$data ['ret'] = 204;
			}
		}
		return $data;
	}
	public function get_user_info() {
		$this->db->select ( 'id,nick_name,email,photo,mobile,occu,portrait,from' );
		$this->db->where ( 'id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'user' );
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			return $info;
		}
		return false;
	}
	public function get_phone_number() {
		$this->db->select ( 'id , mobile' );
		$this->db->where ( 'id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'user' );
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			return $info ['mobile'];
		}
		return false;
	}
	public function get_mail() {
		$this->db->select ( 'id , email' );
		$this->db->where ( 'id', $_SESSION ['uid'] );
		$query = $this->db->get ( 'user' );
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			return $info ['email'];
		}
		return false;
	}
	public function update_pwd($post) {
		if ($post ['pwd'] != $post ['ver_pwd']) {
			return false;
		}
		$data ['passwd'] = md5 ( $post ['pwd'] );
		$info = $this->db->where ( 'id', $_SESSION ['uid'] )->update ( 'user', $data );
		return $info;
	}
	public function bdlogin($post) {
		$api = $this->config->item ( 'bd' );
		$is_app_user = json_decode ( vpost ( $api ['isappuser'] . '?access_token=' . $post ['access_token'], 'get' ), true );
		if ($is_app_user ['result'] == 1) {
			$this->db->select ( 'id , nick_name' );
			$this->db->where ( 'atoken', $post ['access_token'] );
			$query = $this->db->get ( 'user' );
			if ($query->num_rows () > 0) {
				$info = $query->row_array ();
				$info = json_decode ( vpost ( $api ['getinfo'] . '?access_token=' . $post ['access_token'], 'get' ), true );
				$data ['nick_name'] = $info ['username'];
				$data ['portrait'] = $info ['portrait'];
				$data ['utime'] = time ();
				$data ['atoken'] = $post ['access_token'];
				$data ['rtoken'] = $post ['refresh_token'];
				$this->db->where ( 'id', $info ['id'] )->update ( 'user', $data );
				$_SESSION ['uid'] = $info ['id'];
				$_SESSION ['uname'] = $info ['nick_name'];
				return true;
			} else {
				return false;
			}
		} else {
			$info = json_decode ( vpost ( $api ['getinfo'] . '?access_token=' . $post ['access_token'], 'get' ), true );
			$data ['nick_name'] = $info ['username'];
			$data ['portrait'] = $info ['portrait'];
			$data ['ctime'] = time ();
			$data ['utime'] = time ();
			$data ['atoken'] = $post ['access_token'];
			$data ['rtoken'] = $post ['refresh_token'];
			$data ['type'] = 3;
			$data ['from'] = 1;
			$reg = $this->db->insert ( 'user', $data );
			if ($reg) {
				$id = $this->db->insert_id ();
				$_SESSION ['uid'] = $id;
				$_SESSION ['uname'] = $info ['username'];
				return true;
			} else {
				return false;
			}
		}
	}
	private function check_code($code) {
		if (empty ( $code )) {
			return 400;
		}
		$this->db->select ( '`id`,`expire`' );
		$this->db->where ( 'code', $code );
		$query = $this->db->get ( 'code' );
		if ($query->num_rows () > 0) {
			$info = $query->row_array ();
			if (! empty ( $info ['user_id'] ) || $info ['expire'] < time ()) {
				return 204;
			}
			return 200;
		}
		return 404;
	}
    public function find_pwd($post) {
        // ss($post);
        $this->db->select ( 'id,code' );
        $this->db->where ( 'expire >', time () );
        $this->db->where ( 'type', 0 );
        $this->db->where ( 'phone', $post ['p_phone'] );
        $this->db->where ( 'code', $post ['p_dy_code'] );
        $this->db->order_by ( 'expire', 'desc' );
        $this->db->order_by ( 'id', 'desc' );
        $this->db->limit ( 1 );
        $query = $this->db->get ( 'vcode' );
        if ($query->num_rows () <= 0) {
            return array (
                    'ret' => '305' 
                    );
        } else {
            $vcode = $query->row_array ();
        }

        $this->db->select ( 'id' );
        $this->db->where ( 'mobile', $post ['p_phone'] );
        $query = $this->db->get ( 'user' );
        if ($query->num_rows () == 0) {
            return array (
                    'ret' => '205' 
                    );
        }

        $this->db->where ( 'mobile', $post ['p_phone'] )->update ( 'user', array (
                    'passwd' => md5($post ['p_pwd'])
                    ) );

        $this->db->where ( 'id', $vcode ['id'] )->update ( 'vcode', array (
                    'status' => 1 
                    ) );

        return array (
                'ret' => '200' 
                );
    }
}
