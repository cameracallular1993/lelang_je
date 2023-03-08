<?php

class Masyarakat extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('Masyarakat_model');
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('backend/auth/login');
		}
	}

    public function index()
    {
		$data['title'] = 'List Data Masyarakat';
        $data['level'] = $this->auth_model->current_user()->level; //menampilkan level
        $data['masyarakat'] = $this->Masyarakat_model->get_all(); //menampilkan data

		$data['activeUser'] = $this->auth_model->current_user();
        $this->load->view('backend/list_masyarakat', $data);

    }
    public function block($id_masyarakat = null)
    {
        $data['activeUser'] = $this->auth_model->current_user();
        if ($data['activeUser']->level <> 'Admin') {
            show_404();
        }
        $data['masyarakat'] = $this->Masyarakat_model->get_by_id($id_masyarakat);
        if (!$data['masyarakat'] || !$id_masyarakat) {
            show_404();
        }
        $masyarakat = [
            'id_masyarakat' => $id_masyarakat,
            'update_by' => $data['activeUser']->id_user,
            'update_date' => date('Y-m-d H:i:s'),
            'status' => 0
        ];
        $update = $this->Masyarakat_model->update($masyarakat);
        if ($update) {
            $this->session->set_flashdata('message', 'Data berhasil diblokir!');
        } else {
            $this->session->set_flashdata('message', 'Data gagal diblokir!');
        }
        redirect('backend/masyarakat');
    }
    public function aktifkan()
    {
        $id = $this->uri->segment(4);
        $data = array('status'  => '1');
        $update = $this->Masyarakat_model->update_masyarakat(array('id_masyarakat' => $id), $data);
        $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">
            Data Petugas Telah Di-aktifkan kembali!
          </div>');
        redirect('backend/masyarakat');
    }
}