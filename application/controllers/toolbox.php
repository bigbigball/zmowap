<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class toolbox extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		$this->load->library ( 'form_validation' );
	}
	function editor_upload() {
		$upload_data = array ();
		$dir = get_upload_file_dir ();
		$base_dir = get_base_dir ();
		$data = array ();
		if (! empty ( $_FILES ['file'] ) && $_FILES ['file'] ['error'] == 0) {
			$config ['upload_path'] = $dir;
			$config ['allowed_types'] = '*';
			$config ['overwrite'] = FALSE;
			$config ['max_size'] = 0;
			$config ['max_width'] = 0;
			$config ['max_height'] = 0;
			$config ['max_filename'] = 0;
			$config ['encrypt_name'] = true;
			$config ['remove_spaces'] = true;
			$this->load->library ( 'upload', $config );
			if (! $this->upload->do_upload ( 'file' )) {
				show_error ( $this->upload->display_errors () );
			} else {
				$upload_data = $this->upload->data ( 'file' );
			}
		}
		if (! empty ( $upload_data )) {
			$post ['path'] = str_replace ( $base_dir, '', $dir ) . $upload_data ['file_name'];
			$this->load->library ( "image_lib" );
			$config_thumb ['image_library'] = 'gd2';
			$config_thumb ['quality'] = 100;
			$config_thumb ['source_image'] = $upload_data ['full_path'];
			$config_thumb ['new_image'] = $upload_data ['file_name'];
			$config_thumb ['create_thumb'] = true;
			$config_thumb ['width'] = 250;
			$config_thumb ['height'] = 285;
			$config_thumb ['thumb_marker'] = "_250_285";
			$this->image_lib->initialize ( $config_thumb );
			if (! $this->image_lib->resize ()) {
				show_error ( $this->image_lib->display_errors () );
			}
			$data ['thumb'] = str_replace ( $base_dir, '', $dir ) . $upload_data ['raw_name'] . '_250_285' . $upload_data ['file_ext'];
			$data ['img'] = str_replace ( $base_dir, '', $dir ) . $upload_data ['raw_name'] . $upload_data ['file_ext'];
		}
		ss ( $data );
	}
}
/* End of file mileage.php */
/* Location: ./application/controllers/mileage.php */