<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function index()
	{
		$data = array(
			'title' => 'Title goes here',
		);

		$this->load->library('template');
		$this->template
			->add_package(['demo-package'])
			->load('default', 'content', $data);
	}

	public function nocontent()
	{
		$data = array(

			'title' => 'Title goes here',
			'body'  => 'The string to be embedded here!'

		);
		$this->load->library('template');
		$this->template->load('default', null, $data);
	}
}
