<?php

class Laporan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('lelang_model');
		$this->load->model('auth_model');
		if (!$this->auth_model->current_user()) {
			redirect('backend/auth/login');
		}
	}

	public function index()
	{
		$data['title'] = 'List Data Lelang';
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
		$data['laporan'] = $this->lelang_model->get_pemenangLelang(); //menampilkan data

		$this->load->view('backend/laporan_pemenang', $data);

	}

}