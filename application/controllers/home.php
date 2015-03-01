<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Home extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$ci = & get_instance ();
		$variable = array (
				'haction' => 'home' 
		);
		$ci->load->vars ( $variable );
	}
	public function index() {
		// $sms = new Sms();
		// $ret = $sms ->sendSms('15901516572' , '验证码:789456');
		$this->load->model ( 'active_model', '', true );
		$this->load->model ( 'lesson_model', '', true );
		$this->load->model ( 'teacher_model', '', true );
		$this->load->model ( 'video_model', '', true );
		$this->load->model ( 'news_model', '', true );
		$this->load->model ( 'carousel_model', '', true );
		
		$news_home = $video_home = $lesson_home = $teacher_home = $carousel_home = array ();
		$active = $this->active_model->get_home();
		$news = $this->news_model->get_home ();
		$video = $this->video_model->get_home ();
		$lesson = $this->lesson_model->get_home ();
		$teacher = $this->teacher_model->get_home ();
		$carousel = $this->carousel_model->get_home ();
		
		if (! empty ( $active )) {
			$active_home = $active ['info'];
		}
		if (! empty ( $lesson )) {
			$lesson_home = $lesson ['info'];
		}
		if (! empty ( $video )) {
			$video_home = $video ['info'];
		}
		if (! empty ( $news )) {
			$news_home = $news ['info'];
		}
		if (! empty ( $teacher )) {
			$teacher_home = $teacher ['info'];
		}
		if (! empty ( $carousel )) {
			$carousel_home = $carousel ['info'];
		}
		$data ['active'] = $active_home;
		$data ['video'] = $video_home;
		$data ['news'] = $news_home;
		$data ['lesson'] = $lesson_home;
		$data ['teacher'] = $teacher_home;
		$data ['carousel'] = $carousel_home;
		$this->load->view ( '/home/home', $data );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */