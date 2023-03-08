<?php

class Penawaran extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('penawaran_model');
		$this->load->model('auth_model');
		if(!$this->auth_model->current_user()){
			redirect('backend/auth/login');
		}
	}

	public function index()
	{
		$data['title'] = 'List Data Penawaran';
        $data['activeUser'] = $this->auth_model->current_user();
        $data['penawaran'] = $this->penawaran_model->get_all();

        
		$this->load->view('backend/list_penawaran', $data);

	}

	public function delete($id = null)
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
        $this->penawaran_model->delete($id);
		redirect("backend/penawaran");
	}

	public function add()
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan level
		$penawaran = $this->penawaran_model;
		$validation = $this->form_validation;
		$validation->set_rules($penawaran->rules());
		if ($validation->run()) {
			$penawaran->save();
			redirect("backend/penawaran");
		}
		$this->load->view('backend/componens/add_penawaran', $data);
	}
	public function new()
	{
		$data['activeUser'] = $this->auth_model->current_user(); //menampilkan data dari user login
		if ($this->input->method() === 'post') {
			$ori_name						= $_FILES["gambar"]["name"];
			$file_name						= uniqid('', true);
			$config['upload_path']			= FCPATH . '/upload/penawaran/';
			$config['allowed_types']		= 'gif|jpg|png|jpeg';
			$config['file_name']			= str_replace('.', '', $file_name);
			$config['overwrite']			= true;
			$config['max_size']				= 1024; //1mb
			$config['max_width']			= 1080;
			$config['max_height']			= 1080;
			$this->load->library('upload', $config);
 
 
			if (!$this->upload->do_upload('gambar')) {
				$data['error'] = $this->upload->display_errors();
				$this->session->set_flashdata('message', $data['error']);
			} else {
				$penawaran = [
					'tgl_mulai' => $this->input->post('tgl_mulai'),
					'tgl_akhir' => $this->input->post('tgl_akhir'),
					'nama_barang' => $this->input->post('nama_barang'),
					'harga_awal' => $this->input->post('harga_awal'),
					'penaggungjawab' => $this->input->post('penanggungjawab'),
					'status' => $this->input->post('status')
				];
				$saved = $this->penawaran_model->insert($penawaran);
 
				if ($saved) {
					$uploaded_data = $this->upload->data();
					$gambar = [
						'id_penawaran' => $saved,
						'gambar' => $uploaded_data['file_name'],
						'nama_gambar' => $ori_name,
						'utama' => 1,
						'urutan' => 0
					];
					$savedGambar = $this->gambar_model->insert($gambar);
 
					if ($savedGambar) {
						$this->session->set_flashdata('message', 'Data berhasil disimpan!');
						return redirect('backend/penawaran');
					} else {
						$this->session->set_flashdata('message', 'Data gagal disimpan!');
					}
				}
			}
		}
		$this->load->view('backend/componens/add_penawaran', $data);
	}
}